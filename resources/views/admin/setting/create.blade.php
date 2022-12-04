@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.error')

<form method="POST" action="{{route('setting.store')}}" enctype="multipart/form-data">
    @csrf
    <div style="font-size: 30px" class="col-3 mb-1"><a href="{{route('setting.index')}}"><i
                class="bi bi-chevron-left"></i></a></div>
    <div class="row my-2">

        <h2 class="col col-6" style="text-transform: capitalize">Setting</h2>
    </div>
    <div class="card border border-1">
        <div class="card-body row">
            <div class="mb-2 px-4">
                <label class="form-label" style="font-size:22px;">Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
            </div>
            <div class="col-md-6">
                <input type="file" name="file" onchange="preview()">
                <img id="frame" src="" style="max-height:300px; max-width: 100%;" />
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">Link</label>
                    <input type="text" class="form-control" name="link" value="{{old('link')}}"
                          >
                </div>
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">Type </label>
                    <select name="type" class="form-control">
                        <option value="navbar-left">navbar-left</option>
                        <option value="navbar-right">navbar-right</option>
                        <option value="footer-left">footer-left</option>
                        <option value="footer-right">footer-right</option>

                    </select>
                </div>
            </div>
        </div>
    </div>
    <div style="display:flex; align-items:center; justify-content:flex-end; margin-top: 4px">
        <button type="submit" class="btn btn-success py-3 px-5">Create</button>
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

