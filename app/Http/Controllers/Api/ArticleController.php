<?php

namespace App\Http\Controllers\Api;

use App\Domains\Article\Services\ArticleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\{IndexRequest, StoreRequest};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mehnat\Article\Transformers\ArticleTransformer;
use League\Fractal;
use League\Fractal\Manager;

class ArticleController extends Controller
{
    private $manager;
    private $service;
    private $articleTransformer;

    public function __construct(ArticleService $service)
    {
        $this->manager = new Manager;
        $this->service = $service; //app()->make(service::class);
        $this->articleTransformer = new ArticleTransformer;

        if (isset($_GET['include'])) {
            $this->manager->parseIncludes(request()->get('include'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request)
    {
        $articles = $this->service->get($request);
        $fields = $this->service->fields();
        $resource = new Fractal\Resource\Collection($articles, $this->articleTransformer);
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
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
        $params = $request->validated();
        $result = $this->service->create($params);
        if ($result) {
            return [
                'success' => true,
                'result' => $result
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $article = $this->service->show($id);
        $resource = new Fractal\Resource\Item($article, $this->articleTransformer);
        return response()->json($this->manager->createData($resource)->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param int $id
     * @return array
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
            return [
                'success' => true,
                'result' => $result
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     */
    public function destroy(int $id)
    {
        $result = $this->service->delete($id);
        if ($result) {
            return [
                'success' => true,
                'message' => "Article deleted!"
            ];
        }
    }
}
