<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataVariousSymptom extends Model
{
    protected $table = 'MDataVariousSymptom';

    protected $fillable = [
        'MDVariousSymptomId','PatientId','CollectionDate','AnemiaSeverityId','AnemiaSeverity',
        'CoughGreaterThanMonth','LGERF','NightSweat','WeightLoss',
        'Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
