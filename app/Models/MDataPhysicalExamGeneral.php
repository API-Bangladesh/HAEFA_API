<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class MDataPhysicalExamGeneral extends Model
{
    protected $table = 'MDataPhysicalExamGeneral';

    protected $fillable = [
        'MDPhysicalExamGeneralId','PatientId','CollectionDate','AnemiaSeverity',
        'JaundiceSeverity','EdemaSeverity','IsLymphNodesWithPalpable','LymphNodesWithPalpableSite',
        'LymphNodesWithPalpable','LymphNodesWithPalpableSize','IsHeartWithNAD','HeartWithNAD',
        'IsLungsWithNAD','LungsWithNAD','OtherSymptom','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;

    public function patient()
    {
      return $this->belongsTo(Patient::class, 'PatientId', 'PatientId');
    }
}
