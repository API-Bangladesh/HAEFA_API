<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Union;
use App\Models\Gender;
use App\Models\Address;
use App\Models\Patient;
use App\Models\Station;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Models\Religion;
use App\Models\SelfType;
use App\Models\Education;
use App\Models\WorkPlace;
use App\Models\SyncRecord;
use Illuminate\Support\Str;
use App\Models\HeadofFamily;
use Illuminate\Http\Request;
use App\Models\BarcodeStatus;
use App\Models\MaritalStatus;
use App\Models\RegistrationCode;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Transformers\PatientTransformer;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

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
    // public function division(){
    //     try{
    //         $Division = Division::select('id','name')->get();
    //         $status = [
    //             'code' => 200,
    //             'message' => 'Division Information Successfully'
    //         ];
    //         return response()->json([
    //             'status' => $status,
    //             'Division' => $Division,
    //         ]);
    //     }catch (Exception $e) {
    //         throw new Exception($e->getMessage());
    //     }  
    //     return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava Patient data');
    // }
    public function district(){
        try{
            $District = District::select('id','name')->get();
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
    public function upazilla(Request $request){
        try{
            $Upazila = Upazila::select('id','name')->where('district_id','=',$request->district_id)->get();
            $status = [
                'code' => 200,
                'message' => 'Upazila Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'Upazila' => $Upazila,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava Patient data');
    }
    public function union(Request $request){
        try{
            $Union = Union::select('id','name')->where('upazilla_id','=',$request->upazilla_id)->get();
            $status = [
                'code' => 200,
                'message' => 'Union Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'Union' => $Union,
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
                'message' => 'SelfType Information Successfully'
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
    public function HeadofFamily(){
        try{
            $HeadofFamily = HeadofFamily::select('HeadOfFamilyId','HeadOfFamilyCode')->get();
            $status = [
                'code' => 200,
                'message' => 'Head of Family Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'HeadofFamily' => $HeadofFamily,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Found data');
    }
    public function Religion(){
        try{
            $Religion = Religion::select('ReligionId','ReligionCode')->get();
            $status = [
                'code' => 200,
                'message' => 'Religion Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'Religion' => $Religion,
            ]);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Found data');
    }
    public function Education(){
        try{
            $Education = Education::select('EducationId','EducationCode')->get();
            $status = [
                'code' => 200,
                'message' => 'Education Information Successfully'
            ];
            return response()->json([
                'status' => $status,
                'Education' => $Education,
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

        $patient_exist=Patient::where('RegistrationId',$registrationNo)->first();
        if(!$patient_exist){

                     DB::beginTransaction();
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
       
        //new add field
        // $patient->SpouseName = $request->patientInfo['SpouseName'];
        // $patient->ReligionId = $request->patientInfo['ReligionId'];
        // $patient->FamilyMembers = $request->patientInfo['FamilyMembers'];
        // $patient->FatherName = $request->patientInfo['FatherName'];
        // $patient->MotherName = $request->patientInfo['MotherName'];
        // $patient->EducationId = $request->patientInfo['EducationId'];
        // $patient->HeadOfFamilyId = $request->patientInfo['HeadOfFamilyId'];
        // $patient->ChildAge0To1 = $request->patientInfo['ChildAge0To1'];
        // $patient->ChildAge1To5 = $request->patientInfo['ChildAge1To5'];
        // $patient->ChildAgeOver5 = $request->patientInfo['ChildAgeOver5'];
        //new add field
        $patient->PatientImage = $request->patientInfo['PatientPhoto'];
        $patient->IdOwner = $request->patientInfo['selfType'];
        $patient->StationStatus = $request->patientInfo['StationStatus'];
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

  
          
       
        $hostname = gethostname();
        
        $rawMacAddress = exec("getmac");
        $macAddress = $this->extractMacAddress($rawMacAddress);
        
         preg_match('/^[A-Za-z]+/', $registrationNo, $stringPortion);
          $prefix_code= $stringPortion[0];
         $registrationNo=$request->patientInfo['RegistrationId'];
         $user_email=$request->userEmail;
    

    
       
        $syncdate = Carbon::now()->toDateTimeString();

        // Check if there are more than 200 records for the given prefix
        $count = SyncRecord::where('WorkPlaceId', $prefix_code)->count();

        if ($count >= 200) {
            // Sort records by OperationDate in ascending order and delete oldest records
            $oldestRecords = SyncRecord::where('WorkPlaceId', $prefix_code)->orderBy('OperationDate')->take($count - 199)->get();
            foreach ($oldestRecords as $record) {
                $record->delete();
            }
        }

        // Create new SyncRecord
        SyncRecord::create([
            'DownloadUploadIndicator' => $hostname,
            'IPAddress' => $macAddress,
            'OperationDate' => $syncdate,
            'CreateUser' => $user_email,
            'UpdateUser' => $user_email,
            'CreateDate' => $syncdate,
            'UpdateDate' => $syncdate,
            'WorkPlaceId' => $prefix_code,
        ]);
      
        // $mac_address=$request->macAddress;
        // $device_name=$request->deviceName;
        // $cc_prefix=Auth()

        BarcodeStatus::where('mdata_barcode_prefix_number','=',$registrationNo)->update(['mdata_barcode_status' => 'used',
    'updated_at' => $date]);
        
        
        // //address start
        $address = new Address();
        $address->PatientId = $PatientId;
        $address->AddressLine1 = $request->addressInfo['AddressLine1'];
        $address->AddressLine2 = $request->addressInfo['AddressLine2'];
        $address->Village = $request->addressInfo['Village'];
        $address->Thana = $request->addressInfo['Thana'];
        $address->PostCode = $request->addressInfo['PostCode'];
        $address->District = $request->addressInfo['District'];
        $address->UnionId = $request->addressInfo['Union'];
        $address->Country = $request->addressInfo['Country'];
        $address->AddressLine1Parmanent = $request->addressInfo['AddressLine1Parmanent'];
        $address->AddressLine2Parmanent = $request->addressInfo['AddressLine2Parmanent'];
        $address->VillageParmanent = $request->addressInfo['VillageParmanent'];
        $address->ThanaParmanent = $request->addressInfo['ThanaParmanent'];
        $address->PostCodeParmanent = $request->addressInfo['PostCodeParmanent'];
        $address->DistrictParmanent = $request->addressInfo['DistrictParmanent'];
        $address->UnionIdParmanent = $request->addressInfo['UnionParmanent'];
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
        DB::commit(); 
        return response()->json([
            'message' => 'Patient Registration Sava Successfully',
            'code'=>200,
            'patientDetails'=>$patientDetails
        ],200);

        }catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }  
               
        
            }else{

            return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Patient ALready Exist');
      
    }
    
      
      
        // return $hostname;
        
     

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
        private function extractMacAddress($rawMacAddress)
{
    // Use regular expressions to extract the MAC address
    // Use regular expressions to extract the MAC address without leading/trailing spaces
    $pattern = '/([0-9A-Fa-f:-]+)/';
    preg_match($pattern, $rawMacAddress, $matches);
    if (isset($matches[1])) {
        return trim($matches[1]); // Trim any leading/trailing spaces
    } else {
        return 'Unknown';
    }
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
                $existCode=RegistrationCode::where('mdata_barcode_prefix_number',$request->registrationCode)->first();
                $registrationCode = RegistrationCode::select('mdata_barcode_prefix','mdata_barcode_number','mdata_barcode_prefix_number','mdata_barcode_status')->where('mdata_barcode_prefix_number','=',$request->registrationCode)->where('mdata_barcode_status','=','unused')->first();
                try{
                    if(!$existCode){
                            return $this->responseJson(false, HttpResponse::HTTP_BAD_REQUEST, 'Invalid Registration Code ');
                    }
                    else if($registrationCode == null){
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
