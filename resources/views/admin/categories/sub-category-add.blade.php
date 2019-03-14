@extends('layouts.admin_inner')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Sub Category
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Sub Category </a></li>
            <li class="active"> Add </li>
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
                    <form role="form" method="POST" action="{{ route('store.subcategory') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Category </label>
                                    <select class="form-control select2" name="category_id" id="category_id" onchange="get_category_type();" style="width: 100%;">
                                        <option value="" selected="selected">Select Category </option>
                                        @foreach($categories as $option)
                                        <option value="{{ $option['id'] }}">{{ $option['category_name'] }}</option>
                                        <!--@if (old('category_id') == $option['id'])
                                        <option value="{{ $option['id'] }}" selected>{{ $option['category_name'] }}</option>
                                        @else
                                        <option value="{{ $option['id'] }}">{{ $option['category_name'] }}</option>
                                        @endif-->
                                        @endforeach
                                    </select>
                                    <span id="errortext" style="color: red;"></span>
                                    @if ($errors->has('category_id'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Sub Category Name </label>
                                    <input type="text" id="sub_category" name="sub_category_name" class="form-control" value="@if(old('sub_category_name'))  {{ old('sub_category_name') }}  @endif" id="name" placeholder="Sub Category Name">
                                    @if ($errors->has('sub_category_name'))
                                    <span class="invalid-feedback msg" role="alert">
                                                <strong>{{ $errors->first('sub_category_name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="categoryInputFile"> Sub Category Image </label>
                                    <input type="file" name="sub_category_image" id="categoryInputFile">

                                    <p class="help-block">Example :- jpg , png etc.</p>
                                    @if ($errors->has('sub_category_image'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('sub_category_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box-footer">
                <a href="{{ route('subcategories') }}"> <button type="button" class="btn btn-primary"> Cancel </button> </a>
                <button type="submit" onclick="get_category_type();" class="btn btn-primary">Submit</button>
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

@section('custom_script')

<script>
    function get_category_type() {
        var categroy = $('#category_id').val();
        var url =  "{{ url('get-category-type') }}/" + categroy;
        $.get(url, function (data, status) {
            var parsed_data = JSON.parse(data);
            if(parsed_data.value == 'yes'){
                $('#sub_category').prop('disabled', false);
            }else{
                $('#sub_category').prop('disabled',true);
                $('#errortext').text('you can not add subcategory into this category');
            }
        });
    }

</script>

@endsection
