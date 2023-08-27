<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefQuestion extends Model
{
    protected $table = 'RefQuestion';
    protected $fillable = [
        'QuestionId','QuestionTypeId','QuestionModuleName','QuestionGroupId','QuestionTitle','Description',
        'SortOrder','Status','CreateDate','CreateUser','UpdateDate','UpdateUser','OrgId'
    ];
    public $timestamps = false;

    public function getAnswers(){
        return $this->hasMany(RefAnswer::class,'AnswerModuleName','QuestionModuleName');
    }
}
