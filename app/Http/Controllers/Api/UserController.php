<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mehnat\User\Entities\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Mehnat\User\Services\UserService;
use Mehnat\User\Transformers\UserTransformer;
use League\Fractal;
use League\Fractal\Manager;

class UserController extends Controller
{

    private $userService;
    private $manager;
    private $userTransformer;

    public function __construct()
    {
        $this->manager = new Manager;
        $this->userTransformer = new UserTransformer;
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
        $resource = new Fractal\Resource\Collection($users, $this->userTransformer);
        dd($this->manager->createData($resource)->toArray());
        
        return Response::get(true, $users, 'Ok!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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

        if ($validate->fails()) {
            return Response::get(false, $validate->failed(), 'Data not valid!');
        }
        $result = $this->userService->getCreate($input);
        if ($result) {
            return Response::get(true, $result, 'Successfully created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->userService->getShow($id);

        return Response::get(true, $result, 'User retrieved successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->usersClass::query();

        $user = $this->userRepository->getById($user, $id);
        $result = $this->userRepository->destroy($user, $id);

        if ($result) {
            return Response::get(true, [], 'User deleted!');
        }
    }
}
