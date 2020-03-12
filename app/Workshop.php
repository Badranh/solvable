<?php

namespace App;

use App\Events\TestEvent;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model {
    protected $fillable = [
        'Title', 'Problem', 'owner', 'link', 'nparticipants', 'rounds'
    ];

    protected $attributes = [
        'voted' => 0,
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
        }
        $a = array();
        for ($i = 0;$i<$this->nparticipants;$i++)
            $a[$i] = $i+1;
        
        shuffle($a);

        $i = 0;
        foreach ($this->participants as $u){
            if ($u->id != auth()->user()->id) {
                $u->workshop_pos = $a[$i];
                $u->save();
                $i++;
            }
        }
        event(new TestEvent('hello',auth()->user()->workshop->link,'facilitator'));
        event(new TestEvent('hello',auth()->user()->workshop->link,'participant'));
    }

    public function finalize() {
        $participants = $this->participants;
        foreach ($participants as $p) {
            $p->workshop_id = 0;
            $p->iteration = 0;
            $p->workshop_pos = 0;
            $p->card_id = -1;
            $p->save();
        }
    }

    public function isFull() {
        return $this->participants()->count() == $this->nparticipants+1;
    }

    public function isShuffling() {
        return $this->cards()->count() == $this->nparticipants;
    }
}
