<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'pages', 'annotation', 'image', 'author_id'];

    # Relations
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
