<?php


namespace App\Domains\Article\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Mehnat\Article\Entities\Article;

class ArticleRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Article;
    }

    public function getQuery()
    {
        return $query = $this->model->query();
    }

    public function getAll(Builder $query = null): Collection
    {
        if ($query)
            return $query->get();
        else
            return $this->model->all();
    }

    public function create($data)
    {
        $model = $this->model;
        $model->user_id = $data['user_id'];
        $model->alias = $data['alias'];
        $model->text = $data['text'];
        $model->save();
        return $model;
    }

    public function getById($query, $id): Article
    {
        return $query->findOrFail($id);
    }

    public function update($data, $id): Article
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
