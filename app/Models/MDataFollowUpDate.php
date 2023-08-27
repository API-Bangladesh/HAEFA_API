<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataFollowUpDate extends Model
{
    protected $table = "MDataFollowUpDate";

    protected $fillable = [
        'MDFollowUpDateId','PatientId','CollectionDate','FollowUpDate','Status','CreateUser',
        'CreateDate','UpdateUser','UpdateDate','OrgId','FollowupIndicator','Comment'
    ];

    public $timestamps = false;
}
