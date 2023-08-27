<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefSocialBehavior extends Model
{
    protected $table = 'RefSocialBehavior';
    protected $fillable = [
        'SocialBehaviorId','SocialBehaviorCode','Description','SortOrder','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
