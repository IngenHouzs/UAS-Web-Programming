<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\BookLoan;
use App\Models\Author;
use App\Models\Publisher;



class Book extends Model
{
    use HasFactory; 

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    // MUTATORS

    public function setIdAttribute($id){
        $this->attributes['id'] = uniqid('b', true);
    }



    // ELOQUENT RELATIONSHIPS 

    // public function user(){
    //     return $this->belongsToMany(User::class);
    // }

    // public function loan(){
    //     return $this->belongsToMany(BookLoan::class);
    // }

    public function author(){
        return $this->hasManyThrough(Author::class, BookAuthor::class, 
            'id_buku','id_penulis','id','id_penulis');
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class, 'id_penerbit');
    }



}
