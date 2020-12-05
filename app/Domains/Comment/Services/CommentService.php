<?php

namespace Mehnat\Comment\Services;

use Mehnat\Comment\Repositories\CommentRepository;
use App\Http\Requests\CommentRequest;
use Mehnat\Comment\Entities\Comment;
use Mehnat\Core\Abstracts\AbstractService;

class CommentService extends AbstractService
{
    protected $filter_fields = ['user_id' => ['type' => 'number'], 'article_id' => ['type' => 'number'], 'text' => ['type' => 'string']];

    public function __construct(CommentRepository $repo)
    {
        $this->repo = $repo;
    }
}
