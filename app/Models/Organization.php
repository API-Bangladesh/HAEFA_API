<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Organization extends Model
{
    protected $table = 'Organization';
    public $timestamps = false;
    protected $fillable = [ 'PatientId', 'AddressLine1', 'AddressLine1Parmanent','AddressLine2','AddressLine2Parmanent','Village','VillageParmanent','Thana','ThanaParmanent','PostCode','PostCodeParmanent','District','DistrictParmanent','Country','CountryParmanent','Status','Camp', 'BlockNumber', 'Majhi', 'TentNumber', 'FCN','OrgId','CreateUser','CreateDate','UpdateUser','UpdateDate'];

    public function user()
    {
      return $this->belongsTo(User::class,'OrgId','OrgId');
    }
}
