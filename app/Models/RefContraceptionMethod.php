<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefContraceptionMethod extends Model
{
    protected $table = "RefContraceptionMethod";

    protected $fillable = [
        'ContraceptionMethodId','ContraceptionMethodCode','Description','SortOrder','Status','CreateDate',
        'CreateUser','UpdateDate','UpdateUser','OrgId'
    ];

    public $timestamps = false;
}
