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

    public function __construct()
    {
        $this->repo = new ArticleRepository;
    }

    public function filter(Builder $query): Builder
    {
        $user_id = request()->get('user_id', false);
        $alias = request()->get('article_id', false);

        if ($user_id) {
            $query->where('user_id', 'like', "%$user_id%");
        }

        if ($alias) {
            $query->where('article_id', 'like', "%$alias%");
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

    public function notify($user, string $type)
    {
        $strategy = (new NotificationStrategy)->getStrategy($type);
        $strategy->send();
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

    public function update(StoreRequest $request,int $id): Article
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
