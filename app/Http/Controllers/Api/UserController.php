<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Mehnat\User\Services\UserService;
use Mehnat\User\Transformers\UserTransformer;
use League\Fractal;
use League\Fractal\Manager;


class UserController extends Controller
{

    private $service;
    private $manager;
    private $userTransformer;

    public function __construct(UserService $service)
    {
        $this->manager = new Manager;
        if (isset($_GET['include'])) {
            $this->manager->parseIncludes(request()->get('include'));
        }
        $this->userTransformer = new UserTransformer;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = $this->service->getUsers();
        $fields = $this->service->fields();
        $resource = new Fractal\Resource\Collection($users, $this->userTransformer);
        $data = $this->manager->createData($resource)->toArray();
        $data['fields'] = $fields;
        return response()->json($data);
    }

    public function create()
    {
        $fields = $this->service->fields();
        $data['fields'] = $fields;
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return UserRequest|Request|\Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $result = $this->service->getCreate($request);
        if ($result) {
            return response()->get(true, $result, 'Successfully created!');
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
        $result = $this->service->getShow($id);
        $resource = new Fractal\Resource\Item($result, $this->userTransformer);
        return response()->json($this->manager->createData($resource)->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $result = $this->service->getUpdate($request, $id);
        if ($result) {
            return response()->json([
                'success' => true,
                'result' => $result
            ]);
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
        $result = $this->service->getDelete($id);
        if ($result) {
            return [
                'success' => true,
                'message' => "User deleted!"
            ];
        }
    }
}
