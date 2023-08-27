<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MDataProvisionalDiagnosis;
use App\Models\MDataTreatmentSuggestion;
use App\Models\MDataInvestigation;
use App\Models\RefProvisionalDiagnosis;
use App\Models\MDataPatientReferral;
use Illuminate\Support\Facades\DB;
use App\Models\RefLabInvestigation;
use App\Models\MDataFollowUpDate;
use App\Models\RefInstruction;
use App\Models\MDataAdvice;
use App\Models\RefFrequency;
use App\Models\RefAdvice;
use Illuminate\Support\Str;
use App\Models\RefReferral;
use App\Models\HealthCenter;
use App\Models\RefDrug;
use Carbon\Carbon;

class Station4CController extends Controller
{
    // public function provisionalDiagonisis(){
    //     try{

    //         $provisionalDiagonisis = RefProvisionalDiagnosis::select('RefProvisionalDiagnosisId',
    //                                 'ProvisionalDiagnosisCode','ProvisionalDiagnosisName')->get();

    //         $status = [
    //             'code'=> 200,
    //             'message' =>'Provisional Diagnosis data get successfully'
    //            ];
    //         return response()->json(['status'=>$status,'data'=>$provisionalDiagonisis]);  

    //     }catch(\Exception $e){
    //         $status = [
    //             'code'=>403,
    //             'message'=>$e->getMessage()
    //         ];

    //         return response()->json(['status'=>$status]);
    //     }
    // }

    public function provisionalDiagonisis(Request $request){
        try{
            $keyword = $request->keyword;
            $limit = $request->limit;

            $query = RefProvisionalDiagnosis::query();
            $query->select('RefProvisionalDiagnosisId', 'ProvisionalDiagnosisCode','ProvisionalDiagnosisName');
            $query->when($keyword, function($query) use ($keyword){
                $query->where('ProvisionalDiagnosisCode', 'LIKE', "%".$keyword."%");
                $query->orWhere('ProvisionalDiagnosisName', 'LIKE', "%".$keyword."%");
            });

            $query->when($limit, function($query) use($limit){
                $query->limit($limit);
            });

            $provisionalDiagonisis = $query->get();

            $status = [
                'code'=> 200,
                'message' =>'Provisional Diagnosis data get successfully'
               ];
            return response()->json(['status'=>$status,'data'=>$provisionalDiagonisis]);  

        }catch(\Exception $e){
            $status = [
                'code'=>403,
                'message'=>$e->getMessage()
            ];

            return response()->json(['status'=>$status]);
        }
    }

    // public function investigations(){
    //     try{
    //         $RefLabInvestigation = RefLabInvestigation::select('RefLabInvestigationId',
    //                             'RefLabInvestigationCode','Investigation','Description')->get();
    //         $status = [
    //             'code'=>200,
    //             'message'=>'Lab investigations data get successfully!'
    //         ];
    //         return response()->json(['status'=> $status, 'data'=>$RefLabInvestigation]);

    //     }catch(\Exception $e){
    //         $status = [
    //             'code'=>403,
    //             'message'=>$e->getMessage()
    //         ];
    //         return response()->json(['status'=>$status]);
    //     }   
    // }

    public function investigations(Request $request){
        try{
            $keyword = $request->keyword;
            $limit = $request->limit;

            $query = RefLabInvestigation::query();
            $query->select('RefLabInvestigationId', 'RefLabInvestigationCode','Investigation','Description');
            $query->when($keyword, function($query) use ($keyword){
                $query->where('RefLabInvestigationCode', 'LIKE', "%".$keyword."%");
            });

            $query->when($limit, function($query) use($limit){
                $query->limit($limit);
            });

            $RefLabInvestigation = $query->get();

            $status = [
                'code'=>200,
                'message'=>'Lab investigations data get successfully!'
            ];
            return response()->json(['status'=> $status, 'data'=>$RefLabInvestigation]);

        }catch(\Exception $e){
            $status = [
                'code'=>403,
                'message'=>$e->getMessage()
            ];
            return response()->json(['status'=>$status]);
        }   
    }

    public function specialInstruction(){
        try{
            $specialInstructions = RefInstruction::select('RefInstructionId',
                                    'InstructionCode','InstructionInEnglish','InstructionInBangla')->get();
            $status = [
                'code'=> 200,
                'message' =>'Special instructions data get successfully'
               ];
            return response()->json(['status'=>$status,'data'=>$specialInstructions]);  

        }catch(\Exception $e){
            $status = [
                'code'=>403,
                'message'=>$e->getMessage()
            ];

            return response()->json(['status'=>$status]);
        }
    }

