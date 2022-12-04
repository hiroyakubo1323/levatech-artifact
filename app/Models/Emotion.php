<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    use HasFactory;
    
    public function recommendations()
    {
        return $this->belongsToMany(Recommendation::class);
    }
}
