<?php


namespace App\Domains\Article\Services;


use App\Domains\Article\Repositories\ArticleRepository;
use App\Http\Requests\ArticleRequest\StoreRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Mehnat\Article\Entities\Article;

class ArticleService
{
    private $repo;
    protected $filter_fields = ['user_id'=> ['type' => 'number'], 'article_id' => ['type' => 'string', 'exact' => false]];

    public function __construct(ArticleRepository $repo)
    {
        $this->repo = $repo;
    }

    public function filter(Builder $query): Builder
    {
        foreach($filter_fields as $key => $item){
            if($request->$key){
                if($item['type'] == 'string')
                    $query->where($key, 'like', "%$request->$key%");
                if($item['type'] == 'number')
                    $query->where($key, $request->$key);
            }
        }
        return $query;
    }

    public function sort($query): Builder
    {
        $key = request()->get('sort_key', 'user_id');
        $order = request()->get('sort_order', 'asc');
        $query->orderBy($key, $order);

        return $query;
    }

    public function all(): Collection
    {
        $articles = $this->repo->getQuery();
        $articles = $this->filter($articles);
        $articles = $this->sort($articles);
        $articles = $articles->orderBy('id', 'desc');
        $articles = $this->repo->getAll();
        return $articles;
    }

    public function show($id): Article
    {
        $article = $this->repo->getQuery();
        $article = $this->repo->getById($article, $id);
        return $article;
    }

    public function create(StoreRequest $request): Article
    {
        $data = $request->validated();
        $article = $this->repo->create($data);
        return $article;
    }

    public function update(StoreRequest $request, int $id): Article
    {
        $data = $request->validated();
        $article = $this->repo->update($data, $id);
        return $article;
    }

    public function delete(int $id)
    {
        $article = $this->repo->destroy($id);
        return $article;
    }
}
