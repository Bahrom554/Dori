<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{


    public function index(Request $request)
    {
        $filters = $request->get('filter');
        $filter = [];
        if (!empty($filters)) {
            foreach ($filters as $k => $item) {
                $filter[] = AllowedFilter::exact($k);
            }
        }
        $query = QueryBuilder::for(Post::class);
        if (!empty($request->get('search'))) {
            $query->where(function ($q) use ($request) {
                $q->orwhere('title', 'LIKE', "%{$request->search}%");
                $q->orwhere('slug', 'LIKE', "%{$request->search}%");
                $q->orwhere('subtitle', 'LIKE', "%{$request->search}%");
            });
        }
        $query->allowedAppends(!empty($request->append) ? explode(',', $request->get('append')) : []);
        $query->allowedIncludes(!empty($request->include) ? explode(',', $request->get('include')) : []);
        $query->allowedFilters($filter);
        $query->allowedSorts($request->sort);
        return $query->paginate($request->per_page);
    }


    public function show(Post $post)
    {

      return $post;

    }

    public function slug(Request $request, $slug)
    {
        return Post::where([
            'slug' => $slug,
        ])->orwhere('id',$slug)->first();
    }




}
