<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class MDataBP extends Model
{
    protected $table = 'MDataBP';
    protected $fillable = [
        'Id','PatientId','CollectionDate','BPSystolic1','BPDiastolic1','BPSystolic2','BPDiastolic2','HeartRate','CurrentTemparature','RespiratoryRate','SpO2Rate','IndicatesNormalOxygenSaturation','Status','CreateDate','CreateUser','UpdateDate','UpdateUser','OrgId'
    ];
    public $timestamps = false;

    public function patient()
    {
      return $this->belongsTo(Patient::class, 'PatientId', 'PatientId');
    }
}
