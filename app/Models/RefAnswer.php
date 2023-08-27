<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefAnswer extends Model
{
    protected $table = 'RefAnswer';

    protected $fillable = [
        'AnswerId','AnswerGroupId','AnswerModuleName','AnswerTitle','Description',
        'ButtonType','SortOrder','Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;

    public function getQuestion(){
        return $this->hasMany(RefQuestion::class,'QuestionModuleName','AnswerModuleName');
    }
}
