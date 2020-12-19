<?php


namespace App\Domains\Article\Services;


use App\Domains\Article\Repositories\ArticleRepository;
use Mehnat\Core\Abstracts\AbstractService;
use Mehnat\Article\Resources\ArticleResource;
class ArticleService extends AbstractService
{
    protected $resource = ArticleResource::class;
    protected $filter_fields = ['user_id' => ['type' => 'number'], 'alias' => ['type' => 'string', 'exact' => false]];

    public function __construct(ArticleRepository $repo, $filter_params = [])
    {
        $this->repo = $repo;
        $this->loadFilterParams($filter_params);
    }

}
