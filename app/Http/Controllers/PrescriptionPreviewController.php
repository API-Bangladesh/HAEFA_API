<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class PrescriptionPreviewController extends Controller
{
    public function patientPrescriptionPreview(Request $request){
        $patientDetails=Patient::with('Gender','MartitalStatus')->where('PatientId','=',$request->patientId)->get();

        $Complaints= DB::select("SELECT MAX(ChiefComplain) AS ChiefComplain, CAST(CreateDate AS date) as CreateDate
            FROM MDataPatientCCDetails WHERE PatientId = '$request->patientId' AND CAST(CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM MDataPatientCCDetails
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY CreateDate ORDER BY CreateDate");

        $HeightWeight= DB::select("SELECT TOP 1 MAX(Height) AS Height, MAX(Weight) AS Weight, MAX(BMI) AS BMI, MAX(BMIStatus) AS BMIStatus, CAST(CreateDate AS date) as CreateDate
            FROM MDataHeightWeight WHERE PatientId = '$request->patientId' AND CAST(CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM MDataHeightWeight
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY CreateDate ORDER BY CreateDate");
        
        $BP= DB::select("SELECT TOP 1 MAX(BPSystolic1) AS BPSystolic1, MAX(BPDiastolic1) AS BPDiastolic1, MAX(BPSystolic2) AS BPSystolic2, MAX(BPDiastolic2) AS BPDiastolic2, MAX(HeartRate) AS HeartRate, MAX(CurrentTemparature) AS CurrentTemparature, CAST(CreateDate AS date) as CreateDate
            FROM MDataBP WHERE PatientId = '$request->patientId' AND CAST(CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM MDataBP
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY CreateDate ORDER BY CreateDate");
        
        $GlucoseHb = DB::select("SELECT TOP 1 MAX(RBG) AS RBG, MAX(FBG) AS FBG, MAX(Hemoglobin) AS Hemoglobin, MAX(HrsFromLastEat) AS HrsFromLastEat, CAST(CreateDate AS date) as CreateDate
            FROM MDataGlucoseHb WHERE PatientId = '$request->patientId' AND CAST(CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM MDataGlucoseHb
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY CreateDate ORDER BY CreateDate");

        $ProvisionalDx = DB::select("SELECT MAX(ProvisionalDiagnosis) AS ProvisionalDiagnosis, MAX(DiagnosisStatus) AS DiagnosisStatus, MAX(OtherProvisionalDiagnosis) AS OtherProvisionalDiagnosis, CAST(CreateDate AS date) as CreateDate
        FROM MDataProvisionalDiagnosis WHERE PatientId = '$request->patientId' AND CAST(CreateDate AS date) 
        = CAST(
            (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
            FROM MDataProvisionalDiagnosis
            GROUP BY CAST(CreateDate AS date)
            ORDER BY MaxCreateDate DESC)
            AS date) GROUP BY CreateDate ORDER BY CreateDate");


       $Investigation= DB::select("SELECT  MAX(RI.Investigation) AS Investigation, MAX(I.OtherInvestigation) AS OtherInvestigation, CAST(I.CreateDate AS date) as CreateDate
            FROM MDataInvestigation as I
            INNER JOIN RefLabInvestigation as RI on RI.RefLabInvestigationId = I.InvestigationId
            WHERE PatientId = '$request->patientId' AND CAST(I.CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM MDataInvestigation
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY I.CreateDate ORDER BY I.CreateDate");


        $Treatment= DB::select("SELECT MAX(T.Frequency) AS Frequency, MAX(T.DrugDurationValue) AS DrugDurationValue,MAX(T.OtherDrug) AS OtherDrug,MAX(T.Hourly) AS Hourly, MAX(Dr.DrugCode) AS DrugCode, MAX(Dr.DrugDose) AS DrugDose, MAX(Ins.InstructionInBangla) AS InstructionInBangla, CAST(T.CreateDate AS date) as CreateDate
            FROM MDataTreatmentSuggestion as T
            INNER JOIN RefDrug as Dr on Dr.DrugId = T.DrugId
            INNER JOIN RefInstruction as Ins on Ins.RefInstructionId = T.RefInstructionId
            WHERE PatientId = '$request->patientId' AND CAST(T.CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM MDataTreatmentSuggestion
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY T.CreateDate ORDER BY T.CreateDate");


        $Advice= DB::select("SELECT MAX(RA.AdviceInBangla) AS AdviceInBangla, MAX(RA.AdviceInEnglish) AS AdviceInEnglish, CAST(A.CreateDate AS date) as CreateDate
            FROM MDataAdvice as A
            INNER JOIN RefAdvice as RA on RA.AdviceId = A.AdviceId
            WHERE PatientId = '$request->patientId' AND CAST(A.CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM MDataAdvice
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY A.CreateDate ORDER BY A.CreateDate");


        $PatientReferral= DB::select("SELECT MAX(RR.Description) AS Description, MAX(HC.HealthCenterName) AS HealthCenterName, CAST(PR.CreateDate AS date) as CreateDate
            FROM MDataPatientReferral as PR
            INNER JOIN RefReferral as RR on RR.RId = PR.RId
            INNER JOIN HealthCenter as HC on HC.HealthCenterId = PR.HealthCenterId
            WHERE PatientId = '$request->patientId' AND CAST(PR.CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM MDataPatientReferral
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY PR.CreateDate ORDER BY PR.CreateDate");

        

        $FollowUpDate= DB::select("SELECT MAX(FD. FollowUpDate) AS FollowUpDate, MAX(FD.Comment) AS Comment, CAST(FD.CreateDate AS date) as CreateDate
            FROM MDataFollowUpDate as FD
            WHERE PatientId = '$request->patientId' AND CAST(FD.CreateDate AS date) 
            = CAST(
                (SELECT TOP 1 MAX(CreateDate) AS MaxCreateDate
                FROM MDataPatientReferral
                GROUP BY CAST(CreateDate AS date)
                ORDER BY MaxCreateDate DESC)
                AS date) GROUP BY FD.CreateDate ORDER BY FD.CreateDate");


        return response()->json([
            'message' => 'Prescription Preview',
            'code'=>200,
            'PatientDetails'=>$patientDetails,
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

    public function patientPrescriptionPreviewAllData(Request $request){

        

        $HeightWeight= DB::select("SELECT Height, Weight, BMI, BMIStatus,MUAC,MUACStatus, CreateDate
            FROM MDataHeightWeight WHERE PatientId = '$request->patientId'");
        
        $BP= DB::select("SELECT BPSystolic1, BPDiastolic1, BPSystolic2, BPDiastolic2, HeartRate,CurrentTemparature,RespiratoryRate,SpO2Rate,IndicatesNormalOxygenSaturation, CurrentTemparature, CreateDate
            FROM MDataBP WHERE PatientId = '$request->patientId'");
        
        $GlucoseHb = DB::select("SELECT RBG, FBG, Hemoglobin, HrsFromLastEat, CreateDate
            FROM MDataGlucoseHb WHERE PatientId = '$request->patientId'");

        $ProvisionalDx = DB::select("SELECT ProvisionalDiagnosis, DiagnosisStatus, OtherProvisionalDiagnosis, CreateDate
        FROM MDataProvisionalDiagnosis WHERE PatientId = '$request->patientId'");

        $Complaints= DB::select("SELECT ChiefComplain, CreateDate
        FROM MDataPatientCCDetails WHERE PatientId = '$request->patientId'");

        $GeneralFindings= DB::select("SELECT AnemiaSeverity, JaundiceSeverity, EdemaSeverity, IsLymphNodesWithPalpable, LymphNodesWithPalpableSite, LymphNodesWithPalpable,LymphNodesWithPalpableSize,IsHeartWithNAD,HeartWithNAD,IsLungsWithNAD,LungsWithNAD,OtherSymptom,Cyanosis,CreateDate FROM MDataPhysicalExamGeneral WHERE PatientId = '$request->patientId'");

        $PhysicalFindings= DB::select("SELECT PhysicalFinding, CreateDate FROM MDataPhysicalFinding WHERE PatientId = '$request->patientId'");

        $RxTaken= DB::select("SELECT Rx, RxDurationValue, AllergyToMedication, Dose, FrequencyHour, Status, CreateDate FROM MDataRxDetails WHERE PatientId = '$request->patientId'");

        $PatientPresentllness= DB::select("SELECT RI.IllnessCode AS IllnessCode, PH.Status AS Illness_status, PH.CreateDate AS CreateDate
            FROM MDataPatientIllnessHistory as PH
            INNER JOIN RefIllness as RI on RI.IllnessId = PH.IllnessId
            WHERE PatientId = '$request->patientId'");

        $PatientPastllness= DB::select("SELECT RI.IllnessCode AS IllnessCode, PHP.Status AS Illness_status, PHP.CreateDate AS CreateDate
            FROM MDataPatientIllnessHistoryPast as PHP
            INNER JOIN RefIllness as RI on RI.IllnessId = PHP.IllnessId
            WHERE PatientId = '$request->patientId'");
        $PatientFamilyllness= DB::select("SELECT RI.IllnessCode AS IllnessCode, PF.Status AS family_status, PF.CreateDate AS CreateDate
            FROM MDataFamilyIllnessHistory as PF
            INNER JOIN RefIllness as RI on RI.IllnessId = PF.IllnessId
            WHERE PatientId = '$request->patientId'");
        $PatientSocialBehavior= DB::select("SELECT RSB.SocialBehaviorCode AS SocialBehaviorCode,SB.OtherSocialBehavior, SB.Status AS family_status, SB.CreateDate AS CreateDate
            FROM MDataSocialBehavior as SB
            INNER JOIN RefSocialBehavior as RSB on RSB.SocialBehaviorId = SB.SocialBehaviorId
            WHERE PatientId = '$request->patientId'");
        $PatientVaccine= DB::select("SELECT RV.VaccineCode AS VaccineCode,PV.OtherVaccine, PV.Status AS Vaccine_status_type, PV.CreateDate AS CreateDate
            FROM MDataPatientVaccine as PV
            INNER JOIN RefVaccine as RV on RV.VaccineId = PV.VaccineId
            WHERE PatientId = '$request->patientId'");

        $Obstetrics= DB::select("SELECT Para, Gravida, StillBirth, MiscarraigeOrAbortion, MR, LivingBirth,LivingMale,LivingFemale,CreateDate FROM MDataPatientObsGynae WHERE PatientId = '$request->patientId'");

        $ChildMortality= DB::select("SELECT ChildMortality0To1, ChildMortalityBelow5, ChildMortalityOver5,CreateDate FROM MDataPatientObsGynae WHERE PatientId = '$request->patientId'");

        $MenstrualHistory= DB::select("SELECT RPT.MenstruationProductUsageTimeCode AS MenstruationProductUsageTimeCode,RMP.MenstruationProductCode AS MenstruationProductCode, RCM.ContraceptionMethodCode AS ContraceptionMethodCode,OG.LMP,OG.Comment, OG.CreateDate AS CreateDate
            FROM MDataPatientObsGynae as OG
            INNER JOIN RefMnstProductUsageTime as RPT on RPT.MenstruationProductUsageTimeId = OG.MenstruationProductUsageTimeId
            INNER JOIN RefMenstruationProduct as RMP on RMP.MenstruationProductId = OG.MenstruationProductId
            INNER JOIN RefContraceptionMethod as RCM on RCM.ContraceptionMethodId = OG.ContraceptionMethodId
            WHERE PatientId = '$request->patientId'");

        $Cardiovascular= DB::select("SELECT * FROM MDataCRA WHERE PatientId = '$request->patientId'");
        
        return response()->json([
            'message' => 'Patient History All Data',
            'code'=>200,
            'HeightWeight'=>$HeightWeight,
            'BP'=>$BP,
            'GlucoseHb'=>$GlucoseHb,
            'Complaints'=>$Complaints,
            'GeneralFindings'=>$GeneralFindings,
            'PhysicalFindings'=>$PhysicalFindings,
            'RxTaken'=>$RxTaken,
            'PatientPresentllness'=>$PatientPresentllness,
            'PatientPastllness'=>$PatientPastllness,
            'PatientFamilyllness'=>$PatientFamilyllness,
            'PatientSocialBehavior'=>$PatientSocialBehavior,
            'PatientVaccine'=>$PatientVaccine,
            'Obstetrics'=>$Obstetrics,
            'ChildMortality'=>$ChildMortality,
            'MenstrualHistory'=>$MenstrualHistory,
            'Cardiovascular'=>$Cardiovascular,
        ],200);
    }
}
