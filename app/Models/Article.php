<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public static function paginate($int)
    {
    }

    public function comments(){
      return $this->hasMany(Comment::class, 'article_id', 'id');
    }
}
