<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Models\MDataBP;
use DB;
use Carbon\Carbon;
use App\Models\Station;

class Station2Controller extends Controller
{
    public function patientMDataBPCreate(Request $request){
        $PatientId=$request->PatientId;
        $OrgId=$request->OrgId;
        
        try{
        

        $currentTime = Carbon::now();
        $date=$currentTime->toDateTimeString();

        //patient start
        $MDataBP = new MDataBP();
        $MDataBP->PatientId = $PatientId;
        $MDataBP->CollectionDate = $date;
        $MDataBP->HeartRate = $request->HeartRate;
        $MDataBP->BPSystolic1 = $request->BPSystolic1;
        $MDataBP->BPDiastolic1 = $request->BPDiastolic1;
        $MDataBP->BPSystolic2 = $request->BPSystolic2;
        $MDataBP->BPDiastolic2 = $request->BPDiastolic2;
        $MDataBP->CurrentTemparature = $request->CurrentTemparature;
        $MDataBP->RespiratoryRate = $request->RespiratoryRate;
        $MDataBP->SpO2Rate = $request->SpO2Rate;
        $MDataBP->IndicatesNormalOxygenSaturation = $request->IndicatesNormalOxygenSaturation;
        $MDataBP->Status = 1;
        $MDataBP->CreateDate = $date;
        $MDataBP->CreateUser = $request->CreateUser;
        $MDataBP->UpdateDate = $date;
        $MDataBP->UpdateUser = "";
        $MDataBP->OrgId = $OrgId;
        $MDataBP->save();
        //patient End

        //patient Registration id wise patient id

        //station start

        Station::where('PatientId','=' ,$PatientId)->update(['StationStatus' => '3']);
        
        //station End
        
        
        return response()->json(['status' => true, 'code'=>200, 'message'=>'Station 2 Save successfully'], 200);

        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  

        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava data');
    }  
}
