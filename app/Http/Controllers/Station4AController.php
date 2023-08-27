<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\RefChiefComplain;
use App\Models\RefIllness;
use App\Models\RefVaccine;
use App\Models\RefQuestion;
use App\Models\RefFrequency;
use App\Models\RefDiseaseGroup;
use App\Models\MDataSocialBehavior;
use App\Models\MDataVariousSymptom;
use App\Models\MDataPatientCCDetails;
use App\Models\MDataPatientIllnessHistory;
use Illuminate\Support\Facades\DB;
use App\Models\RefSocialBehavior;
use App\Models\MDataPhysicalExamGeneral;
use App\Models\MDataPhysicalFinding;
use App\Models\MDataPatientQuestionAnswer;
use App\Models\MDataFamilyIllnessHistory;
use App\Models\MDataPatientVaccine;
use App\Models\MDataRxDetails;
use App\Models\RefDuration;
use App\Models\RefDrug;
use Carbon\Carbon;

class Station4AController extends Controller
{
    public function complaintsListDay(){
        try{
           $data = RefDuration::select('DurationId','DurationCode')->get();

           $status = [
            'code'=> 200,
            'message' =>'Complain options data get successfully'
           ];
           return response()->json(['data'=>$data,'status'=>$status]);
        }
        catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }
    
    public function complaintsList(){
        try{
            //RefChiefComplain 
           $data = RefChiefComplain::select('CCId','CCCode','Description')->get();

           $status = [
            'code'=> 200,
            'message' =>'complaint list get successfully'
           ];
           return response()->json(['data'=>$data,'status'=>$status]);
        }
        catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }
    
