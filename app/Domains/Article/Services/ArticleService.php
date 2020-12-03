<?php


namespace App\Domains\Article\Services;


use App\Domains\Article\Repositories\ArticleRepository;
use App\Http\Requests\ArticleRequest\StoreRequest;
use Mehnat\Core\Abstracts\AbstractService;

class ArticleService extends AbstractService
{
    protected $filter_fields = ['user_id' => ['type' => 'number'], 'alias' => ['type' => 'string', 'exact' => false]];

    public function __construct(ArticleRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(StoreRequest $request): object
    {
        $data = $request->validated();
        return $this->repo->create($data);
    }

    public function update(StoreRequest $request, int $id): object
    {
        $data = $request->validated();
        return $this->repo->update($data, $id);
    }


}
