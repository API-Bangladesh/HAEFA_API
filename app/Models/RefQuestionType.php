<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefQuestionType extends Model
{
    protected $table = 'RefQuestionType';
    protected $fillable = [
        'QuestionTypeId','QuestionTypeCode','QuestionTypeTitle','SortOrder','Status','CreateDate',
        'CreateUser','UpdateDate','UpdateUser','OrgId'
    ];
    public $timestamps = false;
}
