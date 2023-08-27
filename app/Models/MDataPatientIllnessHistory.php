<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientIllnessHistory extends Model
{
    protected $table = 'MDataPatientIllnessHistory';
    protected $filable = [
        'MDPatientIllnessId','PatientId','CollectionDate','IllnessId','OtherIllness','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];
    public $timestamps = false;
}
