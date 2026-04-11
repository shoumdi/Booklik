<?php
namespace App\Domain\Book\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model{
    protected $fillable = ['name','description'];
}