@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.error')
<div class="row">
    <div class="offset-md-1 col-md-10">
        <div class="wrap__article-detail">
            <div class="wrap__article-detail-title">
                <div style="font-size: 30px" class="col-3 mb-1"><a href="{{route('post.index')}}?type={{$post->type}}"><i
                            class="bi bi-chevron-left"></i></a></div>
                <h1>
                    {{$post->title}}
                </h1>
                <h3 style="color: gray; font-weight: bold;" >
                    {{$post->subtitle}}
                </h3>
            </div>
            <hr>
            <div class="wrap__article-detail-info"
                style="font-family:Montserrat,sans-serif; text-transform: capitalize; font-weight: 600; font-size: 14px">
                <ul class="list-inline">

                    <li class="list-inline-item">
                        <span class="text-dark text-capitalize ml-1">
                            {{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString()}}
                        </span>
                    </li>

                </ul>
            </div>

            @if($post->file)
            <div class="wrap__article-detail-image my-4">
                <figure>
                    <img style="max-height: 500px; max-width: 800px" src="{{asset('storage/static'.$post->file->path.'.'.$post->file->ext)}}" alt=""
                        class="img-fluid">
                </figure>
            </div>
            @endif
            <div class="wrap__article-detail-content my-4 ">
                <div class="bodyMsg">
                    {!! $post->body !!}
                </div>
            </div>


        </div>
        <!-- end content article detail -->

        <!-- tags -->
        <!-- News Tags -->

    </div>
</div>

@endsection
