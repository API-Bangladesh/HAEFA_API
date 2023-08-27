<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefLabInvestigationGroup extends Model
{
    protected $table = 'RefLabInvestigationGroup';

    protected $fillable = [
        'RefLabInvestigationGroupId','RefLabInvestigationGroupCode','Description','SortOrder',
        'Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
