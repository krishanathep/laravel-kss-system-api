<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ksssystem;

class KssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ksssystems = Ksssystem::all();
        return response()->json([
            'status' => 200,
            'ksssystems' => $ksssystems,
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

            $ksssystem = new Ksssystem;
            
            $ksssystem->title = $request->input('title');
            $ksssystem->objective = $request->input('objective');
            $ksssystem->suggest = $request->input('suggest');
            $ksssystem->suggest_type = $request->input('suggest_type');
            $ksssystem->current = $request->input('current');
            $ksssystem->improve = $request->input('improve');
            $ksssystem->results = $request->input('results');
            $ksssystem->cost = $request->input('cost');
            $ksssystem->date = $request->input('date');
            $ksssystem->discuss_res = $request->input('discuss_res');
            $ksssystem->past_res = $request->input('past_res');
            $ksssystem->unit_res = $request->input('unit_res');
            $ksssystem->board_res = $request->input('board_res');
            $ksssystem->expansion = $request->input('expansion');
    
            $ksssystem->save();
    
            return response()->json([
                'status'=> 200,
                'ksssystem'=>$ksssystem,
                'message'=>'KSS System Create is Successfully',
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
        $ksssystem = Ksssystem::find($id);

        if($ksssystem)
        {
            return response()->json([
                'status'=> 200,
                'ksssystem' => $ksssystem,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'KSS System ID Not Found!',
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

            $ksssystem = Ksssystem::find($id);
               
            $ksssystem->title = $request->input('title');
            $ksssystem->objective = $request->input('objective');
            $ksssystem->suggest = $request->input('suggest');
            $ksssystem->suggest_type = $request->input('suggest_type');
            $ksssystem->current = $request->input('current');
            $ksssystem->improve = $request->input('improve');
            $ksssystem->results = $request->input('results');
            $ksssystem->cost = $request->input('cost');
            $ksssystem->date = $request->input('date');
            $ksssystem->discuss_res = $request->input('discuss_res');
            $ksssystem->past_res = $request->input('past_res');
            $ksssystem->unit_res = $request->input('unit_res');
            $ksssystem->board_res = $request->input('board_res');
            $ksssystem->expansion = $request->input('expansion');

            $ksssystem->update();

             return response()->json([
                'status'=> 200,
                'ksssystem'=> $ksssystem,
                'message'=>'KSS System Update is Successfully',
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
        $ksssystem = Ksssystem::find($id);

        if($ksssystem)
        {
            $ksssystem->delete();
            
            return response()->json([
                "status" => 200,
                'message'=>'KSS System Deleted Successfuly!'
            ]);
        } else {
            return response()->json([
                "status" => 404,
                'message'=>'KSS System ID Not Found!'
            ]);
        }
    }
}