    public function patientS4Create(Request $request){

        DB::beginTransaction();
        try{
            $CurrentTime = Carbon::now();
            $DateTime =$CurrentTime->toDateTimeString();

            //MDataPatientCCDetails 
           
           $Complaints = $request->Complaints;

        //    return response()->json($request->all());
           
           for($i=0;$i<count($Complaints); $i++){

                $Complaint = new MDataPatientCCDetails(); 
                $Complaint->MDCCId = Str::uuid();
                $Complaint->PatientId  = $Complaints[$i]['PatientId'];
                $Complaint->CollectionDate  = $DateTime;
                $Complaint->CCId  = $Complaints[$i]['illnessId'];//RefChiefComplain
                $Complaint->ChiefComplain  = $Complaints[$i]['chiefComplain'];//RefChiefComplain
                $Complaint->DurationId  = $Complaints[$i]['durationId'];//
                $Complaint->CCDurationValue  = $Complaints[$i]['ccDurationValue'];//
                $Complaint->OtherCC  = $Complaints[$i]['otherCC'];
                $Complaint->Nature  = $Complaints[$i]['nature'];
                $Complaint->Status  = "A";
                $Complaint->CreateDate  = $DateTime;
                $Complaint->CreateUser  = $Complaints[$i]['CreateUser'];
                $Complaint->UpdateDate  = $DateTime;
                $Complaint->UpdateUser  = "";
                $Complaint->OrgId  = $Complaints[$i]['OrgId'];
                $Complaint->save();
           }
        
           //Present illness
           $PresentIllness = $request->PatientHOPresentIllness;
           for($i=0;$i<count($PresentIllness); $i++){
               $PresentIll = new MDataPatientIllnessHistory();
               $PresentIll->MDPatientIllnessId = Str::uuid();
               $PresentIll->PatientId = $PresentIllness[$i]['PatientId'];
               $PresentIll->CollectionDate = $DateTime;
               $PresentIll->IllnessId = $PresentIllness[$i]['illnessId'];
               $PresentIll->OtherIllness = $PresentIllness[$i]['otherIllness'];
               $PresentIll->Status = 1;
               $PresentIll->CreateUser = $PresentIllness[$i]['CreateUser'];
               $PresentIll->CreateDate = $DateTime;
               $PresentIll->UpdateUser = "";
               $PresentIll->UpdateDate =  $DateTime;
               $PresentIll->OrgId = $PresentIllness[$i]['OrgId'];
               $PresentIll->save();
           }
           
            //Save Past illness
            $PastIllness = $request->PatientHOPastIllness;
            for($i=0;$i<count($PastIllness); $i++){
                $PastIll = new MDataPatientIllnessHistory();
                $PastIll->MDPatientIllnessId = Str::uuid();
                $PastIll->PatientId = $PastIllness[$i]['PatientId'];
                $PastIll->CollectionDate = $DateTime;
                $PastIll->IllnessId = $PastIllness[$i]['illnessId'];
                $PastIll->OtherIllness = $PastIllness[$i]['otherIllness'];
                $PastIll->Status = 2;
                $PastIll->CreateUser = $PastIllness[$i]['CreateUser'];
                $PastIll->CreateDate = $DateTime;
                $PastIll->UpdateUser = "";
                $PastIll->UpdateDate =  $DateTime;
                $PastIll->OrgId = $PastIllness[$i]['OrgId'];
                $PastIll->save();
            }

            //Save Family illness
            $FamilyIllness = $request->PatientHOFamilyIllness;
            for($i=0;$i<count($FamilyIllness); $i++){
                $FamilyIll = new MDataFamilyIllnessHistory();
                $FamilyIll->MDFamilyIllnessId = Str::uuid();
                $FamilyIll->PatientId = $FamilyIllness[$i]['PatientId'];
                $FamilyIll->IllFamilyMemberId = $FamilyIllness[$i]['illFamilyMemberId'];
                $FamilyIll->CollectionDate = $DateTime;
                $FamilyIll->IllnessId = $FamilyIllness[$i]['illnessId'];
                $FamilyIll->OtherIllness = $FamilyIllness[$i]['otherIllness'];
                $FamilyIll->Status = "A";
                $FamilyIll->CreateUser = $FamilyIllness[$i]['CreateUser'];
                $FamilyIll->CreateDate = $DateTime;
                $FamilyIll->UpdateUser = "";
                $FamilyIll->UpdateDate =  $DateTime;
                $FamilyIll->OrgId = $FamilyIllness[$i]['OrgId'];
                $FamilyIll->save();
            }
            
            //Save Social History Behavior
            $SocialHistory = $request->SocialHistory;
            for($i=0;$i<count($SocialHistory); $i++){
                $SocialBehavior = new MDataSocialBehavior();
                $SocialBehavior->MDSocialBehaviorId = Str::uuid();
                $SocialBehavior->PatientId = $SocialHistory[$i]['PatientId'];
                $SocialBehavior->CollectionDate = $DateTime;
                $SocialBehavior->SocialBehaviorId = $SocialHistory[$i]['socialBehaviorId'];
                $SocialBehavior->OtherSocialBehavior = $SocialHistory[$i]['otherSocialBehavior'];
                $SocialBehavior->Status = "A";
                $SocialBehavior->CreateUser = $SocialHistory[$i]['CreateUser'];
                $SocialBehavior->CreateDate = $DateTime;
                $SocialBehavior->UpdateUser = "";
                $SocialBehavior->UpdateDate =  $DateTime;
                $SocialBehavior->OrgId = $SocialHistory[$i]['OrgId'];
                $SocialBehavior->save();
            }

            //Save TB Screening
            $TBScreening = $request->TBScreening;
            for($i=0;$i<count($TBScreening); $i++){
                $VariousSymptom = new MDataVariousSymptom();
                $VariousSymptom->MDVariousSymptomId = Str::uuid();
                $VariousSymptom->PatientId = $TBScreening[$i]['PatientId'];
                $VariousSymptom->CollectionDate = $DateTime;
                $VariousSymptom->AnemiaSeverityId = $TBScreening[$i]['AnemiaSeverityId'];
                $VariousSymptom->AnemiaSeverity = $TBScreening[$i]['AnemiaSeverity'];
                $VariousSymptom->CoughGreaterThanMonth = $TBScreening[$i]['coughGreaterThanMonth'];
                $VariousSymptom->LGERF = $TBScreening[$i]['LGERF'];
                $VariousSymptom->NightSweat = $TBScreening[$i]['nightSweat'];
                $VariousSymptom->WeightLoss = $TBScreening[$i]['weightLoss'];
                $VariousSymptom->Status = "A";
                $VariousSymptom->CreateUser = $TBScreening[$i]['CreateUser'];
                $VariousSymptom->CreateDate = $DateTime;
                $VariousSymptom->UpdateUser = "";
                $VariousSymptom->UpdateDate =  $DateTime;
                $VariousSymptom->OrgId = $TBScreening[$i]['OrgId'];
                $VariousSymptom->save();
            }
            
            //Save General Examination
            $GeneralExamination = $request->GeneralExamination;
            for($i=0;$i<count($GeneralExamination); $i++){
                $ExamGeneral = new MDataPhysicalExamGeneral();
                $ExamGeneral->MDPhysicalExamGeneralId = Str::uuid();
                $ExamGeneral->PatientId = $GeneralExamination[$i]['PatientId'];
                $ExamGeneral->CollectionDate = $DateTime;
                $ExamGeneral->AnemiaSeverity = $GeneralExamination[$i]['anemiaSeverity'];
                $ExamGeneral->JaundiceSeverity = $GeneralExamination[$i]['jaundiceSeverity'];
                $ExamGeneral->EdemaSeverity = $GeneralExamination[$i]['edemaSeverity'];
                $ExamGeneral->IsLymphNodesWithPalpable = $GeneralExamination[$i]['isLymphNodesWithPalpable'];
                $ExamGeneral->LymphNodesWithPalpableSite = $GeneralExamination[$i]['lymphNodesWithPalpableSite'];
                $ExamGeneral->LymphNodesWithPalpable = $GeneralExamination[$i]['lymphNodesWithPalpable'];
                $ExamGeneral->LymphNodesWithPalpableSize = $GeneralExamination[$i]['lymphNodesWithPalpableSize'];
                $ExamGeneral->IsHeartWithNAD = $GeneralExamination[$i]['isHeartWithNAD'];
                $ExamGeneral->HeartWithNAD = $GeneralExamination[$i]['heartWithNAD'];
                $ExamGeneral->IsLungsWithNAD = $GeneralExamination[$i]['isLungsWithNAD'];
                $ExamGeneral->LungsWithNAD = $GeneralExamination[$i]['lungsWithNAD'];
                $ExamGeneral->OtherSymptom = $GeneralExamination[$i]['otherSymptom'];
                $ExamGeneral->Cyanosis = $GeneralExamination[$i]['cyanosis'];
                $ExamGeneral->Status = "A";
                $ExamGeneral->CreateUser = $GeneralExamination[$i]['CreateUser'];
                $ExamGeneral->CreateDate = $DateTime;
                $ExamGeneral->UpdateUser = "";
                $ExamGeneral->UpdateDate =  $DateTime;
                $ExamGeneral->OrgId = $GeneralExamination[$i]['OrgId'];
                $ExamGeneral->save();
            }

            //Save Systemic Examination
            $SystemicExam = $request->SystemicExamination;
            for($i=0;$i<count($SystemicExam); $i++){
                $SystemicExamination = new MDataPhysicalFinding();
                $SystemicExamination->MDPhysicalFindingId = Str::uuid();
                $SystemicExamination->PatientId = $SystemicExam[$i]['PatientId'];
                $SystemicExamination->CollectionDate = $DateTime;
                $SystemicExamination->PhysicalFinding = $SystemicExam[$i]['physicalFinding'];
                $SystemicExamination->Status = "A";
                $SystemicExamination->CreateUser = $SystemicExam[$i]['CreateUser'];
                $SystemicExamination->CreateDate = $DateTime;
                $SystemicExamination->UpdateUser = "";
                $SystemicExamination->UpdateDate =  $DateTime;
                $SystemicExamination->OrgId = $SystemicExam[$i]['OrgId'];
                $SystemicExamination->save();
            }

            //Save Current Medication Taken
            $MedicationTaken = $request->CurrentMedicationTaken;
            for($i=0;$i<count($MedicationTaken); $i++){
                $MDataRxDetail = new MDataRxDetails();
                $MDataRxDetail->RxId = Str::uuid();
                $MDataRxDetail->PatientId = $MedicationTaken[$i]['PatientId'];
                $MDataRxDetail->CollectionDate = $DateTime;
                $MDataRxDetail->Rx = $MedicationTaken[$i]['medicineName'];
                $MDataRxDetail->DurationId = $MedicationTaken[$i]['durationId'];
                $MDataRxDetail->FrequencyHour = $MedicationTaken[$i]['frequencyHour'];
                $MDataRxDetail->Dose = $MedicationTaken[$i]['dose'];
                $MDataRxDetail->AllergyToMedication = $MedicationTaken[$i]['allergyToMedication'];
                $MDataRxDetail->RxDurationValue = $MedicationTaken[$i]['doseValue'];
                $MDataRxDetail->Status = "A";
                $MDataRxDetail->CreateUser = $MedicationTaken[$i]['CreateUser'];
                $MDataRxDetail->CreateDate = $DateTime;
                $MDataRxDetail->UpdateUser = "";
                $MDataRxDetail->UpdateDate =  $DateTime;
                $MDataRxDetail->OrgId = $MedicationTaken[$i]['OrgId'];
                $MDataRxDetail->save();
            }
            
            //Save Patient Mental Health
            $MentalHealth = $request->PatientMentalHealth;
            for($i=0;$i<count($MentalHealth); $i++){
                $PatientQuestionAnswer = new MDataPatientQuestionAnswer();
                $PatientQuestionAnswer->MDPatientQuestionAnswerId = Str::uuid();
                $PatientQuestionAnswer->PatientId = $MentalHealth[$i]['PatientId'];
                $PatientQuestionAnswer->CollectionDate = $DateTime;
                $PatientQuestionAnswer->QuestionId = $MentalHealth[$i]['questionId'];
                $PatientQuestionAnswer->AnswerId = $MentalHealth[$i]['answerId'];
                $PatientQuestionAnswer->CreateUser = $MentalHealth[$i]['CreateUser'];
                $PatientQuestionAnswer->CreateDate = $DateTime;
                $PatientQuestionAnswer->Status = "A";
                $PatientQuestionAnswer->UpdateUser = "";
                $PatientQuestionAnswer->UpdateDate =  $DateTime;
                $PatientQuestionAnswer->OrgId = $MentalHealth[$i]['OrgId'];
                $PatientQuestionAnswer->save();
            }
            
            //Save Child Vaccination 
            $ChildVaccination = $request->ChildVaccination;
            for($i=0;$i<count($ChildVaccination); $i++){
                $PatientVaccine = new MDataPatientVaccine();
                $PatientVaccine->MDPatientVaccineId = Str::uuid();
                $PatientVaccine->PatientId = $ChildVaccination[$i]['PatientId'];
                $PatientVaccine->CollectionDate = $DateTime;
                $PatientVaccine->VaccineId = $ChildVaccination[$i]['vaccineId'];
                $PatientVaccine->OtherVaccine = $ChildVaccination[$i]['otherVaccine'];
                $PatientVaccine->IsGivenByNirog = $ChildVaccination[$i]['isGivenByNirog'];
                $PatientVaccine->Status = "A";
                $PatientVaccine->CreateUser = $ChildVaccination[$i]['CreateUser'];
                $PatientVaccine->CreateDate = $DateTime;
                $PatientVaccine->UpdateUser = "";
                $PatientVaccine->UpdateDate =  $DateTime;
                $PatientVaccine->OrgId = $ChildVaccination[$i]['OrgId'];
                $PatientVaccine->save();
            }
            
            //Save Adult Vaccination
            $AdultVaccination = $request->AdultVaccination;
            for($i=0;$i<count($AdultVaccination); $i++){
                $AdultVaccine = new MDataPatientVaccine();
                $AdultVaccine->MDPatientVaccineId = Str::uuid();
                $AdultVaccine->PatientId = $AdultVaccination[$i]['PatientId'];
                $AdultVaccine->CollectionDate = $DateTime;
                $AdultVaccine->VaccineId = $AdultVaccination[$i]['vaccineId'];
                $AdultVaccine->OtherVaccine = $AdultVaccination[$i]['otherVaccine'];
                $AdultVaccine->IsGivenByNirog = $AdultVaccination[$i]['isGivenByNirog'];
                $AdultVaccine->Status = "A";
                $AdultVaccine->CreateUser = $AdultVaccination[$i]['CreateUser'];
                $AdultVaccine->CreateDate = $DateTime;
                $AdultVaccine->UpdateUser = "";
                $AdultVaccine->UpdateDate =  $DateTime;
                $AdultVaccine->OrgId = $AdultVaccination[$i]['OrgId'];
                $AdultVaccine->save();
            }

           // Commit [save] the transaction
            DB::commit(); 

            $status = [
                'code'=> 200,
                'message' =>'Station 4A saved successfully!'
               ];

           return response()->json($status);
        }
        catch(\Exception $e){
            // Rollback the transaction in case of an exception
            DB::rollBack();
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json($status);
        }
    }
    
