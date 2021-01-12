<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\User\StoreRequest;
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
    public function index(IndexRequest $request)
    {
        $users = $this->service->get($request);
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
     */
    public function store(StoreRequest $request)
    {
        $params = $request->validated();
        $result = $this->service->create($params);
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
        $result = $this->service->show($id);
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

    public function edit(int $id)
    {
        $data['data'] = $this->service->show($id);
        $fields = $this->service->fields();
        $data['fields'] = $fields;
        return response()->json($data);
    }

    public function update(StoreRequest $request, int $id)
    {
        $params = $request->validated();
        $result = $this->service->edit($params, $id);
        if ($result) {
            return response()->json([
                'success' => true,
                'result' => $result
            ]);
        }
        return response()->json([
            'success' => false,
            'result' => 'Something went wrong'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string[]
     */
    public function destroy(int  $id)
    {
        $result = $this->service->delete($id);
        if ($result) {
            return [
                'success' => true,
                'message' => "User deleted!"
            ];
        }
    }
}
