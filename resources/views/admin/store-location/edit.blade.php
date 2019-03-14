@extends('layouts.admin_inner')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Category
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Category </a></li>
            <li class="active"> Edit </li>
        </ol>
    </section>
    <style>
        .msg{
            color: red;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form role="form" method="POST" action="{{ route('update-store-location',['id' => $storelocation->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Store Location </label>
                                    <input type="text" name="store_location" class="form-control" value="@if(old('store_location')) {{ old('store_location') }}@else{{ $storelocation->store_location }}  @endif" id="name" placeholder="Store Location">
                                    @if ($errors->has('store_location'))
                                    <span class="invalid-feedback msg" role="alert">
                                                <strong>{{ $errors->first('store_location') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box-footer">
                <a href="{{ route('manage-store-location') }}"> <button type="button" class="btn btn-primary"> Cancel </button> </a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        <!-- /.row -->
</div>
<!-- /.box-body -->
@if(config('app.show_form_footer') == 1)
<div class="box-footer">
    Visit <a href="{{config('app.form_footer_link')}}"> {{config('app.form_footer_link_text')}} </a>
</div>
@endif
</div>

</section>
<!-- /.content -->
</div>
@endsection
