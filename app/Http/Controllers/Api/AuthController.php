<?php

namespace App\Http\Controllers\Api;

use App\Domains\User\Repositories\AuthRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = new AuthRepository();
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request)
    {
        $token = $this->repo->getToken($request);
        return $token;
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens->each(function ($token, $key){
           $token->delete();
        });

        return response()->json('Logged successfully');
    }

    protected function getInfo()
    {
        return [
            'user' => Auth::user(),
            'role' => Auth::user()->roles ? Auth::user()->roles : null,
            'token_type' => 'bearer',
        ];
    }
}
