<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Mehnat\User\Entities\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Mehnat\User\Services\UserService;

class UserController extends Controller
{

    private $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getUsers();

        return Response::get(true, $users, 'Ok!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return UserRequest|Request|\Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
//        return $request;
        $result = $this->userService->getCreate($request);
        if ($result) {
            return Response::get(true, $result, 'Successfully created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return string
     */
    public function show(int $id)
    {
        $result = $this->userService->getShow($id);
        return Response::get(true, $result, 'User retrieved successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return array
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $result = $this->userService->getUpdate($request, $id);
        if ($result) {
            return Response::get(true, $result, 'User successfully updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string[]
     */
    public function destroy(int  $id)
    {
        $result = $this->userService->getDelete($id);
        if ($result) {
//            return Response::get(true, [], 'User deleted!');
            return [
                'success' => true,
                'message' => "User deleted!"
            ];
        }
    }
}
