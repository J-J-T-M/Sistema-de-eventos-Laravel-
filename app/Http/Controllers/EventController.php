<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        else
        {
            $event->image = 'event_placeholder.jpg';
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect(route('events.index'))->with('msg', "Evento criado com sucesso!");

    }
    public function show($id)
    {
        $user = auth()->user();
        $hasUserJoined = false;

        $event = Event::findOrFail($id);

        if($user)
        {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $userEvent) {
                if($userEvent['id'] == $id)
                {
                    $hasUserJoined =true;
                }
            }
        }

        $eventOwner =  User::where('id',$event->user_id)->first()->toArray();

        return view('events.show',['event' => $event, 'eventOwner' => $eventOwner , 'hasUserJoined' => $hasUserJoined]);
    }
    public function dashboard()
    {
        $user = auth()->user();

        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', [
            'events' => $events ,
            'eventsAsParticipant' => $eventsAsParticipant]);
    }
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');

    }
    public function edit($id)
    {
        $user = auth()->user();

        $event = Event::findOrFail($id);

        if ($user->id != $event->user_id)
        {
            return redirect('/dashboard');
        }

        return view('events.edit',['event' => $event]);
    }
    public function update(Request $request)
    {
        $data = $request->all();
        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;// Criar um nome unico adicionando no nome original da image com o tempo

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }
    public function joinEvent($id)
    {
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);//vai vincular o id do participante e do evento

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento '. $event->title.' com sucesso!');

    }
    public function leaveEvent($id)
    {
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);// remove a ligação

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua inscrição do evento '. $event->title.' foi cancelada com sucesso!');

    }
}
