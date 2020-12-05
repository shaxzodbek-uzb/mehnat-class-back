<?php

namespace App\Http\Controllers\Api;

use App\Domains\Article\Services\ArticleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest\StoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mehnat\Article\Transformers\ArticleTransformer;
use League\Fractal;
use League\Fractal\Manager;

class ArticleController extends Controller
{
    private $manager;
    private $articleService;
    private $articleTransformer;

    public function __construct(ArticleService $service)
    {
        $this->manager = new Manager;
        $this->articleService = $service; //app()->make(ArticleService::class);
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
    public function index(Request $request)
    {
        $articles = $this->articleService->get($request);
        $resource = new Fractal\Resource\Collection($articles, $this->articleTransformer);
        return response()->json($this->manager->createData($resource)->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
        $result = $this->articleService->create($request);
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
        $article = $this->articleService->show($id);
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
    public function update(StoreRequest $request, int $id)
    {
        $result = $this->articleService->update($request, $id);
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
        $result = $this->articleService->delete($id);
        if ($result) {
            return [
                'success' => true,
                'message' => "Article deleted!"
            ];
        }
    }
}
