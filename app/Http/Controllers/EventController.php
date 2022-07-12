<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('welcome',['events'=>$events]);
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
        $new_event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('events.show',['event' => $event]);
    }
}
