<?php

namespace App\Http\Controllers\Api;

use League\Fractal;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Mehnat\Comment\Services\CommentService;
use Mehnat\Comment\Transformers\CommentTransformer;

class CommentController extends Controller
{
    private $manager;
    protected $service;
    private $commentTransformer;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
        $this->manager = new Manager;
        $this->commentTransformer = new CommentTransformer;

        if (isset($_GET['include'])) {
            $this->manager->parseIncludes(request()->get('include'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $comments = $this->service->get($request);
        $resource = new Fractal\Resource\Collection($comments, $this->commentTransformer);
        return response()->json($this->manager->createData($resource)->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(CommentRequest\StoreRequest $request)
    {
        $result = $this->service->create($request);
        if ($result) {
            $resource = new Fractal\Resource\Item($result, $this->commentTransformer);
//            return response()->json($this->manager->createData($resource)->toArray());
            return [
                'success' => true,
                'result' => $result
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $comment = $this->service->show($id);
        $resource = new Fractal\Resource\Item($comment, $this->commentTransformer);
        return response()->json($this->manager->createData($resource)->toArray());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $result = $this->service->delete($id);
        if ($result) {
            return [
                'success' => true,
                'message' => "Comment deleted!"
            ];
        }
    }
}
