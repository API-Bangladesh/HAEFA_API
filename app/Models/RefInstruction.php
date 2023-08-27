<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefInstruction extends Model
{
    protected $table = 'RefInstruction';

    protected $fillable = [
        'RefInstructionId','InstructionCode','InstructionInEnglish','InstructionInBangla',
        'Description','SortOrder','Status','CreateUser','CreateDate','UpdateUser',
        'UpdateDate','OrgId'
    ];

    public $timestamps = false;
}
