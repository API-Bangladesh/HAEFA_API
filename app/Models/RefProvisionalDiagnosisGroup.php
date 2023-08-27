<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefProvisionalDiagnosisGroup extends Model
{
    protected $table = "RefProvisionalDiagnosisGroup";

    protected $fillable = [
        'RefProvisionalDiagnosisGroupId','RefProvisionalDiagnosisGroupCode','Category','CommonTerm',
        'SortOrder','Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
