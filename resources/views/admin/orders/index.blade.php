@extends('layouts.admin_inner')

@section('content')
@include('elements.modal')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Order Summary
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Order </a></li>
            <li class="active"> Order Summary </li>
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
                        <form class="{{ route('manage-orders') }}" action="" method="get">
                            <div class="col-md-3">
                                <div class="form-group" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" name="user_name" value="@if(old('user_name')) {{ old('user_name') }} @endif" placeholder="Order By" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin-bottom: 10px;">
                                    <select class="form-control" name="payment_type">
                                        <option value="">Payment Type</option>
                                        <option value="online">Online</option>
                                        <option value="cash_on_delivery">Case On Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin-bottom: 10px;">
                                    <select class="form-control" name="payment_status">
                                        <option value="">Payment Status</option>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin-bottom: 10px;">
                                    <select class="form-control" name="order_status">
                                        <option value="">Order Status </option>
                                        <option value="new">New</option>
                                        <option value="in_process">In Process</option>
                                        <option value="delivered">Deliverd</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-default">Search</button>
                                <a href="{{ route('manage-orders') }}" class="btn btn-default">Reset Filters</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Order Summary </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th> Ordered By </th>
                                <th> Total price </th>
                                <th>Order Status</th>
                                <th> View Details </th>
                                <th> Created </th>
                            </tr>
                            @if(isset($orders) && count($orders) > 0)
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{  get_user_details($order->user_id,'name') }}</td>
                                <td>{{ $order->price }}</td>
                                <td> <span class="label label-success"> {{ $order->order_status }} </span> </td>
                                <td> <a href="#"> <i class="fa fa-eye"> </i> </a></td>
                                <td>{{ $order->created_at }}</td>
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
                        {{ $orders->links() }}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection
