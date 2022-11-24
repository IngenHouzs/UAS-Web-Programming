<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Publisher extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function book(){
        return $this->hasOne(Book::class);
    }

}
