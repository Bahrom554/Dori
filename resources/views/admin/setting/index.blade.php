@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.message')


<div class="row">
    <div class=" col-8 mx-auto d-flex align-items-center justify-content-between px-3">
        <h2 class="mb-2 text-uppercase">Setting</h2>
        <a type="button" href="{{route('setting.create')}}" class="btn btn-primary px-5">Create</a>
    </div>
    <div class="col-8 mx-auto card p-1">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width: 100%; table-layout: fixed;">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>name</th>
                        <th class=" d-none d-md-table-cell">link</th>
                        <th class=" d-none d-lg-table-cell">type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $setting)
                        <tr>
                            <td>{{$setting->id}}</td>
                            <td class="text-truncate">{{$setting->name}}</td>
                            <td class="text-truncate d-none d-md-table-cell"><a href="{{$setting->link}}">Click</a></td>
                            <td class="text-truncate d-none d-lg-table-cell">{{$setting->type}}</td>
                            <td>
                                <div class="  table-actions d-flex align-items-center justify-content-evenly gap-3 fs-4">
                                    <a href="{{route('setting.edit',$setting->id)}}" class="text-warning" title="Edit"><i
                                            class="bi bi-pencil-fill"></i></a>
                                    <form method="POST" action="{{route('setting.destroy',$setting->id)}}">
                                        @method('delete')
                                        @csrf
                                        <input name="url" hidden value="{{$settings->currentPage()}}">
                                        <a href="#" style="color: red;" onclick="event.preventDefault();
                                        this.closest('form').submit();"><i class="bi bi-trash-fill"></i></a>
                                    </form>
                                </div>
                            </td>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>name</th>
                        <th class=" d-none d-md-table-cell">link</th>
                        <th class=" d-none d-lg-table-cell">type</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>

            </div>
            <div class="d-flex align-items-center justify-content-end">
                {{ $settings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('jscontent')
<script>
    $('#example').dataTable({
        "columnDefs": [{
                "width": "5%",
                "targets": 0
            },
            {
                "width": "45%",
                "targets": 1
            },
            {
                "width": "30%",
                "targets": 2
            },
            {
                "width": "10%",
                "targets": 3
            },
            {
                "width": "3%",
                "targets": 4
            },
            {
                "width": "7%",
                "targets": 5
            },
        ],
        "paging": false,
        "order": [0, 'desc'],
    });

</script>
@endsection
