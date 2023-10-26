<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\RefTBSymptoms;
use App\Models\RefTBEFinding;
use App\Models\RefTBEPastEvidenced;
use App\Models\RefTBPastHistory;
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
           $data = RefTBPastHistory::select('TBHistoryId','TBHistoryIdCode')->orderBy('SortOrder', 'asc')->get();

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

        $TBCatData= DB::select("SELECT RD.DrugCode AS DrugCode,RC.Frequency, RC.Hour, RC.DrugDurationValue,RC.DrugDose,RC.OtherDrug,RC.SpecialInstruction,RC.Comment1,RC.Comment2,RC.CatMedicineStatus,RC.CreateDate AS CreateDate
            FROM RefCat as RC
            INNER JOIN RefDrug as RD on RD.DrugId = RC.DrugId
            WHERE CatType = '$request->CatType'");

        return response()->json([
            'message' => 'TB Cat All Data',
            'code'=>200,
            'TBCatData'=>$TBCatData,
        ],200);
    }
    


}
