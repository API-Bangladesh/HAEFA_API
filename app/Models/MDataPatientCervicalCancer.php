<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientCervicalCancer extends Model
{
    protected $table= "MDataPatientCervicalCancer";

    protected $fillable = [
        'MDataPatientCervicalCancerId','PatientId','CollectionDate','CCScreeningDiagnosis',
        'CCScreeningResultStatus','ReferralBiopsyStatus','Status','CreateUser','CreateDate',
        'UpdateUser','UpdateDate','OrgId','ThermocoagulationStatus','ThermocoagulationStatusNoOtherComments',
        'ReferralBiopsyStatusYesComments','ThermocoagulationStatusNo'
    ];
    
    public $timestamps = false;
}
