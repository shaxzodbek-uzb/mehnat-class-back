<?php

namespace App\Http\Controllers\Api;

use Response;
use Validator;
use Illuminate\Http\Request;
use Mehnat\User\Entities\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Mehnat\User\Services\UserService;
use Mehnat\User\Repositories\UserRepository;

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
        return Response::customResponse(true, $users, 'Users retrieved successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();

        $rules = [
            'username' => 'required|string|unique:users,username',
            'password' => 'required',
            'fullname' => 'required',
            'age' => 'numeric'
        ];

        $validate = Validator::make($input, $rules);

        if($validate->fails()) {
            return Response::customResponse(false, $validate->failed(), 'Data not valid!');
        }

        $model = new $this->usersClass;
        $result = $this->userRepository->create($model, $input);

        if($result) {
            return Response::customResponse(true, $result, 'Successfully created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->usersClass::query();

        $result = $this->userRepository->getById($user, $id);

        return Response::customResponse(true, $result, 'User retrieved successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $rules = [
            'username' => 'required|string|unique:users,username,'.$id,
            'password' => 'required',
            'fullname' => 'required',
            'age' => 'numeric'
        ];

        $validate = Validator::make($input, $rules);

        if($validate->fails()) {
            return Response::customResponse(false, $validate->failed(), 'Data not valid!');
        }

        $user = $this->usersClass::query();
        $user = $this->userRepository->getById($user, $id);
        $result = $this->userRepository->update($user, $input);

        if($result) {
            return Response::customResponse(true, $result, 'User successfully updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->usersClass::query();

        $user = $this->userRepository->getById($user, $id);
        $result = $this->userRepository->destroy($user, $id);

        if($result) {
            return Response::customResponse(true, [], 'User deleted!');
        }
    }
}
