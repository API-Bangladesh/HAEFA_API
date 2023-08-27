<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataPatientObsGynae extends Model
{
    protected $table = 'MDataPatientObsGynae';

    protected $fillable = [
        'MDPatientObsGynaeId','PatientId','CollectionDate','Gravida','StillBirth','MiscarraigeOrAbortion',
        'MR','LivingBirth','LivingMale','LivingFemale','ChildMortality0To1','ChildMortalityBelow5',
        'ChildMortalityOver5','LMP','ContraceptionMethodId','OtherContraceptionMethod','Comment',
        'MenstruationProductId','OtherMenstruationProduct','IsReuse','MenstruationProductUsageTimeId',
        'OtherMenstruationProductUsageTime','IsPregnant','Status','CreateUser','CreateDate',
        'UpdateUser','UpdateDate','OrgId','IsCervicalcancer'
    ];

    public $timestamps = false;
}
