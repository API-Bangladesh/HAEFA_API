<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarcodeFormat;

class Union extends Model
{
    protected $table = 'Union';
    public $timestamps = false;


    public function barcodeformat(){
        return $this->belongsTo(BarcodeFormat::class, 'barcode_union', 'Id');
    }
}