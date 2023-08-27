<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefLabInvestigation extends Model
{
    protected $table = 'RefLabInvestigation';

    protected $fillable = [
        'RefLabInvestigationId','RefLabInvestigationGroupId','RefLabInvestigationCode','Investigation',
        'Description','SortOrder','Status','CreateUser','CreateDate','UpdateUser','UpdateDate',
        'OrgId'
    ];

    public $timestamps = false;
}
