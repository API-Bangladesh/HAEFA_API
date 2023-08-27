<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefReferral extends Model
{
    protected $table = "RefReferral";

    protected $fillable = [
        'RId','RCode','Description','SortOrder','Status','CreateUser','CreateDate','UpdateUser',
        'UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
