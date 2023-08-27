<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataSocialBehavior extends Model
{
    protected $table = 'MDataSocialBehavior';

    protected $fillable = [
        'MDSocialBehaviorId','PatientId','CollectionDate','SocialBehaviorId','OtherSocialBehavior',
        'Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
