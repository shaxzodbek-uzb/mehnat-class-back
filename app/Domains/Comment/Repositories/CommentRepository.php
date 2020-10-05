<?php

namespace Mehnat\Comment\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Mehnat\Comment\Entities\Comment;


class CommentRepository
{
    private $comments;

    public function __construct()
    {
        $this->comments = new Comment;
    }

    public function getAll(Builder $query = null): Collection
    {
        if ($query)
            return $query->get();
        else
            return $this->comments->all();
    }

    public function create($data)
    {
        $model = $this->comments;
        $model->user_id = $data['user_id'];
        $model->article_id = $data['article_id'];
        $model->text = $data['text'];
        $model->save();
        return $model;
    }

    public function getById($query, $id): Comment
    {
        return $query->findOrFail($id);
    }

    public function update($data, $id): Comment
    {
        $model = $this->getById($this->comments, $id);
        $model->update($data);
        return $model;
    }

    public function destroy($id)
    {
        $model = $this->getById($this->comments, $id);

        return $model->delete();
    }

    public function getQuery(): Builder
    {
        return $this->comments->query();
    }
}
