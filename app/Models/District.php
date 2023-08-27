<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarcodeFormat;

class District extends Model
{
    protected $table = 'District';
    public $timestamps = false;

    public function barcodeformat(){
        return $this->belongsTo(BarcodeFormat::class, 'barcode_district', 'Id');
    }
}
