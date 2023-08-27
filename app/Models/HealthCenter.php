<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarcodeFormat;

class HealthCenter extends Model
{
    protected $table = "HealthCenter";

    protected $fillable = [
        'HealthCenterId','HealthCenterCode','HealthCenterName','HealthCenterContactNumber','ContactPersonName',
        'ContactPersonMobile','ContactPersonEmail','IsProvideAmbulance','AmbulanceFee','NearestLandmark',
        'DistanceFrom','IsProvideOTFacility','OTFee','IsProvidePostOperativeFacility','PostOperativeFee',
        'IsProvideICUFacility','ICUFee','IsProvideHDUFacility','HDUFee','IsProvideCCUFacility',
        'CCUFee','IsProvideNICUFacility','NICUFee','IsProvideBurnTreatment','BurnTreatmentFee',
        'IsProvideDiscountWheelsReferredPatient','DiscountPercentageWheelsReferredPatient','HealthCenterType',
        'Status','CreateUser','CreateDate','UpdateUser','UpdateDate','OrgId','Latitude','Longitude'
    ];

    public function barcodeformat(){
        
        return $this->belongsTo(BarcodeFormat::class, 'barcode_community_clinic', 'HealthCenterId');
    }
}
