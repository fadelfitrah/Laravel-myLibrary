<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'address',
        'borrowed_books',
        'phone',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function getProfileImageAttribute()
    {
        if ($this->attributes['profile_image'] && file_exists(public_path($this->attributes['profile_image']))) {
            return asset($this->attributes['profile_image']);
        } elseif ($this->attributes['profile_image'] && file_exists(storage_path('app/public/' . $this->attributes['profile_image']))) {
            return asset('storage/' . $this->attributes['profile_image']);
        }

        return asset('images/avatar-default.jpg');
    }

    public function getIsActiveAttribute()
    {
        if(!$this->last_login) return false;
        return \Carbon\Carbon::parse($this->last_login)->gt(now()->subMinutes(10));
    }

    public function getBooksBorrowedCountAttribute()
    {
        return $this->loans()->where('status', 'borrowed')->count();
    }
}
