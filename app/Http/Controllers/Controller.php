<?php

namespace App\Http\Controllers;


use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class Controller extends BaseController
{
    use ResponseTrait;

    protected function validateRequest( Request $request, array $rules, array $message = []){
        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            $errorMessages = $validator->errors()->messages();

            foreach ($errorMessages as $key => $value) {
                $errorMessages[$key] = $value[0];
            }

            return $errorMessages;
        }

        return true;
    }
}
