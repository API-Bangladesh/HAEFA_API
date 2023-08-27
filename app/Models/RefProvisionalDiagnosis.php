<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefProvisionalDiagnosis extends Model
{
    protected $table = 'RefProvisionalDiagnosis';

    protected $fillable = [
        'RefProvisionalDiagnosisId','RefProvisionalDiagnosisGroupId','ProvisionalDiagnosisCode',
        'ProvisionalDiagnosisName','Description','GroupSortOrder','SortOrder','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
