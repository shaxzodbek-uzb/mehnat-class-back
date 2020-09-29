<?php

namespace App\Http\Controllers;

use DB;
use Response;
use Illuminate\Http\Request;
use Mehnat\User\Entities\User;
use Mehnat\User\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Domains\SmsGate\Interfaces\SmsGateAdapterInterface;
use App\Domains\User\Repositories\UserProfileRepository;

class UserController extends Controller
{
    private $userService;
    private $smsGate;
    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function index()
    {
        DB::beginTransaction();
        try{

            $users = $this->userService->getUsers();

        }
            catch(\Exception $e){

            DB::rollBack();

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $this->userRepository->create($request);
        $profile = $this->userProfileRepository->create($user);
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $params = $request->validate();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

