<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefDuration extends Model
{
    protected $table = 'RefDuration';
    public $timestamps = false;
    protected $fillable = ['DurationId','DurationCode','DurationInEnglish','DurationInBangla','Description'
    ,'SortOrder','Status','CreateDate','CreateUser','UpdateDate','UpdateUser','OrgId'];
}
