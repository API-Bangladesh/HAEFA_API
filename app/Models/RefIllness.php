<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefIllness extends Model
{
    protected $table = 'RefIllness';
    public $timestamps = false;
    protected $fillable = ['IllnessId','IllnessCode','Description','HOIllness','FamilyHO',
    'SortOrder','Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId'];
}
