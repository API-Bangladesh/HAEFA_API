<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataAdvice extends Model
{
    protected $table = 'MDataAdvice';

    protected $fillable = [
        'MDAdviceId','PatientId','CollectionDate','AdviceId','Advice',
        'Status','CreateUser','CreateDate','UpdateUser','UpdateDate',
        'OrgId'
    ];

    public $timestamps = false;
}
