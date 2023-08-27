<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class MaritalStatus extends Model
{
    protected $table = 'RefMaritalStatus';
    public $timestamps = false;

    public function patient()
    {
      return $this->belongsTo(Patient::class, 'MaritalStatusId', 'MaritalStatusId');
    }
}
