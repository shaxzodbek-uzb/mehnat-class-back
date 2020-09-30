<?php

namespace Mehnat\Article\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $table = 'articles';

    public function comments()
    {
        return $this->hasMany(\Mehnat\Comment\Entities\Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(Mehnat\User\Entities\User::class);
    }
}
