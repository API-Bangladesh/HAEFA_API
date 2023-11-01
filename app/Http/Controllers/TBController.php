<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\RefTBSymptoms;
use App\Models\RefTBEFinding;
use App\Models\RefTBEPastEvidenced;
use App\Models\RefTBPastHistory;
use App\Models\MDataPatientTBSymptom;
use App\Models\MDataPatientTBEFindings;
use App\Models\MDataPatientTBEvidenced;
use App\Models\MDataPatientTBPastHistory;
use App\Models\MDataTreatmentSuggestion;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TBController extends Controller
{
    public function TBSymptom(){
        try{
           $data = RefTBSymptoms::select('TBSymptomId','TBSymptomCode')->orderBy('SortOrder', 'asc')->get();

           $status = [
            'code'=> 200,
            'message' =>'TB Symptom Data Get Successfully'
           ];
           return response()->json(['status'=>$status,'data'=>$data]);
        }
        catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }
    public function TBEFinding(){
        try{
           $data = RefTBEFinding::select('TBEFindingId','TBEFindingCode')->orderBy('SortOrder', 'asc')->get();

           $status = [
            'code'=> 200,
            'message' =>'TB E Finding Data Get Successfully'
           ];
           return response()->json(['status'=>$status,'data'=>$data]);
        }
        catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }
    public function TBEPastEvidenced(){
        try{
           $data = RefTBEPastEvidenced::select('TBEPastEvidenceId','TBEPastEvidenceCode')->orderBy('SortOrder', 'asc')->get();

           $status = [
            'code'=> 200,
            'message' =>'TB Past Evidenced Data Get Successfully'
           ];
           return response()->json(['status'=>$status,'data'=>$data]);
        }
        catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }
    public function TBPastHistory(){
        try{
           $data = RefTBPastHistory::select('TBHistoryId','TBHistoryIdCode','TBPastHistoryQuestion','TBPastHistoryAnswer1','TBPastHistoryAnswer2')->orderBy('SortOrder', 'asc')->get();

           $status = [
            'code'=> 200,
            'message' =>'TB History Data Get Successfully'
           ];
           return response()->json(['status'=>$status,'data'=>$data]);
        }
        catch(\Exception $e){
            $status = [
                'code'=> 403,
                'message' =>$e->getMessage()
               ];
            return response()->json(['status' => $status]);
        }
    }

    public function TBCatData(Request $request){

        $TBCatData= DB::select("SELECT RD.DrugCode AS DrugCode,RC.DrugId,RC.Frequency, RC.Hour, RC.DrugDurationValue,RC.DrugDose,RC.OtherDrug,RC.SpecialInstruction,RIS.InstructionInBangla,RC.Comment1,RC.Comment2,RC.CatMedicineStatus,RC.CreateDate AS CreateDate
            FROM RefCat as RC
            INNER JOIN RefDrug as RD on RD.DrugId = RC.DrugId
            INNER JOIN RefInstruction as RIS on RIS.RefInstructionId = RC.SpecialInstruction
            WHERE CatType = '$request->CatType'
            Order By Comment2 ASC 
            ");

        return response()->json([
            'message' => 'TB Cat All Data',
            'code'=>200,
            'TBCatData'=>$TBCatData,
        ],200);
    }
    public function patientTBCreate(Request $request){

        DB::beginTransaction();
        try{
            $CurrentTime = Carbon::now();
            $DateTime =$CurrentTime->toDateTimeString();

            //MDataPatient TB Symptoms mDetails start
           
           $TBSymptoms = $request->TBSymptoms;
           
           for($i=0;$i<count($TBSymptoms); $i++){

                $TBSymptom = new MDataPatientTBSymptom(); 
                $TBSymptom->MDTBSymptomId = Str::uuid();
                $TBSymptom->PatientId  = $TBSymptoms[$i]['PatientId'];
                $TBSymptom->CollectionDate  = $DateTime;
                $TBSymptom->TBSymptom  = $TBSymptoms[$i]['TBSymptom'];//
                $TBSymptom->TBSymptomCode  = $TBSymptoms[$i]['TBSymptomCode'];//
                $TBSymptom->OthersSymptom  = $TBSymptoms[$i]['OthersSymptom'];//
                $TBSymptom->Status  = $TBSymptoms[$i]['Status'];
                $TBSymptom->CreateDate  = $DateTime;
                $TBSymptom->CreateUser  = $TBSymptoms[$i]['CreateUser'];
                $TBSymptom->UpdateDate  = $DateTime;
                $TBSymptom->UpdateUser  = $TBSymptoms[$i]['UpdateUser'];
                $TBSymptom->OrgId  = $TBSymptoms[$i]['OrgId'];
                $TBSymptom->save();
           }

           //MDataPatient TB Symptoms mDetails End
           //MDataPatient TB E Finding mDetails Start
           
           $TBEFindings = $request->TBEFindings;
           
           for($i=0;$i<count($TBEFindings); $i++){

                $TBEFinding = new MDataPatientTBEFindings(); 
                $TBEFinding->MDEFindingId = Str::uuid();
                $TBEFinding->PatientId  = $TBEFindings[$i]['PatientId'];
                $TBEFinding->CollectionDate  = $DateTime;
                $TBEFinding->TBEFindingId  = $TBEFindings[$i]['TBEFindingId'];//
                $TBEFinding->TBEFindingCode  = $TBEFindings[$i]['TBEFindingCode'];//
                $TBEFinding->TBEFindingOthers  = $TBEFindings[$i]['TBEFindingOthers'];//
                $TBEFinding->Status  = $TBEFindings[$i]['Status'];
                $TBEFinding->CreateDate  = $DateTime;
                $TBEFinding->CreateUser  = $TBEFindings[$i]['CreateUser'];
                $TBEFinding->UpdateDate  = $DateTime;
                $TBEFinding->UpdateUser  = $TBEFindings[$i]['UpdateUser'];
                $TBEFinding->OrgId  = $TBEFindings[$i]['OrgId'];
                $TBEFinding->save();
           }

           //MDataPatient TB E Finding Details End
           //MDataPatient TB Evidence Details Start
           
           $TBEvidences = $request->TBEvidences;
           
           for($i=0;$i<count($TBEvidences); $i++){

                $TBEvidence = new MDataPatientTBEvidenced(); 
                $TBEvidence->MDPatientPEId = Str::uuid();
                $TBEvidence->PatientId  = $TBEvidences[$i]['PatientId'];
                $TBEvidence->CollectionDate  = $DateTime;
                $TBEvidence->TBEPastEvidencedId  = $TBEvidences[$i]['TBEPastEvidencedId'];//
                $TBEvidence->TBEPastEvidencedCode  = $TBEvidences[$i]['TBEPastEvidencedCode'];//
                $TBEvidence->TBEPastEvidencedOthers  = $TBEvidences[$i]['TBEPastEvidencedOthers'];
                $TBEvidence->Status  = $TBEvidences[$i]['Status'];
                $TBEvidence->CreateDate  = $DateTime;
                $TBEvidence->CreateUser  = $TBEvidences[$i]['CreateUser'];
                $TBEvidence->UpdateDate  = $DateTime;
                $TBEvidence->UpdateUser  = $TBEvidences[$i]['UpdateUser'];
                $TBEvidence->OrgId  = $TBEvidences[$i]['OrgId'];
                $TBEvidence->save();
           }

           $TBPastHistories = $request->TBPastHistories;
           
           for($i=0;$i<count($TBPastHistories); $i++){

                $TBPastHistory = new MDataPatientTBPastHistory(); 
                $TBPastHistory->MDPatientTBPHistoryId = Str::uuid();
                $TBPastHistory->PatientId  = $TBPastHistories[$i]['PatientId'];
                $TBPastHistory->CollectionDate  = $DateTime;
                $TBPastHistory->TBPastHistoryQuestionId  = $TBPastHistories[$i]['TBPastHistoryQuestionId'];//
                $TBPastHistory->TBHistoryAnswer1  = $TBPastHistories[$i]['TBHistoryAnswer1'];//
                $TBPastHistory->TBHistoryOthers1  = $TBPastHistories[$i]['TBHistoryOthers1'];//
                $TBPastHistory->TBHistoryOthers2  = $TBPastHistories[$i]['TBHistoryOthers2'];//
                $TBPastHistory->Status  = $TBPastHistories[$i]['Status'];
                $TBPastHistory->CreateDate  = $DateTime;
                $TBPastHistory->CreateUser  = $TBPastHistories[$i]['CreateUser'];
                $TBPastHistory->UpdateDate  = $DateTime;
                $TBPastHistory->UpdateUser  = $TBPastHistories[$i]['UpdateUser'];
                $TBPastHistory->OrgId  = $TBPastHistories[$i]['OrgId'];
                $TBPastHistory->save();
           }

           //Treatment Suggestions

           $TreatmentSuggestion = $request->TreatmentSuggestion;
       

           for($i=0;$i<count($TreatmentSuggestion); $i++){
               $MDataTreatmentSuggestion = new MDataTreatmentSuggestion();
               $MDataTreatmentSuggestion->MDTreatmentSuggestionId = Str::uuid();
               $MDataTreatmentSuggestion->PatientId = $TreatmentSuggestion[$i]['PatientId'];
               $MDataTreatmentSuggestion->CollectionDate = $DateTime;
               $MDataTreatmentSuggestion->DrugId = $TreatmentSuggestion[$i]['drugId'];
               $MDataTreatmentSuggestion->DurationId = $TreatmentSuggestion[$i]['durationId'];
               $MDataTreatmentSuggestion->RefFrequencyId = $TreatmentSuggestion[$i]['frequencyId'];
               $MDataTreatmentSuggestion->Frequency = $TreatmentSuggestion[$i]['frequency'];
               $MDataTreatmentSuggestion->Hourly = $TreatmentSuggestion[$i]['hourly'];
               $MDataTreatmentSuggestion->DrugDurationValue = $TreatmentSuggestion[$i]['drugDurationValue'];
               $MDataTreatmentSuggestion->OtherDrug = $TreatmentSuggestion[$i]['otherDrug'];
               $MDataTreatmentSuggestion->SpecialInstruction = $TreatmentSuggestion[$i]['specialInstruction'];
               $MDataTreatmentSuggestion->RefInstructionId = $TreatmentSuggestion[$i]['refInstructionId'];
               $MDataTreatmentSuggestion->DrugDose = $TreatmentSuggestion[$i]['drugDose'];
               $MDataTreatmentSuggestion->Comment = $TreatmentSuggestion[$i]['comment'];
               $MDataTreatmentSuggestion->Status  = $TreatmentSuggestion[$i]['Status'];
               $MDataTreatmentSuggestion->CreateDate  = $DateTime;
               $MDataTreatmentSuggestion->CreateUser  = $TreatmentSuggestion[$i]['CreateUser'];
               $MDataTreatmentSuggestion->UpdateDate  = $DateTime;
               $MDataTreatmentSuggestion->UpdateUser  = $TreatmentSuggestion[$i]['UpdateUser'];
               $MDataTreatmentSuggestion->OrgId  = $TreatmentSuggestion[$i]['OrgId'];
               $MDataTreatmentSuggestion->save();
           }  

            DB::commit(); 

            $status = [
                'code'=> 200,
                'message' =>'TB Data saved successfully!'
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
    


}
