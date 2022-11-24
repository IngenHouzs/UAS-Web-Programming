<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Author extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penulis';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $table = 'authors';
}
