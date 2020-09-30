<?php
namespace Mehnat\Comment\Transformers;

use Mehnat\Comment\Entities\Comment;
use Mehnat\Article\Transformers\ArticleTransformer;
use League\Fractal;

class CommentTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'article',
    ];
	public function transform(Comment $comment)
	{
	    return [
            'id'      => (int) $comment->id,
            'text'      => $comment->text,
        ];
    }
    
    public function includeArticle(Comment $comment)
    {
        return $this->item($comment->article, new ArticleTransformer);
    }
}
