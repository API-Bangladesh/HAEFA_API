<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class WorkPlace extends Model
{
    use HasFactory;
    protected $table = 'WorkPlace';
    public $timestamps = false;

    public function patient()
    {
      return $this->belongsTo(Patient::class, 'WorkPlaceId', 'WorkPlaceId');
    }
}
