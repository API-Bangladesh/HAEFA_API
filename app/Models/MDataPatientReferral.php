<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientReferral extends Model
{
    protected $table = 'MDataPatientReferral';

    protected $fillable = [
        'MDPatientReferralId','PatientId','RId','HealthCenterId','CollectionDate',
        'Status','CreateUser','CreateDate','UpdateUser','UpdateDate',
        'OrgId'
    ];

    public $timestamps = false;
}
