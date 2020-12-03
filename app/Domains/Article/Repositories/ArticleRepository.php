<?php


namespace App\Domains\Article\Repositories;


use App\Domains\Core\Abstracts\AbstractRepository;
use Mehnat\Article\Entities\Article;

class ArticleRepository extends AbstractRepository
{

    public function __construct(Article $entity)
    {
        $this->entity = $entity;
    }
    public function storeAsRead($params){
        $params['read'] = true;
        return $this->store($params);
    }
    public function destroyWithQueryFilter($id)
    {
        $item = $this->getQuery()->where('active', true)->first();
        return $item->delete();
    }
    public function getNameAttribute($value){
        return $value . '-';
    }
}
