<?php

namespace Mehnat\Comment\Services;

use App\Http\Requests\UserRequest;
use Mehnat\Comment\Repositories\CommentRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Collection;
use Mehnat\Comment\Entities\Comment;

class CommentService
{
    private $commentRepo;

    public function __construct()
    {
        $this->commentRepo = new CommentRepository();
    }

    public function filter(Builder $query): Builder
    {
        $user_id = request()->get('user_id', false);
        $article_id = request()->get('article_id', false);

        if ($user_id) {
            $query->where('user_id', 'like', "%$user_id%");
        }

        if ($article_id) {
            $query->where('article_id', 'like', "%$article_id%");
        }

        return $query;
    }

    public function sort($query): Builder
    {
        $key = request()->get('sort_key', 'user_id');
        $order = request()->get('sort_order', 'asc');
        $query->orderBy($key, $order);

        return $query;
    }

    public function notify($user, string $type)
    {
        $strategy = (new NotificationStrategy)->getStrategy($type);
        $strategy->send();
    }

    public function all(): Collection
    {
        $comments = $this->commentRepo->getQuery();
        $comments = $this->filter($comments);
        $comments = $this->sort($comments);
        $comments = $comments->orderBy('id', 'desc');
        $comments = $this->commentRepo->getAll();
        return $comments;
    }

    public function show($id): Comment
    {
        $comment = $this->commentRepo->getQuery();
        $comment = $this->commentRepo->getById($comment, $id);
        return $comment;
    }

    public function create(CommentRequest $request): Comment
    {
        $data = $request->validated();
        $comment = $this->commentRepo->create($data);
        return $comment;
    }

    public function update(CommentRequest $request,int $id): Comment
    {
        $data = $request->validated();
        $comment = $this->commentRepo->update($data, $id);
        return $comment;
    }

    public function delete(int $id)
    {
        $comment = $this->commentRepo->destroy($id);
        return $comment;
    }
}
