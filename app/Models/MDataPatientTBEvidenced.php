<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientTBEvidenced extends Model
{
    protected $table = 'MDataTBEPastEvidenced';
    protected $filable = [
        'MDPatientPEId','PatientId','CollectionDate','TBEPastEvidencedId','TBEPastEvidencedCode','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];
    public $timestamps = false;
}
