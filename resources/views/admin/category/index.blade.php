@extends('admin.layouts.layout-basic')

@section('styles')
@endsection
@section('scripts')
<script src="{{ asset('/assets/admin/js/jquery.PrintArea.js') }}"></script>
<script src="/assets/admin/js/pages/datatables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs"
    crossorigin="anonymous"></script>
<script>

    $('.edit').click(function () {
        var id = $(this).siblings('.category_id').attr('id');
        $('#form-category').attr('action', '/admin/category/' + id);
        $.get("/admin/category/" + id + "/edit", function (data) {
            $('#inp_name').val(data['category'][0]['name']);
        });
    });
    
    $('.delete').click(function () {
        var id = $(this).siblings('.category_id').attr('id');
        $('#form-d-category').attr('action', '/admin/category/' + id);
    });
    
</script>
@stop
@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Category <small class="text-muted">management</small></h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">Categories</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="caption">
                        <h6>Categories</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.store') }}" class="form-horizontal" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="form-group margin">
                            <label class="col-sm-3 control-label">Category<span class="required">*</span></label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control input-lg" name="category" id="p_category" value=""
                                    required="">
                            </div>
                        </div>
                        <input type="hidden" name="product_id" value="">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button class="btn btn-primary" type="submit" value="Submit"><i class="fa fa-save"></i>
                                    Save Category</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        @if (isset($categories))
                        <tbody>
                            @if(Session::has('success'))
                            <button class="btn btn-success" data-toastr="success" data-message="{{ Session::get('success') }}"
                                data-title="Success!">
                            </button>
                            @endif
                            @if(Session::has('failure'))
                            <button class="btn btn-danger" data-toastr="error" data-message="{{ Session::get('failure') }}"
                                data-title="Error!">
                            </button>
                            @endif
                            @if(Session::has('warning'))
                            <button class="btn btn-warning" data-toastr="warning" data-message="{{ Session::get('warning') }}"
                                data-title="Warning!">
                            </button>
                            @endif
                            @foreach($categories as $index=>$category)
                            <tr role="row" class="odd">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <input type="hidden" class="category_id" id="{{ $category->id }}">
                                        <button type="button" class="btn btn-icon btn-outline-info edit" data-toggle="modal"
                                            data-target="#modal-edit"><i class="icon-fa icon-fa-pencil"></i></button>
                                        <button type="button" class="btn btn-icon btn-outline-danger delete"
                                            data-toggle="modal" data-target="#modal-delete"><i class="icon-fa icon-fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <tbody>
                            <div class="card text-white bg-info text-sm-center">
                                <div class="card-body">
                                    <blockquote class="card-bodyquote">
                                        <p>Hi, you don't have any category yet</p>
                                    </blockquote>
                                </div>
                            </div>
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete" style="display: none;">
    @include('admin.category.delete')
</div>
<div class="modal fade" id="modal-edit" style="display: none;">
    @include('admin.category.edit')
</div>
<!-- /.row (main row) -->
@endsection