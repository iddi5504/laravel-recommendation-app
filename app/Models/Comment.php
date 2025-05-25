<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable = [
        'content',
        'user_id',
        'recommendation_id'
    ];

    public function recommendation()
    {
        return $this->belongsTo(Recommendation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
