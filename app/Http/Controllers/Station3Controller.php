<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Models\MDataGlucoseHb;
use DB;
use Carbon\Carbon;
use App\Models\Station;

class Station3Controller extends Controller
{
    public function patientGlucoseHbCreate(Request $request){

        $PatientId=$request->PatientId;
        $OrgId=$request->OrgId;
        try{

        $currentTime = Carbon::now();
        $date=$currentTime->toDateTimeString();

        //patient start
        $MDataGlucoseHb = new MDataGlucoseHb();
        $MDataGlucoseHb->PatientId = $PatientId;
        $MDataGlucoseHb->CollectionDate = $date;
        $MDataGlucoseHb->RBG = $request->RBG;
        $MDataGlucoseHb->FBG = $request->FBG;
        $MDataGlucoseHb->HrsFromLastEat = $request->HrsFromLastEat;
        $MDataGlucoseHb->Hemoglobin = $request->Hemoglobin;
        $MDataGlucoseHb->Status = 1;
        $MDataGlucoseHb->CreateDate = $date;
        $MDataGlucoseHb->CreateUser = $request->CreateUser;
        $MDataGlucoseHb->UpdateDate = $date;
        $MDataGlucoseHb->UpdateUser = "";
        $MDataGlucoseHb->OrgId = $OrgId;
        $MDataGlucoseHb->save();
        //patient End

        //station start

        Station::where('PatientId','=' ,$PatientId)->update(['StationStatus' => '4']);
        
        //station End
        
        
        return response()->json(['status' => true, 'code'=>200, 'message'=>'Station 3 Save successfully'], 200);

        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  

        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava data');
    }  
}
