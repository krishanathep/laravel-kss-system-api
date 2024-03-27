<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::all();
        return response()->json([
            'status' => 200,
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       try {

        $event = new Events;
        
        $event->title = $request->input('title');
        $event->detail = $request->input('detail');
        $event->user = $request->input('user');
        $event->start = $request->input('start');
        $event->end = $request->input('end');

        $event->save();

        return response()->json([
            'status'=> 200,
            'event'=>$event,
            'message'=>'Event Create is Successfully',
        ]);
        
       } catch(\Exception $e){
            return response()->json([
                'status'=> 400,
                'message'=>$e->getMessage(),
            ]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Events::find($id);

        if($event)
        {
            return response()->json([
                'status'=> 200,
                'event' => $event,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'Event ID Not Found!',
            ]);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $event = Events::find($id);
               
            $event->title = $request->input('title');
            $event->detail = $request->input('detail');
            $event->user = $request->input('user');
            $event->start = $request->input('start');
            $event->end = $request->input('end');

            $event->update();

             return response()->json([
                'status'=> 200,
                'event'=> $event,
                'message'=>'Event Update is Successfully',
            ]);

        } catch(\Exception $e) {
            return response()->json([
                'status'=> 400,
                'message'=> $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Events::find($id);

        if($event)
        {
            $event->delete();
            
            return response()->json([
                "status" => 200,
                'message'=>'Blog Deleted Successfuly'
            ]);
        } else {
            return response()->json([
                "status" => 404,
                'message'=>'Event ID Not Found!'
            ]);
        }
    }
}
