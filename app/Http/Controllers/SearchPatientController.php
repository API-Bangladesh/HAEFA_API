<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Station;
class SearchPatientController extends Controller
{
    public function searchPatientAllInfo(Request $request){
        $stationId=$request->station;
        $Card=$request->Card;
        $Name=$request->Name;
        $NID=$request->NID;
        $Mobile=$request->Mobile;


        $patientDetails=Patient::select('PatientId')->where('RegistrationId','=',$Card)->orWhere('IdNumber','=',$NID)->orWhere('CellNumber','=',$Mobile)->first();

        $StationStatus = Station::select('StationStatus')->where('PatientId','=',$patientDetails->PatientId)->first();

        if($StationStatus->StationStatus === $stationId){
            if($StationStatus->StationStatus === "4"){
                $patientDetails=Patient::with('Gender','MartitalStatus','bps','height_weights','glucose_hbs')->where('PatientId','=',$patientDetails->PatientId)->get();
                return $patientDetails;
            }else{
                $patientDetails=Patient::with('Gender','MartitalStatus')->where('PatientId','=',$patientDetails->PatientId)->get();
                return $patientDetails;
            }
            
        }else{
            return 'Please Check Station - '.$StationStatus->StationStatus;
        }
        
        if($stationId == ""){
            return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Found Station Id');
        }else{
            if($stationId == "1"){
                if($request->Card){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Card)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->Name){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Name)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->NID){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->NID)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->Mobile){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Mobile)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
            }
            if($stationId == "2"){
                if($request->Card){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Card)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->Name){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Name)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->NID){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->NID)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->Mobile){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Mobile)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
            }
            if($stationId == "3"){
                if($request->Card){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Card)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->Name){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Name)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->NID){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->NID)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->Mobile){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Mobile)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
            }
            if($stationId == "4"){
                if($request->Card){
                    $patientDetails=Patient::with('Gender','MartitalStatus','bps','height_weights','glucose_hbs')->where('RegistrationId','=',$request->Card)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->Name){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Name)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->NID){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->NID)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
                if($request->Mobile){
                    $patientDetails=Patient::with('Gender','MartitalStatus')->where('RegistrationId','=',$request->Mobile)->get();
                    if(count($patientDetails) === 0){
                        return 'Station 1 User data not found, This Patient is not Registered.';
                    }else{
                        return $patientDetails;
                    }
                }
            }
        }
                    
    }

    public function searchPatientAllInfoWithoutStation(Request $request){
        $stationId=$request->station;
        $Card=$request->Card;
        $Name=$request->Name;
        $NID=$request->NID;
        $Mobile=$request->Mobile;
        
        if($request->Card){
            $patientDetails=Patient::with('Gender','MartitalStatus','bps','height_weights','glucose_hbs')->where('RegistrationId','=',$Card)->get();
            if(count($patientDetails) === 0){
                return 'This Patient is Not Found';
            }else{
                return $patientDetails;
            }
        }
        if($request->Name){
            $patientDetails=Patient::with('Gender','MartitalStatus','bps','height_weights','glucose_hbs')->where('GivenName', 'like', '%' . $Name . '%')->orWhere('FamilyName', 'like', '%' . $Name . '%')->get();
            if(count($patientDetails) === 0){
                return 'This Patient is Not Found';
            }else{
                return $patientDetails;
            }
        }
        if($request->NID){
            $patientDetails=Patient::with('Gender','MartitalStatus','bps','height_weights','glucose_hbs')->where('IdNumber','=',$NID)->get();
            if(count($patientDetails) === 0){
                return 'This Patient is Not Found';
            }else{
                return $patientDetails;
            }
        }
        if($request->Mobile){
            $patientDetails=Patient::with('Gender','MartitalStatus','bps','height_weights','glucose_hbs')->where('CellNumber','=',$Mobile)->get();
            if(count($patientDetails) === 0){
                return 'This Patient is Not Found';
            }else{
                return $patientDetails;
            }
        }
                    
    }
}
