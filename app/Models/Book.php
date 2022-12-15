<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
    
    protected $fillable = [
        'googlebook_id',
        'happy', 
        'sadness', 
        'anger', 
        'surprised', 
        'fear', 
        'disgust',
        'author',
        'title',
        'publisher',
        'coverImage',
        'description'
        ];
}
