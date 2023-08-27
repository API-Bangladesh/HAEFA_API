<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefAdvice extends Model
{
    protected $table = 'RefAdvice';

    protected $fillable = [
        'AdviceId','AdviceCode','AdviceInEnglish','AdviceInBangla','Description',
        'SortOrder','Status','CreateUser','CreateDate','UpdateUser','UpdateDate',
        'OrgId'
    ];

    public $timestamps = false;
}
