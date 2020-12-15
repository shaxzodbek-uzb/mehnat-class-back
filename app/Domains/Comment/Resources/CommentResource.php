<?php
namespace Mehnat\Comment\Resources;

use Mehnat\Core\Fields\{BelongsTo, ID, Text};

class CommentResource
{
    public function fields(): array
    {
        return [
            ID::make(),
            BelongsTo::make('user_id', 'user'),
            BelongsTo::make('article_id', 'article'),
            Text::make('text'),
            Text::make('description')
        ];
    }
}