<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MDataHeightWeight;
class RefBlood extends Model
{
    protected $table = 'RefBloodGroup';

    public $timestamps = false;


    public function height_weights()
    {
      return $this->belongsTo(MDataHeightWeight::class, 'RefBloodGroupId', 'RefBloodGroupId');
    }
}
