<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruite extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function Recommendation()
    {
        return $this->hasMany(Recommendation::class);
    }
    
    public function getPaginate()
    {
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate(20);
    }
    
    public function getUserPaginate($user_id)
    {
        return $this::with('user')->where('user_id', $user_id)->orderBy('updated_at', 'DESC')->paginate(20);
    }
    
    protected $fillable = [
    'user_id',
    'scene'
    ];
}
