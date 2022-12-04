<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Post;
use App\UseCases\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    private $service;
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {    $type=$request->type;
        $query = QueryBuilder::for(Post::class);
        $query->where('type',$type);
        $query->whereNotNull('parent_id');
        $posts=$query->paginate(30);



        return view('admin.post.index', compact('posts','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {    $type=$request->type;
        $posts=Post::where('type',$request->type)->get();
        return view('admin.post.create',compact('posts','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostCreateRequest $request)
    {

        $post = $this->service->create($request);
        $type=$post->type;
        return redirect(route('post.index',"type=".$type));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }
    public function header(Request $request)
    {
        $post=Post::where('type',$request->type)->where('parent_id',null)->firstOrFail();
        return view('admin.post.header', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Post $post , Request $request)
    {
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(PostEditRequest $request, Post $post)
    {

        $this->service->edit($request, $post);
        if($post->parent_id){
            return redirect(route('post.index',"type=".$post->type));
        }
        else{
            return redirect(route('post.header',"type=".$post->type));

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request ,Post $post)
    {
        $this->service->remove($post);
        return redirect(route('post.index',"type=".$post->type));
    }




}
