<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];

    //Relacion de muchos a uno
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
