<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\User;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthController extends Controller
{
   

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {

        $rules =[
            'email' => 'required|email:strict',
            'password' => 'required|string|min:8',
        ];

        $validatorResponse = $this->validateRequest($request, $rules);

        if($validatorResponse !== true){
            return $this->responseJson(false, HttpResponse::HTTP_BAD_REQUEST, 'Error', $validatorResponse);
        }

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {

            return response()->json(['status' => false,'patient'=>'', 'code' => 422,'message' => 'Incorrect email or password'],422);
        }

        return $this->respondWithToken($token);

        
    }

     /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $status = [

            'code' => 200,
            'message' => 'User Login Successfully'
        ];
        $data = [

            'token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()->load('barcodeFormat','employee','organization'),
            'expires_in' => auth()->factory()->getTTL() * 60 * 24
        ];
        return response()->json([
            'status' => $status,
            'data' => $data
        ]);
    }
}