<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientTBEFindings extends Model
{
    protected $table = 'MDataPatientTBEFinding';
    protected $filable = [
        'MDEFindingId','PatientId','CollectionDate','TBEFindingId','TBEFindingCode','TBEFindingOthers','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];
    public $timestamps = false;
}