    public function presentIllness(){
        try{
           $data = RefIllness::select('IllnessId','IllnessCode')->get();
           $status = [
            'code'=> 200,
            'message' =>'Present illness get successfully'
           ];
           
           return response()->json(['data'=>$data,'status'=>$status]);
        }
        catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json($status);
        }
    }
    
    public function pastIllness(){
        try{
           $data = RefIllness::select('IllnessId','IllnessCode')->get();
           $status = [
            'code'=> 200,
            'message' =>'Past illness get successfully'
           ];
           return response()->json(['data'=>$data,'status'=>$status]);
        }
        catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }

    public function familyIllness(){
        try{
            $data = RefIllness::select('IllnessId','IllnessCode')->get();
            $status = [
                'code'=> 200,
                'message' =>'Familly illness get successfully'
               ];
            return response()->json(['data'=>$data,'status'=>$status]);

        }catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }

    public function socialHistory(){
        try{
            $data = RefSocialBehavior::select('SocialBehaviorId','SocialBehaviorCode')->get();
            $status = [
                'code'=> 200,
                'message' =>'Social history get successfully'
               ];
            return response()->json(['data'=>$data,'status'=>$status]);
        }catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }
    
    public function currentMedicationTaken(){
        try{
            $data = RefDrug::select('DrugId','DrugCode')->get();
            $status = [
                'code'=> 200,
                'message' =>'Current medication taken get successfully'
               ];
            return response()->json(['data'=>$data,'status'=>$status]);

        }catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }
    
    public function patientMentalHealth(){
        try{
            $data = RefQuestion::with('getAnswers')->get();
            $status = [
                'code'=> 200,
                'message' =>'Patient mental health get successfully'
               ];

            return response()->json(['data'=>$data,'status'=>$status]);

        }catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }
    
    public function childVaccination(){
        try{
            $data = RefVaccine::select('VaccineId','VaccineCode')->get();
            $status = [
                'code'=> 200,
                'message' =>'Child vaccination get successfully'
               ];
            return response()->json(['data'=>$data,'status'=>$status]);

        }catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }
    
    public function adultVaccination(){
        try{
            $data = RefVaccine::select('VaccineId','VaccineCode')->get();
            $status = [
                'code'=> 200,
                'message' =>'Adult vaccination get successfully'
               ];
            
            return response()->json(['data'=>$data,'status'=>$status]);

        }catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }


}
