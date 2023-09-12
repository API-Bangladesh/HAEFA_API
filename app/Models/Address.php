<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\District;
use App\Models\Union;
use App\Models\Upazila;
class Address extends Model
{
    protected $table = 'Address';
    public $timestamps = false;
    protected $fillable = [ 'PatientId', 'AddressLine1', 'AddressLine1Parmanent','AddressLine2','AddressLine2Parmanent','Village','VillageParmanent','Thana','ThanaParmanent','PostCode','PostCodeParmanent','District','DistrictParmanent','Country','CountryParmanent','Status','Camp', 'BlockNumber', 'Majhi', 'TentNumber', 'FCN','OrgId','CreateUser','CreateDate','UpdateUser','UpdateDate'];

    public function patient()
    {
      return $this->belongsTo(Patient::class, 'PatientId', 'PatientId');
    }

    public function districtAddress()
    {
        return $this->belongsTo(District::class, 'District', 'id');
    }

  public function upazillaAddress()
  {
      return $this->belongsTo(Upazila::class, 'Thana', 'id');
  }

  public function unionAddress()
  {
      return $this->belongsTo(Union::class, 'UnionId', 'id');
  }


}
