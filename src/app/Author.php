<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['first_name', 'second_name', 'user_id'];

    # Relations
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
