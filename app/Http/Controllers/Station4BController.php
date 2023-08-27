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
            $PatientObsGynae = new MDataPatientObsGynae();
            $PatientObsGynae->MDPatientObsGynaeId = Str::uuid();
            $PatientObsGynae->PatientId = $request->ObstetricsInfoChildMoralityCervicalCancer['PatientId'];
            $PatientObsGynae->CollectionDate = $DateTime;
            $PatientObsGynae->Gravida = $request->ObstetricsInfoChildMoralityCervicalCancer['gravida'];
            $PatientObsGynae->Para = $request->ObstetricsInfoChildMoralityCervicalCancer['para'];
            $PatientObsGynae->StillBirth = $request->ObstetricsInfoChildMoralityCervicalCancer['stillBirth'];
            $PatientObsGynae->MiscarraigeOrAbortion = $request->ObstetricsInfoChildMoralityCervicalCancer['miscarraigeOrAbortion'];
            $PatientObsGynae->MR = $request->ObstetricsInfoChildMoralityCervicalCancer['mr'];
            $PatientObsGynae->LivingMale = $request->ObstetricsInfoChildMoralityCervicalCancer['livingMale'];
            $PatientObsGynae->LivingFemale = $request->ObstetricsInfoChildMoralityCervicalCancer['livingFemale'];

            if($request->ObstetricsInfoChildMoralityCervicalCancer['male']==1){
                $PatientObsGynae->ChildMortality0To1 = "M";
            }
            elseif($request->ObstetricsInfoChildMoralityCervicalCancer['male']==2){
                $PatientObsGynae->ChildMortalityBelow5 = "M";
            }
            elseif($request->ObstetricsInfoChildMoralityCervicalCancer['male']==3){
                $PatientObsGynae->ChildMortalityOver5 = "M";
            }
            if($request->ObstetricsInfoChildMoralityCervicalCancer['female']==1){
                $PatientObsGynae->ChildMortality0To1 = "F";
            } 
            elseif($request->ObstetricsInfoChildMoralityCervicalCancer['female']==2){
                $PatientObsGynae->ChildMortalityBelow5 = "F";
            }
            elseif($request->ObstetricsInfoChildMoralityCervicalCancer['female']==3){
                $PatientObsGynae->ChildMortalityOver5 = "F";
            }
            $PatientObsGynae->IsPregnant = $request->ObstetricsInfoChildMoralityCervicalCancer['isPregnant'];
            $PatientObsGynae->LMP = $request->ObstetricsInfoChildMoralityCervicalCancer['lmp'];
            $PatientObsGynae->ContraceptionMethodId = $request->ObstetricsInfoChildMoralityCervicalCancer['contraceptionMethodId'];
            $PatientObsGynae->Comment = $request->ObstetricsInfoChildMoralityCervicalCancer['comment'];
            $PatientObsGynae->MenstruationProductId = $request->ObstetricsInfoChildMoralityCervicalCancer['menstruationProductId'];
            $PatientObsGynae->MenstruationProductUsageTimeId = $request->ObstetricsInfoChildMoralityCervicalCancer['menstruationProductUsageTimeId'];
            $PatientObsGynae->Status = "A";
            $PatientObsGynae->CreateUser = $request->ObstetricsInfoChildMoralityCervicalCancer['CreateUser'];
            $PatientObsGynae->CreateDate = $DateTime;
            $PatientObsGynae->UpdateUser = "";
            $PatientObsGynae->UpdateDate =  $DateTime;
            $PatientObsGynae->OrgId = $request->ObstetricsInfoChildMoralityCervicalCancer['OrgId'];
            return $PatientObsGynae;
            $PatientObsGynae->save();

            $MDataPatientPregnancy = new MDataPatientPregnancy();
            $MDataPatientPregnancy->MDPatientPregnancyId = Str::uuid();
            $MDataPatientPregnancy->PatientId = $request->MenstrualHistory['PatientId'];
            $MDataPatientPregnancy->CollectionDate = $DateTime;
            $MDataPatientPregnancy->LMP = $request->MenstrualHistory['lmp'];
            $MDataPatientPregnancy->Status = "A";
            $MDataPatientPregnancy->CreateUser = $request->MenstrualHistory['CreateUser'];
            $MDataPatientPregnancy->CreateDate = $DateTime;
            $MDataPatientPregnancy->UpdateUser = "";
            $MDataPatientPregnancy->UpdateDate =  $DateTime;
            $MDataPatientPregnancy->OrgId = $request->MenstrualHistory['OrgId'];
            $MDataPatientPregnancy->save();  

            //Cervical cancer screening
            $MDataPatientCervicalCancer = new MDataPatientCervicalCancer();
            $MDataPatientCervicalCancer->MDataPatientCervicalCancerId = Str::uuid();
            $MDataPatientCervicalCancer->PatientId = $request->CervicalCancerScreening['PatientId'];
            $MDataPatientCervicalCancer->CollectionDate = $DateTime;
            $MDataPatientCervicalCancer->CCScreeningDiagnosis = $request->CervicalCancerScreening['ccScreeningDiagnosis'];
            $MDataPatientCervicalCancer->CCScreeningResultStatus = $request->CervicalCancerScreening['ccScreeningResultStatus'];
            $MDataPatientCervicalCancer->ReferralBiopsyStatus = $request->CervicalCancerScreening['referralBiopsyStatus'];
            $MDataPatientCervicalCancer->Status = "A";
            $MDataPatientCervicalCancer->CreateUser = $request->CervicalCancerScreening['CreateUser'];
            $MDataPatientCervicalCancer->CreateDate = $DateTime;
            $MDataPatientCervicalCancer->UpdateUser = "";
            $MDataPatientCervicalCancer->UpdateDate =  $DateTime;
            $MDataPatientCervicalCancer->OrgId = $request->CervicalCancerScreening['OrgId'];
            $MDataPatientCervicalCancer->save();

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
