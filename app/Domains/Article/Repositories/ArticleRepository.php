<?php


namespace App\Domains\Article\Repositories;


use App\Domains\Core\Abstracts\AbstractRepository;
use Mehnat\Article\Entities\Article;

class ArticleRepository extends AbstractRepository
{
    protected $request_fields = ['user_id', 'alias', 'text'];

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function create($data): object
    {
        $params = [
            'user_id' => $data['user_id'],
            'alias' => $data['alias'],
            'text' => $data['text']
        ];
        return $this->model->create($params);
//        return $this->store($data, $this->request_fields);
    }

    public function update($data, $id): object
    {
        $model = $this->getById($this->model, $id);
        $model->update($data);
        return $model;
    }

    public function destroy($id)
    {
        $model = $this->getById($this->model, $id);
        return $model->delete();
    }
}
