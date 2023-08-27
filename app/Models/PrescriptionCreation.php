<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionCreation extends Model
{
    protected $table = 'PrescriptionCreation';

    protected $fillable = [
        'PrescriptionCreationId','PrescriptionId','PatientId','Status','CreateUser','CreateDate','UpdateUser','UpdateDate',
        'OrgId'
    ];

    public $timestamps = false;
}
