<?php


namespace App\Domains\Article\Services;


use App\Domains\Article\Repositories\ArticleRepository;
use Mehnat\Core\Abstracts\AbstractService;

class ArticleService extends AbstractService
{
    protected $filter_fields = ['user_id' => ['type' => 'number'], 'alias' => ['type' => 'string', 'exact' => false]];

    public function __construct(ArticleRepository $repo, $filter_params = [])
    {
        $this->repo = $repo;
        $this->loadFilterParams($filter_params);
    }

}
