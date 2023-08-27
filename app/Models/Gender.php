<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Gender extends Model
{
    protected $table = 'RefGender';
    public $timestamps = false;

    public function patient()
    {
      return $this->belongsTo(Patient::class, 'GenderId', 'GenderId');
    }
}
