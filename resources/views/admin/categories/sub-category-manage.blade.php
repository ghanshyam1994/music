@extends('layouts.admin_inner')

@section('content')
@include('elements.modal')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sub Category Summary
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Sub Category </a></li>
            <li class="active"> Sub Category Summary </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @if (session('message'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
        </div>
        @endif
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form class="{{ route('subcategories') }}" action="" method="get">
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" name="category_name" value="@if(old('category_name')) {{ old('category_name') }} @endif" placeholder="Category Name" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" name="sub_category_name" value="@if(old('sub_category_name')) {{ old('sub_category_name') }} @endif" placeholder="Sub Category Name" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-default">Search</button>
                                <a href="{{ route('subcategories') }}" class="btn btn-default">Reset Filters</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
<!--                    <div class="box-header">-->
<!--                        <h3 class="box-title"> Sub Category Summary </h3>-->
<!--                    </div>-->
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th> Sub Category Image </th>
                                <th> Category Name </th>
                                <th> Sub Category Name </th>
                                <th> Created </th>
                                <th>Action</th>
                            </tr>
                            @if(isset($subcategories) && count($subcategories) > 0)
                                @foreach($subcategories as $category)
                                @if($category->sub_category_image != '')
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td> <img src="{{ asset('uploads/subcategory/'.$category->sub_category_image) }}" alt="{{ $category->sub_category_image }}" width="50"> </td>
                                        <td>{{ get_category_name($category->category_id) }}</td>
                                        <td>{{ $category->sub_category_name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            <a href="{{ route('subcategory-edit',['id' => $category->id]) }}"> <i class="fa fa-edit"></i> </a>
                                                <i class="fa fa-trash-o icon-delete" onclick="confirmBefordelete('<?php echo route('delete.subcategory',['id'=>$category->id]); ?>')" style="cursor: pointer"></i>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td> - </td>
                                        <td>{{ get_category_name($category->category_id) }}</td>
                                        <td>{{ $category->sub_category_name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            <a href="{{ route('subcategory-edit',['id' => $category->id]) }}"> <i class="fa fa-edit"></i> </a>
                                            <i class="fa fa-trash-o icon-delete" onclick="confirmBefordelete('<?php echo route('delete.subcategory',['id'=>$category->id]); ?>')" style="cursor: pointer"></i>
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <h4> No Record Found </h4>
                                    </td>
                                </tr>
                            @endif
                        </table>
                        {{ $subcategories->links() }}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
    function confirmBefordelete(url) {
        $('#modal_default').modal();
        $('#modal-title').html('Record Delete Confirmation');
        $('#modal-body').html('Once you Delete it you cannot undo it');

        var footer = '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';

        footer += '<a href="'+ url +'"> <button type="button" class="btn btn-primary"> Delete </button> </a>';

        $('#modal-footer').html(footer);
    }
</script>

@endsection
