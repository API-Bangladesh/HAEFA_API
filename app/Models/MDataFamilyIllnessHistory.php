<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataFamilyIllnessHistory extends Model
{
    protected $table = "MDataFamilyIllnessHistory";

    protected $fillable = [
        'MDFamilyIllnessId','PatientId','CollectionDate','IllFamilyMemberId','IllnessId','DeceasedYears',
        'OtherIllFamilyMember','OtherIllness','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'

    ];

    public $timestamps = false;
}
