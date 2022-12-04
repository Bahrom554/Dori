<?php

namespace App\UseCases;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Files;
use App\Models\Post;

class PostService
{
    private $service;
    public function __construct(FileService $service)
    {
        $this->service = $service;
    }

    public function create(PostCreateRequest $request)
    {
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:JPG,jpeg, jpg, svg, png|required|max:10000'
            ]);
            $file = $this->service->uploads($request);
            $request['file_id'] = $file->id;
        }
        $post = Post::make($request->only('title', 'subtitle', 'slug', 'file_id', 'status', 'type', 'body','link'));
        $parent=Post::where('type',$request->type)->where('parent_id',null)->first();
        if($parent){
            $post->parent_id=$parent->id;
        }
        $post->save();
        return $post;
    }
    public function edit(PostEditRequest $request, Post $post)
    {
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:JPG,jpeg, jpg, svg, png|required|max:10000'
            ]);
            $this->service->delete($post->file_id);
            $file = $this->service->uploads($request);
            $request['file_id'] = $file->id;
            $messages = [
                'required'  => 'File is not uploaded successfully',
            ];
            $request->validate([
                'file_id' => 'required', $messages
            ]);
        }
        $post->update($request->only('title', 'subtitle', 'slug', 'file_id',  'status','body','link'));
        return $post;
    }
        public function remove(Post $post)
       {
           if($post->parent_id){
               if($post->file_id){
                   $this->service->delete($post->file_id);
               }
               $post->delete();
           }

      }
}
