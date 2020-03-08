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
        event(new TestEvent($request->user(),$w->link));

        //initialize workshop if full
        if ($w->isFull()) {
            $w->initialize();
        }
        
        //return ('App\Http\Controllers\WorkshopController')->view($request);
        return redirect(route('workshop.view'));
    }

    public function createCard(Request $r) {
        $c = new Card();
        $c->user()->associate($r->user());
        $c->workshop()->associate($r->user()->workshop);
        $c->text = $r->solution;
        $c->save();
        return redirect(route('workshop.view'));
    }

    public function rateCard(Request $r) {
        $c = Card::find($r->cid)->first();
        $c->score += $r->rating;
        $c->save();

        $r->user()->iteration++;
        $r->user()->save();

        return redirect(route('workshop.view'));
    }
}
