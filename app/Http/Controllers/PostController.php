<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Transformers\PostTransformer;
use Symfony\Component\HttpFoundation\Response as HttpResponse;


class PostController extends Controller
{
    private $postTransformer;

    public function __construct(PostTransformer $postTransformer){
        $this->postTransformer = $postTransformer;
    }

    /**
     * @method_name :- index
     * -------------------------------------------------------- 
     * @param  :-  {}
     * ?return :-  {}
     * author :-  API
     * created_by:- Abul Kalam Azad
     * created_at:- 17/05/2023 10:31:39
     * description :- A method is simply a “chunk” of code.
     */

    public function index(){
        $post = Post::all();
        
        return $this->respondWithCollection($post, $this->postTransformer, true, HttpResponse::HTTP_OK, 'Post List');
        //return response()->json($posts, 200);
    }


    public function store(Request $request){
        $rules =[
            'title' => 'required|min:3|max:255',
            'description' => 'required'
        ];

        $validatorResponse = $this->validateRequest($request, $rules);

        if($validatorResponse !== true){
            return $this->responseJson(false, HttpResponse::HTTP_BAD_REQUEST, 'Error', $validatorResponse);
        }
        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if($post->save()){
            return $this->respondWithItem($post, $this->postTransformer, true, HttpResponse::HTTP_CREATED, 'Post Created');
        }

        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Sava Post');
    }
    
    public function edit($id){


        $post = Post::find($id);

        if(empty($post->id)){
            return response()->json(['message' => 'Do Not Match this ID'],  404);
        }

        return $this->respondWithItem($post, $this->postTransformer, true, HttpResponse::HTTP_OK, 'Post List');

    }

    public function update(Request $request, $id){
        $rules =[
            'title' => 'required|min:3|max:255',
            'description' => 'required'
        ];

        $validatorResponse = $this->validateRequest($request, $rules);

        if($validatorResponse !== true){
            return $this->responseJson(false, HttpResponse::HTTP_BAD_REQUEST, 'Error', $validatorResponse);
        }

        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        if($post->save()){
            return $this->respondWithItem($post, $this->postTransformer, true, HttpResponse::HTTP_OK, 'Post Updated');
        }

        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Update Post');

    }

    public function destroy($id){
        $isPostDelete = Post::findOrFail($id)->delete();

        if($isPostDelete){
            return $this->responseJson(true, HttpResponse::HTTP_OK, 'Post Deleted');
        }

        return $this->responseJson(false, HttpResponse::HTTP_BAD_GATEWAY, 'Error. Could Not Delete Post');
    }

}
