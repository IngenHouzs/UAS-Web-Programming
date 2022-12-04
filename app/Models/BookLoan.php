<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;


use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;


class BookLoan extends Model
{
    use HasFactory;

    
    protected $primaryKey = 'id_peminjaman';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;    


    public function loan_relation(){
        return $this->belongsToMany(User::class) && $this->belongsToMany(Book::class);
    }

    public function setIdPeminjamanAttribute($idPeminjaman){
        $this->attributes['id_peminjaman'] = uniqid('l', true);
    }


}
