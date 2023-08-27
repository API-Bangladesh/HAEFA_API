<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarcodeFormat;
class Upazila extends Model
{
    protected $table = 'Upazila';
    public $timestamps = false;

    public function barcodeformat(){
        return $this->belongsTo(BarcodeFormat::class, 'barcode_upazila', 'Id');
    }
}