    // Treatment Suggestions
    // public function treatmentSuggestins(){
    //     try{
    //         $RefDrug = RefDrug::select('DrugId','DrugCode','DrugDose','Description')->get();
    //         $status = [
    //             'code'=>200,
    //             'message'=>'Treatment suggestion data get successfully!'
    //         ];
    //         return response()->json(['status'=>$status,'data'=>$RefDrug]);

    //     }catch(\Exception $e){
    //         $status = [
    //             'code'=>403,
    //             'message'=> $e->getMessage()
    //         ];
    //         return response()->json(['status'=>$status]);
    //     }
    // }

    public function treatmentSuggestins(Request $request){
        try{
            $keyword = $request->keyword;
            $limit = $request->limit;

            $query = RefDrug::query();
            $query->select('DrugId','DrugCode','DrugDose','Description');
            $query->when($keyword, function($query) use ($keyword){
                $query->where('DrugCode', 'LIKE', "%".$keyword."%");
            });

            $query->when($limit, function($query) use($limit){
                $query->limit($limit);
            });

            $RefDrug = $query->get();

            $status = [
                'code'=>200,
                'message'=>'Treatment suggestion data get successfully!'
            ];

            return response()->json(['status'=>$status,'data'=>$RefDrug]);

        }catch(\Exception $e){
            $status = [
                'code'=>403,
                'message'=> $e->getMessage()
            ];
            return response()->json(['status'=>$status]);
        }
    }
    
    // Frequency Hours
    public function frequencyHours(){
        try{
            $FrequencyHours = RefFrequency::select('FrequencyId','FrequencyCode','FrequencyInEnglish')->get();
            $status = [
                'code'=>200,
                'message'=>'Treatment suggestion data get successfully!'
            ];
            return response()->json(['status'=>$status,'data'=>$FrequencyHours]);

        }catch(\Exception $e){
            $status = [
                'code'=>403,
                'message'=> $e->getMessage()
            ];
            return response()->json(['status'=>$status]);
        }
    }
    
    // Referral Section
    // public function referralSection(){
    //     try{
    //         $RefReferral = RefReferral::select('RId','RCode','Description')->get();
    //         $status = [
    //             'code'=>200,
    //             'message'=>'Referral section data get successfully!'
    //         ];
    //         return response()->json(['status'=>$status,'data'=>$RefReferral]);

    //     }catch(\Exception $e){
    //         $status = [
    //             'code'=>403,
    //             'message'=> $e->getMessage()
    //         ];
    //         return response()->json(['status'=>$status]);
    //     }
    // }
  
    
    public function referralSection(Request $request){
        try{
            $keyword = $request->keyword;
            $limit = $request->limit;

            $query = RefReferral::query();
            $query->select('RId','RCode','Description');
            $query->when($keyword, function($query) use ($keyword){
                $query->where('RCode', 'LIKE', "%".$keyword."%");
            });

            $query->when($limit, function($query) use($limit){
                $query->limit($limit);
            });

            $RefReferral = $query->get();

            $status = [
                'code'=>200,
                'message'=>'Referral section data get successfully!'
            ];
            return response()->json(['status'=>$status,'data'=>$RefReferral]);

        }catch(\Exception $e){
            $status = [
                'code'=>403,
                'message'=> $e->getMessage()
            ];
            return response()->json(['status'=>$status]);
        }
    }
    
    // Health Center
    public function healthCenter(Request $request){
        try{
            $keyword = $request->keyword;
            $limit = $request->limit;

            $query = HealthCenter::query();
            $query->select('HealthCenterId','HealthCenterCode','HealthCenterName');
            $query->when($keyword, function($query) use ($keyword){
                $query->where('HealthCenterCode', 'LIKE', "%".$keyword."%");
            });

            $query->when($limit, function($query) use($limit){
                $query->limit($limit);
            });

            $HealthCenter = $query->get();
            
            $status = [
                'code'=>200,
                'message'=>'Health center data get successfully!'
            ];
            return response()->json(['status'=>$status,'data'=>$HealthCenter]);

        }catch(\Exception $e){
            $status = [
                'code'=>403,
                'message'=> $e->getMessage()
            ];
            return response()->json(['status'=>$status]);
        }
    }
    
