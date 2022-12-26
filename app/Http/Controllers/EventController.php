<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search)
        {
            // $events = Event::where([
            //     ['title', 'like', '%'.$search.'%'],
            //     ['description', 'like', '%'.$search.'%']
            // ])->get();
            $events = Event::where('title','like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->get();
        }
        else    
        {
            $events = Event::all();
        }
        return view('welcome',['events' => $events, 'search' => $search]);
    
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
        $event->items = $request->items ;
        $event->date = $request->date ;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $requestImage = $request->image;
            
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;// Criar um nome unico adicionando no nome original da image com o tempo 
        
            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        } 
        
        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect(route('events.index'))->with('msg', "Evento criado com sucesso!");

    }
    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('events.show',['event' => $event]);
    }
}
