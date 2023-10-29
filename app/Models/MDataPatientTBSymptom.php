<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientTBSymptom extends Model
{
    protected $table = 'MDataTBSymptom';
    protected $filable = [
        'MDTBSymptomId','PatientId','CollectionDate','TBSymptom','TBSymptomCode','OthersSymptom','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];
    public $timestamps = false;
}
