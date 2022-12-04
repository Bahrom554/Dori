@extends('admin.layouts.app')
@section('content')
    @include('admin.layouts.error')
   @if($post)
       <div class="card text-center">
           <h1 class="card-header text-capitalize ">
               {{$post->type}}
           </h1>
           <div class="card-body">
               <h3 class="card-title ">{{$post->title}}</h3>
               <p class="card-text">{{$post->subtitle}}</p>
               @if($post->file)
                   <div class="imgcontainer">
                       <img src="{{asset('storage/static'.$post->file->path.'.'.$post->file->ext)}}" alt="Avatar" class="imageee">
                       <div class="overlayee">
                           <a href="#" class="iconee" title="User Profile">
                               <i class="fa fa-user"></i>
                           </a>
                       </div>
                   </div>
               @endif
               <div>
                   link:<a  href="{{$post->link}}">{{$post->link}}</a>

               </div>
               <a href="{{route('post.edit',$post->id)}}"  class="btn btn-primary">Edit</a>
           </div>

       </div>

   @endif
@endsection
