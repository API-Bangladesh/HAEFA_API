<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataProvisionalDiagnosis extends Model
{
    protected $table = 'MDataProvisionalDiagnosis';

    protected $fillable = [
        'MDProvisionalDiagnosisId','PatientId','CollectionDate','RefProvisionalDiagnosisId',
        'Category','ProvisionalDiagnosis','OtherProvisionalDiagnosis','DiagnosisStatus',
        'Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId','RefDiseaseGroupId',
        'DiseaseGroupName'
    ];

    public $timestamps = false;
}
