<?php
namespace Mehnat\User\Transformers;

use Mehnat\User\Entities\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
	public function transform(User $user)
	{
	    return [
            'id'      => (int) $user->id,
            'username'   => $user->username,
            'age'    => $user->age
        ];
	}
}
