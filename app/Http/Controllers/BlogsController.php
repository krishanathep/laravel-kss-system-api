<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::all();
        return response()->json([
            'status' => 200,
            'blogs' => $blogs,
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
        $request->validate([
            'image' => 'required|image|max:3072',
        ]);

        $fileName = uniqid().uniqid().'.'.$request->file('image')->getClientOriginalExtension();

        $request->file('image')->move(public_path('uploads'), $fileName);

       try {

        $blog = new Blogs;
        
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->author = $request->input('author');
        $blog->image = $fileName;

        $blog->save();

        return response()->json([
            'status'=> 200,
            'blog'=>$blog,
            'message'=>'Blog Create is Successfully',
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
        $blog = Blogs::find($id);

        if($blog)
        {
            return response()->json([
                'status'=> 200,
                'blog' => $blog,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'Blog ID Not Found!',
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

            $blog = Blogs::find($id);
               
            $blog->title = $request->input('title');
            $blog->content = $request->input('content');
            $blog->author = $request->input('author');
            $blog->image = $blog->image;

            if ($request->hasFile('image')) 
                { 
                if ($blog->image) 
                {
                    unlink('uploads/' . $blog->image);   
                }

                $request->validate([
                    'image' => 'image|max:3072',
                ]);

                $fileName = uniqid().uniqid().'.'.$request->file('image')->getClientOriginalExtension();
            
                $request->file('image')->move(public_path('uploads/'), $fileName);

                $blog->image = $fileName;
            }

            $blog->update();

             return response()->json([
                'status'=> 200,
                'message'=>'Discount Update is Successfully',
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
        $blog = Blogs::find($id);

        if($blog -> delete())
        {
            unlink('uploads/' . $blog->image);

            return response()->json([
                "status" => 200,
                'message'=>'Blog Deleted Successfuly'
            ]);
        }
    }
}
