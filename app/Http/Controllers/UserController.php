<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TestEvent;
use App\Workshop;
use App\Card;

class UserController extends Controller {

    public function joinWorkshop(Request $request) {
        //Find the workshop to join
        $w = Workshop::where('link',$request->post('link'))->first();
        if (!$w) {
            echo('Workshop not found!');
            return redirect('join');
        }

        if ($w->isFull()) {
            echo ('Workshop full!');
            return redirect ('join');
        }

        $request->user()->workshop()->associate($w);
        $request->user()->workshop_pos = $w->participants()->count();
        $request->user()->save();

        //Send a notification to the facilitator
        event(new TestEvent('hello',auth()->user()->workshop->link,'facilitator'));

        //initialize workshop if full
        if ($w->isFull()) {
            $w->initialize();
        }
        
        return redirect(route('workshop.view'));
    }

    public function createCard(Request $r) {
        $c = new Card();
        $c->user()->associate($r->user());
        $c->workshop()->associate($r->user()->workshop);
        $c->text = $r->solution;
        $c->save();
        $r->user()->card_id = $c->id;
        $r->user()->save();

        event(new TestEvent('hello',auth()->user()->workshop->link,'facilitator'));

        if (auth()->user()->workshop->cards()->count() == auth()->user()->workshop->participants()->count() - 1)
            event(new TestEvent('hello',auth()->user()->workshop->link,'participant'));
            
        return redirect(route('workshop.view'));
    }

    public function rateCard(Request $r) {
        if ($r->rating > 0 && $r->rating < 6) {
            event(new TestEvent('hello',auth()->user()->workshop->link,'facilitator'));
            $c = Card::where('id',$r->cid)->where('workshop_id',$r->user()->workshop_id)->first();
            $c->score += $r->rating;
            $c->save();
    
            $r->user()->iteration++;
            $r->user()->save();
    
            if($r->user()->iteration == $r->user()->workshop->participants()->count() - 2 || $r->user()->iteration == $r->user()->workshop->rounds) {
                $r->user()->workshop->voted++;
                $r->user()->workshop->save();
            }
        }
        return redirect(route('workshop.view'));
    }

    public function history (Request $r) {
        $workshops = Workshop::where('owner',$r->user()->id)->orderBy('created_at','ASC')->get();
        $cards = Card::where('user_id',$r->user()->id)->get();
        return view('User/history',compact('workshops','cards'));
    }
}
