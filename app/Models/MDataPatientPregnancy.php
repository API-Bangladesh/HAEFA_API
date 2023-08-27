<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientPregnancy extends Model
{
    protected $table = "MDataPatientPregnancy";

    protected $fillable = [
        "MDPatientPregnancyId","PatientId","CollectionDate","LMP","EDD","PregnancyDurationInWeeks",
        "SymphysioFundalHeight","FoetalHeartSound","FoetalHeartRate","FoetalMovement","FoetalPosition",
        "OtherFoetalPositionInfo","USG","Comment","Status","CreateUser","CreateDate","UpdateUser",
        "UpdateDate","OrgId"
    ];

    public $timestamps = false;
}
