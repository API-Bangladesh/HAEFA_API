<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefMnstProductUsageTime extends Model
{
    protected $table = "RefMnstProductUsageTime";
    protected $fillable = [
        'MenstruationProductUsageTimeId','MenstruationProductUsageTimeCode','Description','SortOrder',
        'Status','CreateDate','CreateUser','UpdateDate','UpdateUser','OrgId'
    ];
    public $timestamps = false;
}
