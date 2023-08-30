<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPastIllnessHistory extends Model
{
    protected $table = 'MDataPatientIllnessHistoryPast';
    protected $filable = [
        'MDPatientIllnessId','PatientId','CollectionDate','IllnessId','OtherIllness','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];
    public $timestamps = false;
}
