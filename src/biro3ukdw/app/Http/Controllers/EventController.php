<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(){
        $events = Event::get();
        return view('event.index',[
            'events'=> $events
        ]);

    }

    public function create(){
    	
    	return view('event.create');
    	 	
    }
    public function edit($id){
           	$event = Event::where('id',$id)->first();
            return view('event.edit', compact('event'));
    }

     public function detail($id){
            $event = Event::where('id',$id)->first();
            return view('event.detail', compact('event')); 
     		
    }
    public function submit_new(Request $request){
    	$event = new Event;
    	$event->kategori = $request->input('kategori');
    	$event->sumber = $request->input('sumber');
    	$event->header_pic = $request->input('header_pic');
    	$event->tempat = $request->input('tempat');
    	$event->event_date = $request->input('event_date');
        $event->save();
        return redirect('/event/new/');
    }

    public function update(Request $request, $id){
    	$event = Event::find($id);
        $event->kategori = $request->input('kategori');
    	$event->sumber = $request->input('sumber');
    	$event->header_pic = $request->input('header_pic');
    	$event->tempat = $request->input('tempat');
    	$event->event_date = $request->input('event_date');
    	$event->save();
        return redirect('/event/edit/'.$id);
    }
}
