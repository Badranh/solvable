<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'text',
    ];

    protected $attributes = [
        'score' => 0,
    ];

    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
