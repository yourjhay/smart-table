<?php
namespace App\Controllers;
    
Use Simple\Request;
Use App\Models\Events;

class MyschedulesController extends Controller 
{
    
    public function index() 
    {
        return view('myschedules');
    }

    public function events() 
    {
        $events = Events::all();
       
        foreach($events as $row)
        {
        $data[] = array(
        'id'   => $row["id"],
        'title'   => $row["title"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"]
        );
        }
        if (empty($events)){
            $data=[];
        }
        return json_encode($data);
    }
    
    public function update(Request $request)
    {
        dd($request->post());
    }

    public function insert(Request $request)
    {
        $event = new Events;
        $event->title = $request->title;
        $event->start_event = $request->start;
        $event->end_event = $request->end;
        $event->save();

    }
    
}