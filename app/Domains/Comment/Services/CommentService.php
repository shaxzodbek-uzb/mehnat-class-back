<?php

namespace Mehnat\Comment\Services;

use Mehnat\Comment\Repositories\CommentRepository;
use Mehnat\Core\Abstracts\AbstractService;
use Mehnat\Comment\Resources\CommentResource;

class CommentService extends AbstractService
{
    protected $resource = CommentResource::class;
    protected $filter_fields = ['user_id' => ['type' => 'number'], 'article_id' => ['type' => 'number'], 'text' => ['type' => 'string']];

    public function __construct(CommentRepository $repo)
    {
        $this->repo = $repo;
    }
}
