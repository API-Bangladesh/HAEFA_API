<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataTreatmentSuggestion extends Model
{
    protected $table = 'MDataTreatmentSuggestion';

    protected $fillable = [
        'MDTreatmentSuggestionId','PatientId','CollectionDate','DrugId','DurationId',
        'RefFrequencyId','Frequency','Hourly','DrugDurationValue','OtherDrug',
        'RefInstructionId','SpecialInstruction','Comment','Status','CreateDate',
        'CreateUser','UpdateDate','UpdateUser','OrgId'
    ];

    public $timestamps = false;
}
