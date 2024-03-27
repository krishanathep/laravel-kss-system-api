<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documents;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Documents::all();
        return response()->json([
            'status' => 200,
            'documents' => $documents,
        ]);
    }

    //filter document by document title
    public function title_filter(Request $request)
    {
        $data = $request->get('data'); 
       
        $document = Documents::where('title', 'like', '%' . $data . '%') ->get();

        return response()->json([
            'status'=> 200,
            'document'=> $document,
        ]);
    }

    //filter document by document content
    public function content_filter(Request $request)
    {
        $data = $request->get('data'); 
       
        $document = Documents::where('content', 'like', '%' . $data . '%') ->get();

        return response()->json([
            'status'=> 200,
            'document'=> $document,
        ]);
    }

    //filter document by document category
    public function category_filter(Request $request)
    {
        $data = $request->get('data'); 
       
        $document = Documents::where('category', 'like', '%' . $data . '%') ->get();

        return response()->json([
            'status'=> 200,
            'document'=> $document,
        ]);
    }

     //filter document by document category
     public function department_filter(Request $request)
     {
         $data = $request->get('data'); 
        
         $document = Documents::where('department', 'like', '%' . $data . '%') ->get();
 
         return response()->json([
             'status'=> 200,
             'document'=> $document,
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
            'path' => 'required|file|max:5000',
        ]);

        $fileName = uniqid().uniqid().'.'.$request->file('path')->getClientOriginalExtension();

        $request->file('path')->move(public_path('uploads/documents/'), $fileName);

       try {

        $documents = new Documents;
        
        $documents->title = $request->input('title');
        $documents->content = $request->input('content');
        $documents->category = $request->input('category');
        $documents->department = $request->input('department');
        $documents->author = $request->input('author');
        $documents->path = $fileName;

        $documents->save();

        return response()->json([
            'status'=> 200,
            'documents'=>$documents,
            'message'=>'Documents Create is Successfully',
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
        $documents = Documents::find($id);

        if($documents)
        {
            return response()->json([
                'status'=> 200,
                'documents' => $documents,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'Documents ID Not Found!',
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

            $documents = Documents::find($id);
               
            $documents->title = $request->input('title');
            $documents->content = $request->input('content');
            $documents->category = $request->input('category');
            $documents->department = $request->input('department');
            $documents->author = $request->input('author');
            $documents->path = $documents->path;

            if ($request->hasFile('path')) 
                { 
                if ($documents->path) 
                {
                    unlink('uploads/documents/' . $documents->path);   
                }

                $request->validate([
                    'path' => 'required|file|max:5000',
                ]);

                $fileName = uniqid().uniqid().'.'.$request->file('path')->getClientOriginalExtension();
            
                $request->file('path')->move(public_path('uploads/documents/'), $fileName);

                $documents->path = $fileName;
            }

            $documents->update();

             return response()->json([
                'status'=> 200,
                'message'=>'Docurments Update is Successfully',
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
        $documents = Documents::find($id);

        if($documents)
        {
            $documents -> delete();

            unlink('uploads/documents/' . $documents->path);

            return response()->json([
                "status" => 200,
                'message'=>'Documents Deleted Successfuly'
            ]);
        } else {
            return response()->json([
                "status" => 404,
                'message'=>'Documents ID Not Found!'
            ]);
        }
    }
}
