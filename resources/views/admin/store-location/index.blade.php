@extends('layouts.admin_inner')

@section('content')
@include('elements.modal')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Store Locations
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Store </a></li>
            <li class="active"> Store Location </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @if (session('success'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('success') }}
        </div>
        @endif
        @if (session('message'))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
        </div>
        @endif
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form class="{{ route('manage-store-location') }}" action="" method="get">
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" name="store_location" value="@if(old('store_location')) {{ old('store_location') }} @endif" placeholder="Store location" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-default">Search</button>
                                <a href="{{ route('manage-store-location') }}" class="btn btn-default">Reset Filters</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th> Store Location </th>
                                <th> Created </th>
                                <th> Action </th>
                            </tr>
                            @if(isset($storelocations) && count($storelocations) > 0)
                                @foreach($storelocations as $storelocation)
                                <tr>
                                    <td>{{ $storelocation->id }}</td>
                                    <td> {{ $storelocation->store_location }} </td>
                                    <td>{{ $storelocation->created_at }}</td>
                                    <td>
                                        <a href="{{ route('edit-store-location',['id' => $storelocation->id]) }}"> <i class="fa fa-edit"></i> </a>
                                        <i class="fa fa-trash-o icon-delete" onclick="confirmBefordelete('<?php echo route('delete-store-location',['id'=>$storelocation->id]);  ?>')" style="cursor: pointer;"></i>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <h4> No Record Found </h4>
                                    </td>
                                </tr>
                            @endif
                        </table>
                        {{ $storelocations->links() }}
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
