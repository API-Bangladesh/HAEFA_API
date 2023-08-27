<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefVaccine extends Model
{
    protected $table = 'RefVaccine';
    protected $fillable = [
        'VaccineId','VaccineCode','Description','Instruction','VaccineDoseGroupId','VaccineDoseType',
        'VaccineDoseNumber','VaccineProviderType','SortOrder','Status','CreateUser','CreateDate',
        'UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
