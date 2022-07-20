<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
class EventController extends Controller
{
    public function index()
    {   
        $search = request('search');
        if($search)
            $events = Event::where('title', 'like','%'.$search.'%')->get();
        else
            $events = Event::all();

        return view('welcome',['events'=>$events, 'search'=>$search]);
    }
    public function create()
    {
        return view('events.create');
    }
    public function store(Request $request)
    {
        $new_event = new Event;
        $new_event->title = $request->title;
        $new_event->description = $request->description;
        $new_event->city = $request->city;
        $new_event->private = $request->private;
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $fileNameWithExt = $request->file('image')->getClientOriginalName(); //Nome da imagem com extensão
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);   // Nome sem extensão
            $extension= $request->file('image')->getClientOriginalExtension();  //Extensão
            $imageName = md5($fileName . strtotime("now")) . "." . $extension;  //Montar nome da imagem
            $path = $request->file('image')->storeAs('public/img/events',$imageName);   //Caminho completo com novo nome
            $new_event->image = $imageName;
        }
        else{
            $new_event->image = "default.png";
        }
        
        $new_event->items = $request->items;
        $user = auth()->user();
        $new_event->user_id = $user->id;
        $new_event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $eventOwner = $event->user()
            ->where('id', $event->user_id)
            ->first()
            ->toArray();
        return view('events.show',['event' => $event, 'eventOwner'=>$eventOwner]);
    }

    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;
        return view('events.dashboard', ['events'=>$events]);
    }
    public function edit(Request $request)
    {
        $event = Event::findOrFail($request->id);
        
        return view('events.edit',['event'=>$event]);
    }

    public function update(Request $request)
    {
        $event = Event::findOrFail($request->id);
        $event->update([
            'title' => $request->event,
            'city' => $request->city,
            'description' => $request->description,
            'private' => $request->private
        ]);

        return redirect('/dashboard')->with('msg',"Evento '$event->title' atualizado com sucesso ");
    }
}
