<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefFrequency extends Model
{
    protected $table = 'RefFrequency';
    protected $fillable = [
        'FrequencyId','FrequencyCode','FrequencyInEnglish','FrequencyInBangla','Description',
        'SortOrder','Status','CreateDate','CreateUser','UpdateDate','UpdateUser','OrgId'
    ];
    public $timestamps = false;
}
