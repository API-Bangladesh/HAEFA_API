<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefDrugGroup extends Model
{
    protected $table = 'RefDrugGroup';

    protected $fillable = [
        'DrugGroupId','DrugGroupCode','Description','SortOrder','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
