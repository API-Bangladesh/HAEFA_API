<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class MDataGlucoseHb extends Model
{
    protected $table = 'MDataGlucoseHb';
    protected $fillable = [
        'Id','PatientId','CollectionDate','RBG','FBG','HrsFromLastEat','Hemoglobin','Status','CreateDate','CreateUser','UpdateDate','UpdateUser','OrgId'
    ];
    public $timestamps = false;

    public function patient()
    {
      return $this->belongsTo(Patient::class, 'PatientId', 'PatientId');
    }
}
