<?php

namespace Mehnat\Comment\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $table = 'comments';

    protected $fillable = [
        'user_id', 'article_id', 'text'
    ];
    public function user()
    {
        return $this->belongsTo(\Mehnat\User\Entities\User::class);
    }

    public function article()
    {
        return $this->belongsTo(\Mehnat\Article\Entities\Article::class);
    }
}
