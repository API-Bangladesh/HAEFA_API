<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use App\Models\MDataBP;
use App\Models\MDataHeightWeight;
use App\Models\MDataGlucoseHb;
use App\Models\MDataPatientCCDetails;
use App\Models\MDataPhysicalExamGeneral;
use App\Models\MDataPhysicalFinding;
use App\Models\MDataRxDetails;
use App\Models\MDataInvestigation;
use App\Models\PrescriptionCreation;

class PrescriptionController extends Controller
{
    public function prescription(Request $request){

        
        
        $prescriptionDetails=PrescriptionCreation::where('patientId','=',$request->patientId)->latest('CreateDate')->first();
        $create_date_time = $prescriptionDetails->CreateDate;
        $create_date = date('Y-m-d',strtotime($create_date_time));

        $patient_id=$request->patientId;
        

        $patientDetails=Patient::with('Gender','MartitalStatus')->where('PatientId','=',$request->patientId)->get();

        $prescriptionCreation= DB::select("SELECT TOP 1 MAX(PPC.PrescriptionId) AS PrescriptionId,MAX(E.FirstName) AS FirstName,MAX(E.LastName) AS LastName,MAX(E.Designation) AS Designation,MAX(E.EmployeeSignature) AS EmployeeSignature, CAST(PPC.CreateDate AS date) as CreateDate
            FROM PrescriptionCreation as PPC 
            INNER JOIN Employee as E on E.EmployeeId = PPC.EmployeeId
            WHERE PatientId = '$patient_id' AND CAST(PPC.CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM PrescriptionCreation WHERE PatientId = '$request->patientId'
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY PPC.CreateDate ORDER BY PPC.CreateDate DESC");


        $Complaints= DB::select("SELECT PC.ChiefComplain AS ChiefComplain, PC.CCDurationValue AS CCDurationValue,
        PC.OtherCC AS OtherCC, RD.DurationInEnglish AS DurationInEnglish, PC.CreateDate
        FROM MDataPatientCCDetails as PC
        INNER JOIN RefDuration as RD on RD.DurationId = PC.DurationId
        WHERE PC.PatientId ='$patient_id' AND CAST(PC.CreateDate AS date) ='$create_date'");

        $HeightWeight= DB::select("SELECT TOP 1 Height, Weight, BMI, BMIStatus, CreateDate FROM MDataHeightWeight WHERE PatientId ='$patient_id' AND CAST(CreateDate AS date)='$create_date' ORDER BY CreateDate DESC");

        $BP= DB::select("SELECT TOP 1 BPSystolic1, BPDiastolic1, BPSystolic2,BPDiastolic2,HeartRate,CurrentTemparature,CreateDate
        FROM MDataBP
        WHERE PatientId ='$patient_id' AND  CAST(CreateDate AS date) = '$create_date' ORDER BY CreateDate DESC");

        $GlucoseHb= DB::select("SELECT TOP 1 RBG, FBG, Hemoglobin, HrsFromLastEat, CreateDate
        FROM MDataGlucoseHb
        WHERE PatientId ='$patient_id' AND  CAST(CreateDate AS date)='$create_date' ORDER BY CreateDate DESC");

        $ProvisionalDx= DB::select("SELECT ProvisionalDiagnosis, DiagnosisStatus, OtherProvisionalDiagnosis, CreateDate
        FROM MDataProvisionalDiagnosis
        WHERE PatientId ='$patient_id' AND  CAST(CreateDate AS date) ='$create_date'ORDER BY CAST(CreateDate AS date) DESC");

        $Investigation= DB::select("SELECT RI.Investigation, I.OtherInvestigation, I.CreateDate
        FROM MDataInvestigation as I
        INNER JOIN RefLabInvestigation as RI on RI.RefLabInvestigationId = I.InvestigationId
        WHERE I.PatientId ='$patient_id' AND  CAST(I.CreateDate AS date)='$create_date' ORDER BY CAST(I.CreateDate AS date) DESC");

        $Treatment= DB::select("SELECT T.Frequency, T.DrugDurationValue, T.OtherDrug, T.SpecialInstruction , T.DrugDose, Dr.DrugCode, Dr.Description, Ins.InstructionInBangla, T.CreateDate
        FROM MDataTreatmentSuggestion as T
        INNER JOIN RefDrug as Dr on Dr.DrugId = T.DrugId
        INNER JOIN RefInstruction as Ins on Ins.RefInstructionId = T.RefInstructionId
        WHERE T.PatientId ='$patient_id' AND  CAST(T.CreateDate AS date)='$create_date' ORDER BY CAST(T.CreateDate AS date) DESC");

        $Advice= DB::select("SELECT RA.AdviceInBangla, RA.AdviceInEnglish, A.CreateDate
        FROM MDataAdvice as A
        INNER JOIN RefAdvice as RA on RA.AdviceId = A.AdviceId
        WHERE A.PatientId ='$patient_id' AND  CAST(A.CreateDate AS date)='$create_date' ORDER BY CAST(A.CreateDate AS date) DESC");

        $PatientReferral= DB::select("SELECT RR.Description, HC.HealthCenterName, PR.CreateDate
        FROM MDataPatientReferral as PR
        INNER JOIN RefReferral as RR on RR.RId = PR.RId
        INNER JOIN HealthCenter as HC on HC.HealthCenterId = PR.HealthCenterId
        WHERE PR.PatientId ='$patient_id' AND  CAST(PR.CreateDate AS date)='$create_date' ORDER BY CAST(PR.CreateDate AS date) DESC");

        $FollowUpDate= DB::select("SELECT TOP 1 FollowUpDate, Comment, CreateDate
        FROM MDataFollowUpDate
        WHERE PatientId ='$patient_id' AND  CAST(CreateDate AS date)='$create_date' ORDER BY CreateDate DESC");



        return response()->json([
            'message' => 'Final Prescription',
            'code'=>200,
            'PatientDetails'=>$patientDetails,
            'prescriptionCreation'=>$prescriptionCreation,
            'Complaints'=>$Complaints,
            'HeightWeight'=>$HeightWeight,
            'BP'=>$BP,
            'GlucoseHb'=>$GlucoseHb,
            'ProvisionalDx'=>$ProvisionalDx,
            'Investigation'=>$Investigation,
            'Treatment'=>$Treatment,
            'Advice'=>$Advice,
            'PatientReferral'=>$PatientReferral,
            'FollowUpDate'=>$FollowUpDate,

        ],200);

        
        

        
    }
}
