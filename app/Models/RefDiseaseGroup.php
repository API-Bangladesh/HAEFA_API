<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefDiseaseGroup extends Model
{
    protected $table = 'RefDiseaseGroups';
    protected $fillable = [
        'RefDiseaseGroupId','DiseaseGroupName','Status','SortOrder','CreateUser','CreateDate',
        'UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
