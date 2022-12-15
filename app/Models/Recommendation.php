<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;
    
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function emotions()
    {
        return $this->belongsToMany(Emotion::class);
    }
    
    public function Recruite()
    {
        return $this->belongsTo(Recruite::class);
    }
    
    
    public function getByLimit(int $limit_count = 20)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('book','user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    
    protected $fillable = [
    'user_id',
    'book_id',
    'timing',
    'feeling',
    'point',
    'recruite_id'
    ];
}
