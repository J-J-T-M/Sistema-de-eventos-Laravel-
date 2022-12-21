<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    public function index()
    {
        
    $events = Event::all();

    return view('welcome',['events' => $events]);
    
    }
    public function create()
    {
        return view('events.create');
    }
    // public function store(Request $request, Event $event)
    // {
    //     $event::create($request->all());

    //     return redirect(route('events.index'));
    // }
    public function store(Request $request)
    {
        $event = new Event;

        $event->title = $request->title ;
        $event->city = $request->city ;
        $event->private = $request->private ;
        $event->description = $request->description ;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $requestImage = $request->image;
            
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;// Criar um nome unico adicionando no nome original da image com o tempo 
        
            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        } 
         
        $event->save();

        return redirect(route('events.index'))->with('msg', "Evento criado com sucesso!");

    }
}
