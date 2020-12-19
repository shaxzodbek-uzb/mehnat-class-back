<?php
namespace Mehnat\Article\Resources;

use Mehnat\Core\Fields\{BelongsTo, ID, Text};
use Mehnat\Article\Entities\Article;
use Mehnat\User\Resources\UserResource;
class ArticleResource
{
    public $model = Article::class;
    public $title = 'alias';
    
    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('text'),
            Text::make('alias'),
            BelongsTo::make(UserResource::class, 'user'),
        ];
    }
}