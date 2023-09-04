<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\RefContraceptionMethod;
use App\Models\RefMenstruationProduct;
use App\Models\RefMnstProductUsageTime;
use App\Models\MDataPatientObsGynae;
use App\Models\MDataPatientPregnancy;
use App\Models\MDataPatientCervicalCancer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class Station4BController extends Controller
{
    
    public function patientS4bCreate(Request $request){

       
        DB::beginTransaction();

        try{
            
            $CurrentTime = Carbon::now();
            $DateTime = $CurrentTime->toDateTimeString();
            //Obstetrics Information 
            $ObstetricsInfoChildMoralityCervicalCancer = $request->ObstetricsInfoChildMoralityCervicalCancer;
            for($i=0;$i<count($ObstetricsInfoChildMoralityCervicalCancer); $i++){
            $PatientObsGynae = new MDataPatientObsGynae();
            $PatientObsGynae->MDPatientObsGynaeId = Str::uuid();
            $PatientObsGynae->PatientId = $ObstetricsInfoChildMoralityCervicalCancer[$i]['PatientId'];
         
            $PatientObsGynae->CollectionDate = $DateTime;
            $PatientObsGynae->Gravida = $ObstetricsInfoChildMoralityCervicalCancer[$i]['gravida'];
            $PatientObsGynae->Para = $ObstetricsInfoChildMoralityCervicalCancer[$i]['para'];
            $PatientObsGynae->StillBirth = $ObstetricsInfoChildMoralityCervicalCancer[$i]['stillBirth'];
            $PatientObsGynae->MiscarraigeOrAbortion = $ObstetricsInfoChildMoralityCervicalCancer[$i]['miscarraigeOrAbortion'];
            $PatientObsGynae->MR = $ObstetricsInfoChildMoralityCervicalCancer[$i]['mr'];
            $PatientObsGynae->LivingMale = $ObstetricsInfoChildMoralityCervicalCancer[$i]['livingMale'];
            $PatientObsGynae->LivingFemale = $ObstetricsInfoChildMoralityCervicalCancer[$i]['livingFemale'];

            if($ObstetricsInfoChildMoralityCervicalCancer[$i]['male']==1){
                $PatientObsGynae->ChildMortality0To1 = "M";
            }
            elseif($ObstetricsInfoChildMoralityCervicalCancer[$i]['male']==2){
                $PatientObsGynae->ChildMortalityBelow5 = "M";
            }
            elseif($ObstetricsInfoChildMoralityCervicalCancer[$i]['male']==3){
                $PatientObsGynae->ChildMortalityOver5 = "M";
            }
            if($ObstetricsInfoChildMoralityCervicalCancer[$i]['female']==1){
                $PatientObsGynae->ChildMortality0To1 = "F";
            } 
            elseif($ObstetricsInfoChildMoralityCervicalCancer[$i]['female']==2){
                $PatientObsGynae->ChildMortalityBelow5 = "F";
            }
            elseif($ObstetricsInfoChildMoralityCervicalCancer[$i]['female']==3){
                $PatientObsGynae->ChildMortalityOver5 = "F";
            }
            $PatientObsGynae->IsPregnant = $ObstetricsInfoChildMoralityCervicalCancer[$i]['isPregnant'];
            $PatientObsGynae->LMP = $ObstetricsInfoChildMoralityCervicalCancer[$i]['lmp'];
            $PatientObsGynae->ContraceptionMethodId = $ObstetricsInfoChildMoralityCervicalCancer[$i]['contraceptionMethodId'];
            $PatientObsGynae->Comment = $ObstetricsInfoChildMoralityCervicalCancer[$i]['comment'];
            $PatientObsGynae->MenstruationProductId = $ObstetricsInfoChildMoralityCervicalCancer[$i]['menstruationProductId'];
            $PatientObsGynae->MenstruationProductUsageTimeId = $ObstetricsInfoChildMoralityCervicalCancer[$i]['menstruationProductUsageTimeId'];
            $PatientObsGynae->Status = "A";
            $PatientObsGynae->CreateUser = $ObstetricsInfoChildMoralityCervicalCancer[$i]['CreateUser'];
            $PatientObsGynae->CreateDate = $DateTime;
            $PatientObsGynae->UpdateUser = "";
            $PatientObsGynae->UpdateDate =  $DateTime;
            $PatientObsGynae->OrgId = $ObstetricsInfoChildMoralityCervicalCancer[$i]['OrgId'];
            $PatientObsGynae->save();

            }
            $MenstrualHistory = $request->MenstrualHistory;
            for($i=0;$i<count($MenstrualHistory); $i++){

            $MDataPatientPregnancy = new MDataPatientPregnancy();
            $MDataPatientPregnancy->MDPatientPregnancyId = Str::uuid();
            $MDataPatientPregnancy->PatientId = $MenstrualHistory[$i]['PatientId'];
            $MDataPatientPregnancy->CollectionDate = $DateTime;
            $MDataPatientPregnancy->LMP = $MenstrualHistory[$i]['lmp'];
            $MDataPatientPregnancy->Status = "A";
            $MDataPatientPregnancy->CreateUser = $MenstrualHistory[$i]['CreateUser'];
            $MDataPatientPregnancy->CreateDate = $DateTime;
            $MDataPatientPregnancy->UpdateUser = "";
            $MDataPatientPregnancy->UpdateDate =  $DateTime;
            $MDataPatientPregnancy->OrgId = $MenstrualHistory[$i]['OrgId'];
            $MDataPatientPregnancy->save();  
            }
            $CervicalCancerScreening = $request->CervicalCancerScreening;
            for($i=0;$i<count($CervicalCancerScreening); $i++){
            //Cervical cancer screening
            $MDataPatientCervicalCancer = new MDataPatientCervicalCancer();
            $MDataPatientCervicalCancer->MDataPatientCervicalCancerId = Str::uuid();
            $MDataPatientCervicalCancer->PatientId = $CervicalCancerScreening[$i]['PatientId'];
            $MDataPatientCervicalCancer->CollectionDate = $DateTime;
            $MDataPatientCervicalCancer->CCScreeningDiagnosis = $CervicalCancerScreening[$i]['ccScreeningDiagnosis'];
            $MDataPatientCervicalCancer->CCScreeningResultStatus = $CervicalCancerScreening[$i]['ccScreeningResultStatus'];
            $MDataPatientCervicalCancer->ReferralBiopsyStatus = $CervicalCancerScreening[$i]['referralBiopsyStatus'];
            $MDataPatientCervicalCancer->Status = "A";
            $MDataPatientCervicalCancer->CreateUser = $CervicalCancerScreening[$i]['CreateUser'];
            $MDataPatientCervicalCancer->CreateDate = $DateTime;
            $MDataPatientCervicalCancer->UpdateUser = "";
            $MDataPatientCervicalCancer->UpdateDate =  $DateTime;
            $MDataPatientCervicalCancer->OrgId = $CervicalCancerScreening[$i]['OrgId'];
            $MDataPatientCervicalCancer->save();

            }

            // Commit [save] the transaction
            DB::commit(); 

            $status = [
                'code'=> 200,
                'message' =>'Station 4B data saved successfully'
               ];

            return response()->json(['status'=>$status, 'data'=>$MDataPatientCervicalCancer]); 

        }catch(\Exception $e){

            // Rollback the transaction in case of an exception
            DB::rollBack();

            $status = [
                'code' =>403,
                'message' =>$e->getMessage()
            ];

            return response()->json(['status'=>$status]);
        }
    }
    public function patientS4bMensContraception(){
        try{
            $data = RefContraceptionMethod::select('ContraceptionMethodId','ContraceptionMethodCode')->get();
            $status = [
                'code' => 200,
                'message' =>'Contraception method get successfully'
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
    
    public function patientS4bDuringMenstruation(){
        try{
            $data = RefMenstruationProduct::select('MenstruationProductId','MenstruationProductCode')->get();
            $status = [
                'code' => 200,
                'message' =>'Menstruation get successfully'
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
    
    public function patientS4bHowOften(){
        try{
            $data = RefMnstProductUsageTime::select('MenstruationProductUsageTimeId','MenstruationProductUsageTimeCode')->get();
            $status = [
                'code' => 200,
                'message' =>'Menstruation product usage get successfully'
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
