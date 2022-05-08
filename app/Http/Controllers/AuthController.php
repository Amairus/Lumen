<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        //check if Password and email is not empty
        if(empty($email) OR empty($password))
            return response()->json(['status' => 'error', 'message' => 'Please fill all fields']);

        $client = new Client();

        try {
            //code...
            return $client->post(config('service.passport.login_endpoint'),[
                "form_params" => [
                    "client_secret" => config('service.passport.client_secret'),
                    "grant_type" => "password",
                    "client_id" => config('service.passport.client_id'),
                    "username" => $request->email,
                    "password" => $request->password
                ]
            ]);
        } catch (BadResponseException $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function register(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        //Check if field is not empty
        if(empty($name) OR empty($email) OR empty($password))
        return response()->json(['status' => 'error', 'message' => 'Please fill all fields']);
    }

}
