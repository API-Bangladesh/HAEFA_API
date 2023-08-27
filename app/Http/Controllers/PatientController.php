<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Transformers\PatientTransformer;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\WorkPlace;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\District;
use App\Models\SelfType;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use App\Models\Station;
use App\Models\RegistrationCode;
use App\Models\Union;
use App\Models\BarcodeStatus;


class PatientController extends Controller
{
    private $PatientTransformer;

    public function __construct(PatientTransformer $PatientTransformer){
        $this->PatientTransformer = $PatientTransformer;
    }
    /**
     * @method_name :- method_name
     * -------------------------------------------------------- 
     * @param  :-  {{}|any}
     * ?return :-  {{}|any}
     * author :-  API
     * created_by:- Abul Kalam Azad
     * created_at:- 28/05/2023 09:22:54
     * description :- Patient Genders All Information.
     */
    public function genders(){
        try{
            $Gender = Gender::select('GenderId','GenderCode')->get();
            $status = [
                'code' => 200,
                'message' => 'Gender Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'Gender' => $Gender,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava Patient data');
    }
    public function maritalStatus(){
        try{
            $MaritalStatus = MaritalStatus::select('MaritalStatusId','MaritalStatusCode')->get();
            $status = [
                'code' => 200,
                'message' => 'Marital Status Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'MaritalStatus' => $MaritalStatus,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava Patient data');
    }
    public function district(){
        try{
            $District = District::select('Id','districtName')->get();
            $status = [
                'code' => 200,
                'message' => 'District Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'District' => $District,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava Patient data');
    }
    public function SelfType(){
        try{
            $SelfType = SelfType::select('HeadOfFamilyId','HeadOfFamilyCode')->get();
            $status = [
                'code' => 200,
                'message' => 'District Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'SelfType' => $SelfType,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava Patient data');
    }
    public function Union(){
        try{
            $Union = Union::select('UnionName','ShortName')->get();
            $status = [
                'code' => 200,
                'message' => 'Get Union Information'
            ];
            return response()->json([
                'status' => $status,
                'unions' => $Union,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Found data');
    }

    public function patientRegCreate(Request $request){

        $registrationNo=$request->patientInfo['RegistrationId'];
        $usersID=$request->patientInfo['usersID'];
        $createUser=$request->patientInfo['CreateUser'];
        $OrgId=$request->patientInfo['OrgId'];
        try{

        $currentTime = Carbon::now();
        $date=$currentTime->toDateTimeString();

        $patient = new Patient();
        $patient->PatientCode = $registrationNo;
        $patient->RegistrationId = $registrationNo;
        $patient->GivenName = $request->patientInfo['fName'];
        $patient->FamilyName = $request->patientInfo['lName'];
        $patient->Age = $request->patientInfo['patientAge'];
        $patient->BirthDate = $request->patientInfo['DOB'];
        $patient->CellNumber = $request->patientInfo['contactNumber'];
        $patient->GenderId = $request->patientInfo['GenderId'];
        $patient->IdType = $request->patientInfo['idType'];
        $patient->IdNumber = $request->patientInfo['ID'];
        $patient->MaritalStatusId = $request->patientInfo['MariatalStatus'];
        $patient->PatientImage = $request->patientInfo['PatientPhoto'];
        $patient->IdOwner = $request->patientInfo['selfType'];
        $patient->WorkPlaceId = (string) $request->patientInfo['WorkPlaceId'];
        $patient->WorkPlaceBranchId = (string) $request->patientInfo['WorkPlaceBranchId'];
        $patient->BarCode = (string) $request->patientInfo['BarCodeId'];
        $patient->FingerPrint = (string) $request->patientInfo['FIngerPrintId'];
        $patient->OrgId = $OrgId;
        $patient->usersID = $usersID;
        $patient->Status = 1;
        $patient->CreateDate = $date;
        $patient->CreateUser = $createUser;
        $patient->UpdateDate = $date;
        $patient->UpdateUser = "";
        $patient->save();

        //patient Registration id wise patient id

        $patientId=Patient::where('RegistrationId','=',$registrationNo)->first();

        $rPatientId=$patientId->PatientId;

        $patientDetails=Patient::where('PatientId','=',$rPatientId)->first();

        $PatientId=$patientId->PatientId;

        // //station start
        $station = new Station();
        $station->PatientId = $PatientId;
        $station->StationStatus = 1;
        $station->CreateDate = $date;
        $station->CreateUser = $createUser;
        $station->UpdateDate = $date;
        $station->UpdateUser = "";
        $station->save();
        // //station End

        BarcodeStatus::where('mdata_barcode_prefix_number','=',$registrationNo)->update(['mdata_barcode_status' => 'used']);
        
        
        // //address start
        $address = new Address();
        $address->PatientId = $PatientId;
        $address->AddressLine1 = $request->addressInfo['AddressLine1'];
        $address->AddressLine2 = $request->addressInfo['AddressLine2'];
        $address->Village = $request->addressInfo['Village'];
        $address->Thana = $request->addressInfo['Thana'];
        $address->PostCode = $request->addressInfo['PostCode'];
        $address->District = $request->addressInfo['District'];
        $address->Country = $request->addressInfo['Country'];
        $address->AddressLine1Parmanent = $request->addressInfo['AddressLine1Parmanent'];
        $address->AddressLine2Parmanent = $request->addressInfo['AddressLine2Parmanent'];
        $address->VillageParmanent = $request->addressInfo['VillageParmanent'];
        $address->ThanaParmanent = $request->addressInfo['ThanaParmanent'];
        $address->PostCodeParmanent = $request->addressInfo['PostCodeParmanent'];
        $address->DistrictParmanent = $request->addressInfo['DistrictParmanent'];
        $address->CountryParmanent = $request->addressInfo['CountryParmanent'];
        $address->Camp = $request->addressInfo['Camp'];
        $address->BlockNumber = $request->addressInfo['BlockNumber'];
        $address->Majhi = $request->addressInfo['Majhi'];
        $address->TentNumber = $request->addressInfo['TentNumber'];
        $address->FCN = $request->addressInfo['FCN'];
        $address->Status = 1;
        $address->OrgId = $OrgId;
        $address->CreateDate = $date;
        $address->CreateUser = $createUser;
        $address->UpdateDate = $date;
        $address->UpdateUser = "";
        $address->save();
        //address start

        return response()->json([
            'message' => 'Patient Registration Sava Successfully',
            'code'=>200,
            'patientDetails'=>$patientDetails
        ],200);

        }catch (Exception $e) {
            throw new Exception($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }  

        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava Patient Registration data');
    }

    public function patientIdWiseInformation(Request $request){

        $PatientId=$request->PatientId;

        try{
            $IdWisePatientInfo = Patient::with('Gender','MartitalStatus','Address')->where('PatientId','=',$PatientId)->first();
            $status = [
                'code' => 200,
                'message' => 'Get Patient Info',
                
            ];
            return response()->json([
                'status' => $status,
                'PatientData' => $IdWisePatientInfo,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Found Patient data');
    }
    public function patientPhoto(Request $request){

        $PatientId=$request->PatientId;
        $patientImage=$request->PatientImage;

        try{
            $IdWisePatientInfo =Patient::where('PatientId','=' ,$PatientId)->update(['PatientImage' => $patientImage]);
            
            return response()->json([
                'code' => 200,
                'message' => 'Patient Image Updated',
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Found Patient data');
    }

    public function patientAllInfo(){
        $patientAllInfo = Patient::with('Gender','MartitalStatus','Address')->get();
        $status = [
            'code' => 200,
            'message' => 'Get Patient Info',
            
        ];
        return response()->json([
            'status' => $status,
            'patientAllInfo' => $patientAllInfo,
        ]);
    }

    public function registrationCodeCheck(Request $request){


        preg_match('/^[A-Za-z]+/', $request->registrationCode, $stringPortion);
        // Extract the number portion
        preg_match('/\d+$/', $request->registrationCode, $numberPortion);

        if(isset($stringPortion[0]) && isset($numberPortion[0])){ 

            $code= $stringPortion[0]; // Array element at index 0
            $number= $numberPortion[0]; // Array element at index 0
            $strCode=Str::length($code);
            $strLength=Str::length($number);

            if($strCode == 9 && $strLength == 8){
                $registrationCode = RegistrationCode::select('mdata_barcode_prefix','mdata_barcode_number','mdata_barcode_prefix_number','mdata_barcode_status')->where('mdata_barcode_prefix_number','=',$request->registrationCode)->where('mdata_barcode_status','=','unused')->first();
                try{
                    if($registrationCode == null){
                        return $this->responseJson(false, HttpResponse::HTTP_BAD_REQUEST, 'Registration Code Already Used');
                    }else{
                        return response()->json([
                            'code' => 200,
                            'message' => 'Registration Code Matched',
                            'registrationCode' =>$registrationCode,
                        ]);
                    }
                }catch (Exception $e) {
                    throw new Exception($e->getMessage());
                }  
                return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Found data');
            }else{
                return $this->responseJson(false, HttpResponse::HTTP_BAD_REQUEST, 'Error. Registration Code or Number Format Invalid');
            }

            //Logic
        }else{
            return $this->responseJson(false, HttpResponse::HTTP_BAD_REQUEST, 'Error. Registration Code or Number Format Invalid');
        }

        
        
        
        
    }


}
