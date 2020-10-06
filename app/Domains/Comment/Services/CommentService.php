<?php


namespace App\Domains\Comment\Services;


use App\Domains\Comment\Repositories\CommentRepository;
use App\Http\Requests\CommentRequest\StoreRequest;
use Mehnat\Comment\Entities\Comment;

class CommentService
{
    private $repo;
    public function __construct()
    {
        $this->repo = new CommentRepository();
    }

    public function getComments()
    {
        $comment = $this->repo->query();
        $comment = $comment->orderBy('id', 'desc');
        $comment = $this->repo->getAll($comment->with(request()->get('include', null)));
        return $comment;
    }

    public function createService(StoreRequest $request): Comment
    {
        $data = $request->validated();
        $comment = $this->repo->store($data);
        return $comment;
    }

    public function delete($id)
    {
        $result = $this->repo->delete($id);
        return $result;
    }
}
