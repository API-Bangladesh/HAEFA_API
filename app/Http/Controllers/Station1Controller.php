<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Models\RefBloodGroup;
use App\Models\MDataHeightWeight;
use DB;
use Carbon\Carbon;
use App\Models\Station;

class Station1Controller extends Controller
{
    /**
     * @method_name :- method_name
     * -------------------------------------------------------- 
     * @param  :-  {{}|any}
     * ?return :-  {{}|any}
     * author :-  API
     * created_by:- Abul Kalam Azad
     * created_at:- 28/05/2023 09:22:54
     * description :- Station 1 All Information.
     */
    public function Blood(){
        try{
            $BloodGroup = RefBloodGroup::select('RefBloodGroupId','BloodGroupCode')->get();
            $status = [
                'code' => 200,
                'message' => 'Blood Group Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'BloodGroup' => $BloodGroup,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava data');
    }

    public function patientHeightWidthCreate(Request $request){

        $PatientId=$request->PatientId;
        $OrgId=$request->OrgId;
        $usersID=$request->usersID;
        try{

        $currentTime = Carbon::now();
        $date=$currentTime->toDateTimeString();

        //patient start
        $heightWeight = new MDataHeightWeight();
        $heightWeight->PatientId = $PatientId;
        $heightWeight->CollectionDate = $date;
        $heightWeight->Height = $request->Height;
        $heightWeight->Weight = $request->Weight;
        $heightWeight->BMI = $request->BMI;
        $heightWeight->BMIStatus = $request->BMIClass;
        $heightWeight->MUAC = $request->MUAC;
        $heightWeight->MUACStatus = $request->MUACClass;
        $heightWeight->RefBloodGroupId = $request->RefBloodGroupId;
        $heightWeight->Status = 1;
        $heightWeight->CreateDate = $date;
        $heightWeight->CreateUser = $request->CreateUser;
        $heightWeight->UpdateDate = $date;
        $heightWeight->UpdateUser = "";
        $heightWeight->OrgId = $OrgId;
        $heightWeight->save();
        //patient End

        //patient Registration id wise patient id
      

        //station start

        Station::where('PatientId','=' ,$PatientId)->update(['StationStatus' => '2']);
        
        //station End
        
        return response()->json(['status' => true, 'code'=>200, 'message'=>'Station 1 Save successfully'], 200);
        

        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  

        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava Patient data');
    }   
}
