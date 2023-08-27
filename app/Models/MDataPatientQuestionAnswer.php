<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientQuestionAnswer extends Model
{
    protected $table = "MDataPatientQuestionAnswer";

    protected $fillable = [
        'MDPatientQuestionAnswerId','PatientId','CollectionDate','QuestionId',
        'AnswerId','Comment','Status','CreateUser','CreateDate','UpdateUser',
        'UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
