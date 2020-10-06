<?php


namespace App\Domains\Comment\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Mehnat\Comment\Entities\Comment;

class CommentRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new Comment;
    }

    public function query(): Builder
    {
        return $this->model->query();
    }

    public function getById($query, $id): Comment
    {
        return $query->findOrFail($id);
    }

    public function getAll(Builder $query = null): Collection
    {
        if ($query)
            return $query->get();
        else
            return $this->model->all();
    }

    public function store($data):Comment
    {
        $comment = $this->model;
        $comment->user_id = $data['user_id'];
        $comment->article_id = $data['article_id'];
        $comment->text = $data['text'];
        $comment->save();
        return $comment;
    }

    public function delete($id)
    {
        $comment = $this->query();
        $comment = $this->getById($comment, $id);
        $comment->delete();
        return "Deleted successfully";
    }

}
