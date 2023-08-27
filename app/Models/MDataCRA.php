<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataCRA extends Model
{
    protected $table = 'MDataCRA';
    protected $fillable = [
        'MDataCRAId','PatientId','Age','Sex','BMI','CigaretteSmoker','SystolicBloodPressure','OnBloodPressureMedication','Diabetese','Result','TotalCholesterol','HDLCholesterol','CRAType','Status','CreateDate','CreateUser','UpdateDate','UpdateUser','OrgId'
    ];
    public $timestamps = false;
}
