<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_date',
        'genre_id',
        'description',
        'image_url',
        'status',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    protected $casts = [
        'published_date' => 'date',
    ];
    /**
     * Get the URL of the book's image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->attributes['image_url'] && file_exists(public_path($this->attributes['image_url']))) {
            return asset($this->attributes['image_url']);
        } elseif ($this->attributes['image_url'] && file_exists(storage_path('app/public/' . $this->attributes['image_url']))) {
            return asset('storage/' . $this->attributes['image_url']);
        }

        return asset('images/default-book.jpg');
    }
    /**
     * Get the book's full title with author.
     *
     * @return string
     */
    public function getFullTitleAttribute()
    {
        return "{$this->title} by {$this->author}";
    }
    /**
     * Scope a query to only include books of a given genre.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $genre
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfGenre($query, $genreId)
    {
        return $query->where('genre_id', $genreId);
    }

    /**
     * Scope a query to search books by title or author.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $searchTerm
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getBorrowedStatusAttribute()
    {
        return $this->loans()->where('status', 'borrowed')->exists();
    }    
}
