<?php

namespace App\Http\Controllers;

use App\Workshop;
use App\User;
use Illuminate\Http\Request;
use App\Events\TestEvent;

class WorkshopController extends Controller {
    function randomS($length = 10) {
        do {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        } while (Workshop::where('link',$randomString)->count() != 0);

        return $randomString;
    }

    public function store(Request $request) {
        $w = new Workshop();
        $w->Title = $request->get('title');
        $w->Problem = $request->get('problem');
        $w->owner = $request->user()->id;
        $w->link = $this->randomS(15);
        if ($request->rounds > 0)
            $w->rounds = $request->rounds;
        else 
            $w->rounds = 1;
        if ($request->nparticipants > 2)
            $w->nparticipants = $request->get('nparticipants');
        else
            $w->nparticipants = 3;
        $w->save();

        $request->user()->workshop()->associate($w);
        $request->user()->save();

        return redirect(route('workshop.view'));
    }

    public function view(Request $r) {
        $w = $r->user()->workshop;
        if (!$w) return redirect(route('home'));

        if ($r->user()->id == $w->owner) {
            //Workshop Facilitator
            return view('User/workshopfacilitator',compact('w'));
        } else{
            //Workshop Participant
            if (!$w->isShuffling()) {
                //users are submiting thier cards
                return view('User/workshopparticipant',compact('w'));
            } else if ($r->user()->iteration < $w->participants()->count() - 2 && $r->user()->iteration < $w->rounds){   
                //user is rating cards
                $i = ($r->user()->iteration + $r->user()->workshop_pos) % ($w->participants()->count() - 1);
                $u = $w->participants->where('workshop_pos',$i+1)->first();
                $c = $u->card;
                return view('User/workshopparticipant',compact('w','c'));
            } else {
                //participants is watching the results
                return view('User/workshopparticipant',compact('w'));
            }
        }

    }

    public function initialize(Request $r) {
        $w = $r->user()->workshop;
        $w->initialize();
    }

    public function finalize(Request $r) {
        $w = $r->user()->workshop;
        $w->finalize();
        return redirect(route('home'));
    }

    public function viewHistory(Request $r) {
        $w = Workshop::where('id',$r->wid)->first();
        $c = $w->cards()->where('user_id',$r->user()->id)->count();
        if ($w->owner == $r->user()->id || $c != 0)
            return view ('User/workshop',compact('w'));
        
        return redirect(route('home'));
    }
}
