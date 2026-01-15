<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\POST;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = POST::get();
        return response()->json(['status' => true, 'message' => 'Data Fetched', 'posts' => $posts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['status' => false, 'message' => 'Post Faied', 'errors' => $validator->errors()], 400);
        }

        $image = $request->image;
        $img_ext = $image->getClientOriginalExtension();
        $img_name = time() . '.' . $img_ext;
        $image->move(public_path() . '/uploads', $img_name);

        $post = POST::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $img_name
        ]);
        if($post){
            return response()->json(['status' => true, 'message' => 'Post Created Successfully'], 200);
        }else{
            return response()->json(['status' => false, 'message' => 'Post Can"t Create'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = POST::where('id', $id)->get();
        if($post){
            return response()->json(['status' => true, 'message' => 'Data Fetched', 'posts' => $post], 200);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
