<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Models\MDataCRA;
use DB;
use Carbon\Carbon;
use App\Models\Station;
use App\Models\PrescriptionCreation;

class Station4EController extends Controller
{
    public function getPrescriptionCreation(){
        
        try{
            $PrescriptionCreation = PrescriptionCreation::all();
            $status = [
                'code' => 200,
                'message' => 'Prescription Creation Data Get Successfully'
            ];
            return response()->json([
                'status' => $status,
                'PrescriptionCreation' => $PrescriptionCreation,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava data');
    }
    public function patientConRisk(Request $request){

        $PatientId=$request->PatientId;
        $OrgId=$request->OrgId;
        try{

        $currentTime = Carbon::now();
        $date=$currentTime->toDateTimeString();

        //patient start
        $MDataCRA = new MDataCRA();
        $MDataCRA->PatientId = $PatientId;
        $MDataCRA->Age = $request->Age;
        $MDataCRA->Sex = $request->Sex;
        $MDataCRA->BMI = $request->BMI;
        $MDataCRA->CigaretteSmoker = $request->CigaretteSmoker;
        $MDataCRA->SystolicBloodPressure = $request->SystolicBloodPressure;
        $MDataCRA->OnBloodPressureMedication = $request->OnBloodPressureMedication;
        $MDataCRA->Diabetese = $request->Diabetese;
        $MDataCRA->Result = $request->Result;
        $MDataCRA->TotalCholesterol = $request->TotalCholesterol;
        $MDataCRA->HDLCholesterol = $request->HDLCholesterol;
        $MDataCRA->CRAType = $request->CRAType;
        $MDataCRA->Status = 1;
        $MDataCRA->CreateDate = $date;
        $MDataCRA->CreateUser = $request->CreateUser;
        $MDataCRA->UpdateDate = $date;
        $MDataCRA->UpdateUser = "";
        $MDataCRA->OrgId = $OrgId;
        $MDataCRA->save();
        //patient End

        //station start

        Station::where('PatientId','=' ,$PatientId)->update(['StationStatus' => '1']);
        
        //station End
        //PrescriptionCreation Start

        $PC = new PrescriptionCreation();
        $PC->PatientId = $PatientId;
        $PC->PrescriptionId = $request->PrescriptionId;
        $PC->EmployeeId = $request->EmployeeId;
        $PC->Status = 1;
        $PC->CreateUser = $request->CreateUser;
        $PC->CreateDate = $date;
        $PC->UpdateDate = $date;
        $PC->UpdateUser = "";
        $PC->OrgId = $OrgId;
        $PC->save();

        //PrescriptionCreation End
        
        
        
        return response()->json(['status' => true, 'code'=>200, 'message'=>'Station 4E Save successfully'], 200);

        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  

        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava data');
    }  
}
