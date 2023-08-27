<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefChiefComplain extends Model
{
    protected $table = 'RefChiefComplain';
    public $timestamps = false;
    protected $fillable = ['CCId','CCCode','Description','SortOrder','Status','CreateDate',
    'CreateUser','UpdateDate','UpdateUser','OrgId'];
}
