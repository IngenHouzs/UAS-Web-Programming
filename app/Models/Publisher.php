<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Publisher extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penerbit';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $table = 'publishers';
    

    public function book(){
        return $this->hasMany(Book::class);
    }

}
