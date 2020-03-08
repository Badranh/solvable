<?php

namespace App;

use App\Events\TestEvent;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model {
    protected $fillable = [
        'Title', 'Problem', 'owner', 'link', 'nparticipants',
    ];

    public function participants() {
        return $this->hasMany(User::class);
    }

    public function cards() {
        return $this->hasMany(Card::class);
    }

    public function initialize() {
        if (!$this->isFull()) {
            $this->nparticipants = $this->participants()->count()-1;
            $this->save();
            event(new TestEvent(auth()->user(),auth()->user()->workshop->link));
        }
    }

    public function isFull() {
        return $this->participants()->count() == $this->nparticipants+1;
    }

    public function isShuffling() {
        return $this->cards()->count() == $this->nparticipants;
    }
}
