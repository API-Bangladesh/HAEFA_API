<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Union;
use App\Models\HealthCenter;
use App\Models\District;
use App\Models\Upazila;
class BarcodeFormat extends Model
{
    protected $table = 'barcode_formats';
    public $timestamps = false;
    protected $fillable = [ 'PatientId', 'AddressLine1', 'AddressLine1Parmanent','AddressLine2','AddressLine2Parmanent','Village','VillageParmanent','Thana','ThanaParmanent','PostCode','PostCodeParmanent','District','DistrictParmanent','Country','CountryParmanent','Status','Camp', 'BlockNumber', 'Majhi', 'TentNumber', 'FCN','OrgId','CreateUser','CreateDate','UpdateUser','UpdateDate'];

    public function user()
    {
      return $this->belongsTo(User::class,'cc_id','id');
    }

    public function union(){
        return $this->belongsTo(Union::class, 'barcode_union', 'Id');
    }
    public function healthcenter(){
      return $this->belongsTo(HealthCenter::class, 'barcode_community_clinic', 'HealthCenterId');
    }
    public function district(){
      return $this->belongsTo(District::class, 'barcode_district', 'Id');
    }
    public function upazila(){
      return $this->belongsTo(Upazila::class, 'barcode_upazila', 'Id');
    }


    
}
