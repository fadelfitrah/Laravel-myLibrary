<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    /**
     * Get the number of books in this genre.
     *
     * @return int
     */
    public function getBookCountAttribute()
    {
        return $this->books()->count();
    }
}
