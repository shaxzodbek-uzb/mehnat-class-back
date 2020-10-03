<?php
namespace Mehnat\User\Transformers;

use Mehnat\Comment\Transformers\CommentTransformer;
use Mehnat\Article\Transformers\ArticleTransformer;
use Mehnat\User\Entities\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'comments',
        'articles',
    ];
	public function transform(User $user)
	{
	    return [
            'id'      => (int) $user->id,
            'username'   => $user->username,
            'fullname'   => $user->fullname,
            'birth_date'    => $user->birth_date,
        ];
    }
    public function includeComments(User $user)
    {
        return $this->collection($user->comments, new CommentTransformer);
    }
    public function includeArticles(User $user)
    {
        return $this->collection($user->articles, new ArticleTransformer);
    }
}
