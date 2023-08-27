<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefDrug extends Model
{
    protected $table = "RefDrug";

    protected $fillable = [
        'DrugId','DrugGroupId','DrugCode','DrugFormId','DrugDose','Description','SortOrder',
        'Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
