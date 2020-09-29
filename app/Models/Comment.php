<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $table = 'comments';

    public function user()
    {
        return $this->belongsTo('Mehnat\User\Entities\User');
    }

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}
