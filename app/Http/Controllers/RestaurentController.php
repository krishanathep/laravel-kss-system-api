<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        return response()->json([
            'status' => 200,
            'restaurants' => $restaurants,
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
        $restaurant = new Restaurant;
        
        $restaurant->title = $request->input('title');
        $restaurant->description = $request->input('description');
        $restaurant->category = $request->input('category');
        $restaurant->image = $request->input('image');
        $restaurant->latitude = $request->input('latitude');
        $restaurant->longitude = $request->input('longitude');

        $restaurant->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Restaurant Create is Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        if($restaurant)
        {
            return response()->json([
                'status'=> 200,
                'restaurant' => $restaurant,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'Restaurant ID Not Found!',
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
