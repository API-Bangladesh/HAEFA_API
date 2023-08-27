<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\MDataBP;
use App\Models\MDataHeightWeight;
use App\Models\MDataGlucoseHb;
use App\Models\MDataPatientCCDetails;
use App\Models\MDataPhysicalExamGeneral;
use App\Models\MDataPhysicalFinding;
use App\Models\MDataRxDetails;
use App\Models\MDataInvestigation;
use App\Models\Address;



class Patient extends Model
{
    
    use HasFactory;
    protected $table = 'Patient';
    public $timestamps = false;


    protected $fillable = [ 'PatientId', 'WorkPlaceId', 'WorkPlaceBranchId','PatientCode','RegistrationId','GivenName','FamilyName','GenderId','BirthDate','Age','AgeYear','AgeMonth','AgeDay','JoiningDate','ReligionId','RefDepartmentId','RefDesignationId','MaritalStatusId','EducationId','FatherName','MotherName','SpouseName','HeadOfFamilyId','IdNumber','CellNumber','FamilyMembers','ChildrenNumber','ChildAge0To1','ChildAge1To5','ChildAgeOver5','EmailAddress','PatientImage','Status','CreateDate', 'CreateUser', 'UpdateDate', 'UpdateUser', 'OrgId'];
    
    public function Address()
    {
        return $this->hasOne(Address::class, 'PatientId', 'PatientId'); 
    }
    public function Gender()
    {
        return $this->hasOne(Gender::class, 'GenderId', 'GenderId')->select('GenderId','GenderCode'); 
    }
    public function MartitalStatus()
    {
        return $this->hasOne(MaritalStatus::class, 'MaritalStatusId', 'MaritalStatusId')->select('MaritalStatusId','MaritalStatusCode'); 
    }
    public function bps()
    {
        return $this->hasOne(MDataBP::class, 'PatientId', 'PatientId')->latest('CreateDate'); 
    }
    
    public function height_weights()
    {
        return $this->hasOne(MDataHeightWeight::class, 'PatientId', 'PatientId')->with('blood')->latest('CreateDate'); 
    }
    public function glucose_hbs()
    {
        return $this->hasOne(MDataGlucoseHb::class, 'PatientId', 'PatientId')->latest('CreateDate');
    }
    // public function cc_details()
    // {
    //     return $this->hasMany(MDataPatientCCDetails::class, 'PatientId', 'PatientId'); 
    // }
    // public function physical_exam_general()
    // {
    //     return $this->hasMany(MDataPhysicalExamGeneral::class, 'PatientId', 'PatientId'); 
    // }
    // public function physical_finding()
    // {
    //     return $this->hasMany(MDataPhysicalFinding::class, 'PatientId', 'PatientId'); 
    // }
    // public function rx_details()
    // {
    //     return $this->hasMany(MDataRxDetails::class, 'PatientId', 'PatientId'); 
    // }
    // public function investigation()
    // {
    //     return $this->hasMany(MDataInvestigation::class, 'PatientId', 'PatientId'); 
    // }

    // public function bps_patient()
    // {
    //     return $this->hasMany(MDataBP::class, 'PatientId', 'PatientId')->latest('CreateDate')->limit(1);
    // }
    // public function height_weights_patient()
    // {
    //     return $this->hasMany(MDataHeightWeight::class, 'PatientId', 'PatientId')->latest('CreateDate')->limit(1); 
    // }
    // public function glucose_hbs_patient()
    // {
    //     return $this->hasMany(MDataGlucoseHb::class, 'PatientId', 'PatientId')->latest('CreateDate')->limit(1); 
    // }
    // public function cc_details_patient()
    // {
    //     //return $this->hasMany(MDataPatientCCDetails::class, 'PatientId', 'PatientId')->latest('CreateDate')->limit(1); 
    //     return $this->hasMany(MDataPatientCCDetails::class, 'PatientId', 'PatientId'); 
    // }

}
