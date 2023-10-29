<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientTBPastHistory extends Model
{
    protected $table = 'MDataTBPastHistory';
    protected $filable = [
        'MDPatientTBPHistoryId','PatientId','CollectionDate','TBPastHistoryQuestionId','TBHistoryAnswer1','TBHistoryOthers1','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];
    public $timestamps = false;
}
