<?php
namespace Mehnat\Comment\Resources;

use Mehnat\Core\Fields\{BelongsTo, ID, Text};
use Mehnat\User\Resources\UserResource;
use Mehnat\Article\Resources\ArticleResource;
use Mehnat\Comment\Entities\Comment;

class CommentResource
{
    public $model = Comment::class;
    public $title = 'id';

    public function fields(): array
    {
        return [
            ID::make(),
            BelongsTo::make(UserResource::class, 'user'),
            BelongsTo::make(ArticleResource::class, 'article'),
            Text::make('text'),
        ];
    }
}