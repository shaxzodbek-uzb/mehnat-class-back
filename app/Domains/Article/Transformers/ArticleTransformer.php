<?php
namespace Mehnat\Article\Transformers;

use Mehnat\Article\Entities\Article;
use Mehnat\Comment\Transformers\CommentTransformer;
use Mehnat\User\Transformers\UserTransformer;

use League\Fractal;

class ArticleTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'comments',
        'user'
    ];
	public function transform(Article $article)
	{
	    return [
            'id'      => (int) $article->id,
            'alias'      => $article->alias,
            'text'      => $article->text,
        ];
    }
    public function includeComments(Article $article)
    {
        return $this->collection($article->comments, new CommentTransformer);
    }
    public function includeUser(Article $article)
    {
        return $this->item($article->user, new UserTransformer);
    }
}
