<?php

namespace App\Domains\User\Repositories;


class AuthRepository
{
    public function getToken($request)
    {
        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            return json_decode((string) $response->getBody(), true);
        } catch (\GuzzleHttp\Exception\BadResponseException $e){
            if ($e->getCode() == 400){
                return response()->json('Iltimos login va parolingizni kiriting.', $e->getCode());
            } else if($e->getCode() == 401) {
                return response()->json('Login yoki parol xato.', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }
}
