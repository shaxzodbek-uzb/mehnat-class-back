<?php

namespace App\Http\Controllers\Api;

use App\Domains\Comment\Services\CommentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest\StoreRequest;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Response;
use League\Fractal;
use League\Fractal\Manager;
use Mehnat\Comment\Transformers\CommentTransformer;

class CommentController extends Controller
{
    protected $service;
    private $manager;
    private $commentTransformer;

    public function __construct()
    {
        $this->service = new CommentService();
        $this->manager = new Manager;
        if (isset($_GET['include'])) {
            $this->manager->parseIncludes(request()->get('include'));
        }
        $this->commentTransformer = new CommentTransformer();
    }

    public function index()
    {
        $comments = $this->service->getComments();
        $resource = new Fractal\Resource\Collection($comments, $this->commentTransformer);
        return response()->json($this->manager->createData($resource)->toArray());
    }

    public function store(StoreRequest $request)
    {
        $comment = $this->service->createService($request);
        if ($comment) {
//            return Response::get(true, $comment, 'Successfully created!');
            return [
                'success' => true,
                'result' => $comment
            ];
        }
    }

    public function destroy($id)
    {
        $result = $this->service->delete($id);
        return [
            'success' => true,
            'result' => $result
        ];
    }
}
