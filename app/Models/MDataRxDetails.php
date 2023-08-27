<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class MDataRxDetails extends Model
{
    protected $table = 'MDataRxDetails';

    protected $fillable = [
        'RxId','PatientId','CollectionDate','Rx','DurationId','RxDurationValue',
        'Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;

    public function patient()
    {
      return $this->belongsTo(Patient::class, 'PatientId', 'PatientId');
    }
}
