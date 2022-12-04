@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.error')

<form method="POST" action="{{route('setting.update',$setting->id)}}"  enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div style="font-size: 30px" class="col-3 mb-1"><a href="{{route('setting.index')}}"><i
                class="bi bi-chevron-left"></i></a></div>
    <div class="row my-2">

        <h2 class="col col-6" style="text-transform: capitalize">Edit Setting</h2>
    </div>
    <div class="card border border-1">
        <div class="card-body row">
            <div class="mb-2 px-4">
                <label class="form-label" style="font-size:22px;">Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name',$setting->name)}}" required >
            </div>
            <div class="col-md-6">
                <input type="file" name="file" onchange="preview()">
                <img id="frame"
                    src="@if($setting->file){{asset('storage/static'.$setting->file->path.'.'.$setting->file->ext)}}@endif"
                    style="max-height:300px; max-width: 100%;" />
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">link</label>
                    <input type="text" class="form-control" name="link" value="{{old('link',$setting->link)}}">
                </div>
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">Type </label>
                    <select name="type" class="form-control">
                        <option value="navbar-left" @if($setting->type=="navbar-left") selected @endif>navbar-left</option>
                        <option value="navbar-right" @if($setting->type=="navbar-right") selected @endif>navbar-right</option>
                        <option value="footer-left" @if($setting->type=="footer-left") selected @endif>footer-left</option>
                        <option value="footer-right" @if($setting->type=="footer-right") selected @endif>footer-right</option>

                    </select>
                </div>
            </div>


        </div>
    </div>

    <div style="display:flex; align-items:center; justify-content:flex-end;margin-top: 4px ">
        <button type="submit" class="btn btn-success py-3 px-5 ">Update</button>
    </div>
</form>

@endsection
@section('jscontent')
<script>
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

</script>
@endsection
