<?php
namespace Mehnat\Comment\Transformers;

use Mehnat\Comment\Entities\Comment;
use Mehnat\Article\Transformers\ArticleTransformer;
use Mehnat\User\Transformers\UserTransformer;
use League\Fractal;

class CommentTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'articles',
        'user'
    ];
	public function transform(Comment $comment)
	{
	    return [
            'id'      => (int) $comment->id,
            'text'    => $comment->text,
            'user'    => $comment->user
        ];
    }
    
    public function includeArticles(Comment $comment)
    {
        return $this->item($comment->article, new ArticleTransformer);
    }
    public function includeUser(Comment $comment)
    {
        return $this->item($comment->user, new UserTransformer);
    }
}
