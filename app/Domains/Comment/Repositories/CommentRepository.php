<?php

namespace Mehnat\Comment\Repositories;

use App\Domains\Core\Abstracts\AbstractRepository;
use Mehnat\Comment\Entities\Comment;


class CommentRepository extends AbstractRepository
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $model = $this->model;
        $model->user_id = $data['user_id'];
        $model->article_id = $data['article_id'];
        $model->text = $data['text'];
        $model->save();
        return $model;
    }

    public function update($data, $id): object

    {
        $model = $this->getById($this->model, $id);
        $model->update($data);
        return $model;
    }

    public function destroy(int $id): bool
    {
        $model = $this->getById($this->model, $id);

        return $model->delete();
    }

}
