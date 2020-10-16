<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:subscribers',
        ]);

        $s = new Subscriber();
        $s->email = $request->email;
        $s->save();

        session()->flash('successSubscriber', 'Subscriber Added Successfully');
        return redirect()->back();
    }

    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('subscriber.index',compact('subscribers'));
    }

    public function deleteSubscriberFunction($subscriber){
        $subscriber = Subscriber::find($subscriber);
        $subscriber->delete();
        return redirect(route('subscriber.index'))->with('success','Subscriber Deleted Successfully');
    }
}
