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
                    <form role="form" method="POST" action="{{ route('category-update',['id' => $categoryid]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Category Name </label>
                                    <input type="text" name="category_name" class="form-control" value="@if(old('category_name')) {{ old('category_name') }}@else {{ $category->category_name }}  @endif" id="name" placeholder="Category Name">
                                    @if ($errors->has('category_name'))
                                    <span class="invalid-feedback msg" role="alert">
                                                <strong>{{ $errors->first('category_name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display: none;">
                                <div class="form-group">
                                    <label> Has Subcategory ? </label>
                                    <select class="form-control select2" name="is_sub_category" style="width: 100%;">
                                        <option value="" selected="selected">Select Option </option>
                                        @foreach(config('app.yesptions') as $option)
                                        @if (old('is_sub_category') == $option['value'])
                                        <option value="{{ $option['value'] }}" selected>{{ $option['value'] }}</option>
                                        @elseif($category->is_sub_category == $option['value'])
                                        <option value="{{ $option['value'] }}" selected>{{ $option['value'] }}</option>
                                        @else
                                        <option value="{{ $option['value'] }}">{{ $option['value'] }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('is_sub_category'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('is_sub_category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="categoryInputFile"> Category Image </label>
                                    <input type="file" name="category_image" id="categoryInputFile">

                                    <p class="help-block">Example :- jpg , png etc.</p>
                                    @if ($errors->has('category_image'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('category_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box-footer">
                <a href="{{ route('categories') }}"> <button type="button" class="btn btn-primary"> Cancel </button> </a>
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
