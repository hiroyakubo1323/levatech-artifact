<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
    
    public function getAnswerByLimit($recruite_id)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('book','user')->where('recruite_id', $recruite_id)->orderBy('updated_at', 'DESC')->paginate(20);
    }
    
    public function getEmotionByLimit($input_emotions)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('book','user')->whereHas('emotions', function (Builder $query) use($input_emotions) {
            $query->whereIn('emotion_id', $input_emotions);
        })->orderBy('updated_at', 'DESC')->paginate(20);
    }
    
    public function getUserByLimit($user_id)
    {
        return $this::with('book','user')->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->paginate(20);
    }
    
    public function getBookByLimit($book_id)
    {
        return $this::with('book','user')->where('book_id', $book_id)->orderBy('updated_at', 'DESC')->paginate(20);
    }
    
    public function getUserEmotionByLimit($user_id,$input_emotions)
    {
        return $this::with('book','user')->where('user_id', $user_id)->whereHas('emotions', function (Builder $query) use($input_emotions) {
            $query->whereIn('emotion_id', $input_emotions);
        })->orderBy('updated_at', 'DESC')->paginate(20);
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
