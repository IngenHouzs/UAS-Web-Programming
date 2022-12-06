<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;


use App\Models\Book;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $primaryKey = 'id';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';


    // ID User dalam bentuk randomized characters.
    public function setIdAttribute($id){
        $this->attributes['id'] = $this->attributes['nisn'];
    }

    // Mutator password hashing.
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    // ElOQUENT RELATIONSHIPS
    public function book(){
        return $this->belongsToMany(Book::class, 'book_loans', 'id_user', 'id_buku')
            ->withPivot('tanggal_peminjaman', 'tenggat_pengembalian', 'tanggal_pengembalian');
    }
}