    // Advice
    public function Advice(Request $request){
        try{
            $keyword = $request->keyword;
            $limit = $request->limit;

            $query = RefAdvice::query();
            $query->select('AdviceId','AdviceCode','AdviceInEnglish','AdviceInBangla');
            $query->when($keyword, function($query) use ($keyword){
                $query->where('AdviceCode', 'LIKE', "%".$keyword."%");
            });

            $query->when($limit, function($query) use($limit){
                $query->limit($limit);
            });

            $RefAdvice = $query->get();

            $status = [
                'code'=>200,
                'message'=>'Advice data get successfully!'
            ];
            return response()->json(['status'=>$status,'data'=>$RefAdvice]);

        }catch(\Exception $e){
            $status = [
                'code'=>403,
                'message'=> $e->getMessage()
            ];
            return response()->json(['status'=>$status]);
        }
    }
    //4c save
    public function patientS4cCreate(Request $request){
        DB::beginTransaction();
        try{
            $CurrentTime = Carbon::now();
            $DateTime =$CurrentTime->toDateTimeString();

            //Provesional diagnosis
            $ProvisionalDiagnosis = $request->ProvisionalDiagnosis;
            for($i=0;$i<count($ProvisionalDiagnosis); $i++){
               $ProvisionalD = new MDataProvisionalDiagnosis();
               $ProvisionalD->MDProvisionalDiagnosisId = Str::uuid();
               $ProvisionalD->PatientId = $ProvisionalDiagnosis[$i]['PatientId'];
               $ProvisionalD->CollectionDate = $DateTime;
               $ProvisionalD->RefProvisionalDiagnosisId = $ProvisionalDiagnosis[$i]['RefProvisionalDiagnosisId'];
               $ProvisionalD->Category = $ProvisionalDiagnosis[$i]['category'];
               $ProvisionalD->ProvisionalDiagnosis = $ProvisionalDiagnosis[$i]['provisionalDiagnosis'];
               $ProvisionalD->OtherProvisionalDiagnosis = $ProvisionalDiagnosis[$i]['otherProvisionalDiagnosis'];
               $ProvisionalD->DiagnosisStatus = $ProvisionalDiagnosis[$i]['diagnosisStatus'];
               $ProvisionalD->Status  = "A";
               $ProvisionalD->CreateDate  = $DateTime;
               $ProvisionalD->CreateUser  = $ProvisionalDiagnosis[$i]['CreateUser'];
               $ProvisionalD->UpdateDate  = $DateTime;
               $ProvisionalD->UpdateUser  = "";
               $ProvisionalD->OrgId  = $ProvisionalDiagnosis[$i]['OrgId'];
               $ProvisionalD->save();
            }    
            
            //Lab Investigations
            $LabInvestigations = $request->LabInvestigation;

            for($i=0;$i<count($LabInvestigations); $i++){
                $LabInvestigation = new MDataInvestigation();
                $LabInvestigation->MDInvestigationId = Str::uuid();
                $LabInvestigation->PatientId = $LabInvestigations[$i]['PatientId'];
                $LabInvestigation->CollectionDate = $DateTime;
                $LabInvestigation->InvestigationId = $LabInvestigations[$i]['investigationId'];
                $LabInvestigation->OtherInvestigation = $LabInvestigations[$i]['otherInvestigation'];
                $LabInvestigation->Instruction = $LabInvestigations[$i]['instruction'];
                $LabInvestigation->PositiveNegativeStatus = $LabInvestigations[$i]['positiveNegativeStatus'];
                $LabInvestigation->Status  = "A";
                $LabInvestigation->CreateDate  = $DateTime;
                $LabInvestigation->CreateUser  = $LabInvestigations[$i]['CreateUser'];
                $LabInvestigation->UpdateDate  = $DateTime;
                $LabInvestigation->UpdateUser  = "";
                $LabInvestigation->OrgId  = $LabInvestigations[$i]['OrgId'];
                $LabInvestigation->save();
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
                $MDataTreatmentSuggestion->DrugDurationValue = $TreatmentSuggestion[$i]['drugDurationValue'];
                $MDataTreatmentSuggestion->OtherDrug = $TreatmentSuggestion[$i]['otherDrug'];
                $MDataTreatmentSuggestion->SpecialInstruction = $TreatmentSuggestion[$i]['specialInstruction'];
                $MDataTreatmentSuggestion->RefInstructionId = $TreatmentSuggestion[$i]['refInstructionId'];
                $MDataTreatmentSuggestion->DrugDose = $TreatmentSuggestion[$i]['drugDose'];
                $MDataTreatmentSuggestion->Comment = $TreatmentSuggestion[$i]['comment'];
                $MDataTreatmentSuggestion->Status  = "A";
                $MDataTreatmentSuggestion->CreateDate  = $DateTime;
                $MDataTreatmentSuggestion->CreateUser  = $TreatmentSuggestion[$i]['CreateUser'];
                $MDataTreatmentSuggestion->UpdateDate  = $DateTime;
                $MDataTreatmentSuggestion->UpdateUser  = "";
                $MDataTreatmentSuggestion->OrgId  = $TreatmentSuggestion[$i]['OrgId'];
                $MDataTreatmentSuggestion->save();
            }    
            
            //Referral Section
            $Referral = $request->Referral;

            for($i=0;$i<count($Referral); $i++){
                $MDataPatientReferral = new MDataPatientReferral();
                $MDataPatientReferral->MDPatientReferralId = Str::uuid();
                $MDataPatientReferral->PatientId = $Referral[$i]['PatientId'];
                $MDataPatientReferral->RId = $Referral[$i]['rId'];
                $MDataPatientReferral->HealthCenterId = $Referral[$i]['healthCenterId'];
                $MDataPatientReferral->CollectionDate = $DateTime;
                $MDataPatientReferral->Status  = "A";
                $MDataPatientReferral->CreateDate  = $DateTime;
                $MDataPatientReferral->CreateUser  = $Referral[$i]['CreateUser'];
                $MDataPatientReferral->UpdateDate  = $DateTime;
                $MDataPatientReferral->UpdateUser  = "";
                $MDataPatientReferral->OrgId  = $Referral[$i]['OrgId'];
                $MDataPatientReferral->save();
            }   

            //Advice
            $Advice = $request->Advice;
            for($i=0;$i<count($Advice); $i++){
                $MDataAdvice = new MDataAdvice();
                $MDataAdvice->MDAdviceId = Str::uuid();
                $MDataAdvice->PatientId = $Advice[$i]['PatientId'];
                $MDataAdvice->CollectionDate = $DateTime;
                $MDataAdvice->AdviceId = $Advice[$i]['adviceId'];
                $MDataAdvice->Advice = $Advice[$i]['advice'];
                $MDataAdvice->Status  = "A";
                $MDataAdvice->CreateDate  = $DateTime;
                $MDataAdvice->CreateUser  = $Advice[$i]['CreateUser'];
                $MDataAdvice->UpdateDate  = $DateTime;
                $MDataAdvice->UpdateUser  = "";
                $MDataAdvice->OrgId  = $Advice[$i]['OrgId'];
                $MDataAdvice->save();
            }    

            //Follow up Dates
            $FollowUpDate = $request->FollowUpDate;
            for($i=0;$i<count($FollowUpDate); $i++){
                $MDataFollowUpDate = new MDataFollowUpDate();
                $MDataFollowUpDate->MDFollowUpDateId = Str::uuid();
                $MDataFollowUpDate->PatientId = $FollowUpDate[$i]['PatientId'];
                $MDataFollowUpDate->CollectionDate = $DateTime;
                $MDataFollowUpDate->FollowUpDate = $FollowUpDate[$i]['followUpDate'];
                $MDataFollowUpDate->Comment = $FollowUpDate[$i]['comment'];
                $MDataFollowUpDate->Status  = "A";
                $MDataFollowUpDate->CreateDate  = $DateTime;
                $MDataFollowUpDate->CreateUser  = $FollowUpDate[$i]['CreateUser'];
                $MDataFollowUpDate->UpdateDate  = $DateTime;
                $MDataFollowUpDate->UpdateUser  = "";
                $MDataFollowUpDate->OrgId  = $FollowUpDate[$i]['OrgId'];
                $MDataFollowUpDate->save();
            }    
            DB::commit();
            $status = [
                'code'=> 200,
                'message' =>'Station 4C saved successfully!'
               ];

           return response()->json($status);

        }
        catch(\Exception $e){
            // Rollback the transaction in case of an exception
            DB::rollBack();
            $status = [
                'code'=> 403,
                'message'=>$e->getMessage()
            ];

            return response()->json(['status'=>$status]);

        }
    }
}
