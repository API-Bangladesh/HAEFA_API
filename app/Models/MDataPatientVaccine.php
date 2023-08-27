<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientVaccine extends Model
{
    protected $table = 'MDataPatientVaccine';

    protected $fillable = [
        'MDPatientVaccineId','PatientId','CollectionDate','VaccineId','OtherVaccine',
        'IsGivenByNirog','Status','CreateUser','CreateDate','UpdateUser','UpdateDate',
        'OrgId'
    ];

    public $timestamps = false;
    
}
