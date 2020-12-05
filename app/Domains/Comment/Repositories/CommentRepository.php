<?php

namespace Mehnat\Comment\Repositories;

use App\Domains\Core\Abstracts\AbstractRepository;
use Mehnat\Comment\Entities\Comment;


class CommentRepository extends AbstractRepository
{
    public function __construct(Comment $entity)
    {
        $this->entity = $entity;
    }
}
