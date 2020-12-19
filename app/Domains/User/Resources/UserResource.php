<?php
namespace Mehnat\User\Resources;

use Mehnat\Core\Fields\{BelongsTo, ID, Text};
use Mehnat\User\Entities\User;

class UserResource
{
    public $model = User::class;
    public $title = 'fullname';
    
    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('username'),
            Text::make('fullname'),
        ];
    }
}