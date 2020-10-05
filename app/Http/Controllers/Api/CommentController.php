<?php

namespace App\Http\Controllers\Api;

use League\Fractal;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Response;
use Mehnat\Comment\Services\CommentService;
use Mehnat\Comment\Transformers\CommentTransformer;

class CommentController extends Controller
{
    private $manager;
    private $commentService;
    private $commentTransformer;

    public function __construct()
    {       
        $this->manager = new Manager;
        $this->commentService = new CommentService;
        $this->commentTransformer = new CommentTransformer;

        if (isset($_GET['include'])) {
            $this->manager->parseIncludes(request()->get('include'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->commentService->all();
        $resource = new Fractal\Resource\Collection($comments, $this->commentTransformer);
        return response()->json($this->manager->createData($resource)->toArray());  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $result = $this->commentService->create($request);
        if ($result) {
            $resource = new Fractal\Resource\Item($result, $this->commentTransformer);
            return response()->json($this->manager->createData($resource)->toArray());
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
        $comment = $this->commentService->show($id);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->commentService->delete($id);
        if ($result) {
            return [
                'success' => true,
                'message' => "Comment deleted!"
            ];
        }
    }
}
