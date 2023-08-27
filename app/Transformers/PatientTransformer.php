<?php
namespace App\Transformers;
use App\Models\Patient;
use League\Fractal\TransformerAbstract;

class PatientTransformer extends TransformerAbstract{

    public function transform(Patient $patient){
        return[
            'PatientId' => $patient->PatientId,
            'WorkPlaceId' => $patient->WorkPlaceId,
            'WorkPlaceBranchId' => $patient->WorkPlaceBranchId,
            'PatientCode' => $patient->PatientCode,
            'RegistrationId' => $patient->RegistrationId,
            'GivenName' => $patient->GivenName,
            'FamilyName' => $patient->FamilyName,
            'GenderId' => $patient->GenderId,
            'BirthDate' => $patient->BirthDate

        ];
    }
}