<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
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
        $user = auth()->user();
        $hasUserJoined = false;
        if($user)
        {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $userEvent) {
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = $event->user()
            ->where('id', $event->user_id)
            ->first()
            ->toArray();
        return view('events.show',['event' => $event, 'eventOwner'=>$eventOwner, 'hasUserJoined'=>$hasUserJoined]);
    }

    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;        //eventos criados pelo usuario
        $eventsAsParticipant = $user->eventsAsParticipant;  //eventos que o usuário participa
        return view('events.dashboard', ['events'=>$events, 'eventsAsParticipant' => $eventsAsParticipant]);
    }
    public function edit(Request $request)
    {
        $user = auth()->user();
        $event = Event::findOrFail($request->id);
        if ($user->id != $event->user_id)
            return redirect('/dashboard');
    
        return view('events.edit',['event'=>$event]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        
        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            $fileNameWithExt = $request->file('image')->getClientOriginalName(); //Nome da imagem com extensão
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);   // Nome sem extensão
            $extension= $request->file('image')->getClientOriginalExtension();  //Extensão
            $imageName = md5($fileName . strtotime("now")) . "." . $extension;  //Montar nome da imagem
            $path = $request->file('image')->storeAs('public/img/events',$imageName);   //Caminho completo com novo nome
            $data['image'] = $imageName;
        }

        $event = Event::findOrFail($request->id)->update($data);
        $eventName = $request->post()['event'];
        return redirect('/dashboard')->with('msg',"Evento '$eventName' atualizado com sucesso ");
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', "Evento excluído");
    }

    public function join($id)
    {
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);
        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento'. $event->title);
    }
    public function leave($id)
    {
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg', 'Você não está mais participando do evento' . $event->title);
    }
}
