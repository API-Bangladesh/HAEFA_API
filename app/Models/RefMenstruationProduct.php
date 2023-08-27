<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefMenstruationProduct extends Model
{
    protected $table = "RefMenstruationProduct";

    protected $fillable = [
        'MenstruationProductId','MenstruationProductCode','Description','SortOrder','Status',
        'CreateDate','CreateUser','UpdateDate','UpdateUser','OrgId'
    ];

    public $timestamps = false;
}
