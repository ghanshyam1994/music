@extends('layouts.admin_inner')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Item
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Item </a></li>
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
                    <form role="form" method="POST" action="{{ route('update-item',['id' => $item->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Category </label>
                                    <select class="form-control select2" name="category_id" id="category_id" onchange="get_category_type();" style="width: 100%;">
                                        <option value="" selected="selected">Select Category </option>
                                        @foreach($categories as $option)
                                        @if (old('category_id') == $option['id'])
                                        <option value="{{ $option['id'] }}" selected>{{ $option['category_name'] }}</option>
                                        @elseif($item->category_id == $option['id'])
                                        <option value="{{ $option['id'] }}" selected>{{ $option['category_name'] }}</option>
                                        @else
                                        <option value="{{ $option['id'] }}">{{ $option['category_name'] }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Sub Category </label>
                                    <select class="form-control select2" name="sub_category_id" id="sub_category" style="width: 100%;">
                                        <option value="" selected="selected">Select Sub Category </option>
                                        @foreach($subcategories as $option)
                                        @if (old('category_id') == $option['id'])
                                        <option value="{{ $option['id'] }}" selected>{{ $option['sub_category_name'] }}</option>
                                        @elseif($item->sub_category_id == $option['id'])
                                        <option value="{{ $option['id'] }}" selected>{{ $option['sub_category_name'] }}</option>
                                        @else
                                        <option value="{{ $option['id'] }}">{{ $option['sub_category_name'] }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('sub_category_id'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('sub_category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Item Name </label>
                                    <input type="text" name="item_name" class="form-control" value="@if(old('item_name')){{ old('item_name') }} @else {{ $item->item_name}}  @endif" id="name" placeholder="Item Name">
                                    @if ($errors->has('item_name'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('item_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Item Description </label>
                                    <textarea type="text" name="item_description" class="form-control" id="name" placeholder="Item Description">@if(old('item_description')){{ old('item_description')}}@else{{ $item->item_description }} @endif</textarea>
                                    @if ($errors->has('item_description'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('item_description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Price </label>
                                    <input type="text" name="price" class="form-control" value="@if(old('price')) {{ old('price') }}@else{{ $item->price }}  @endif" id="name" placeholder="Item Price">
                                    @if ($errors->has('price'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"> Discount in % </label>
                                    <input type="number" name="discount" class="form-control" value="@if(old('discount')){{ old('discount') }}@else{{ $item->discount }}@endif" id="name" placeholder="Discount %">
                                    @if ($errors->has('discount'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('discount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"> Quantity  </label>
                                    <input type="number" name="quantity" class="form-control" value="@if(old('quantity')){{ old('quantity') }}@else{{ $item->quantity }}@endif" id="quantity" placeholder="Quantity">
                                    @if ($errors->has('quantity'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Item Unit </label>
                                    <select class="form-control select2" name="item_unit" style="width: 100%;">
                                        <option value="" selected="selected">Select Unit </option>
                                        @foreach(config('app.item_unit') as $option)
                                        @if (old('item_unit') == $option['value'])
                                        <option value="{{ $option['value'] }}" selected>{{ $option['value'] }}</option>
                                        @elseif($item->item_unit == $option['value'])
                                        <option value="{{ $option['value'] }}" selected>{{ $option['value'] }}</option>
                                        @else
                                        <option value="{{ $option['value'] }}">{{ $option['value'] }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('item_unit'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('item_unit') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="categoryInputFile"> Item Image </label>
                                    <input type="file" name="item_image" id="categoryInputFile">

                                    <p class="help-block">Example :- jpg , png etc.</p>
                                    @if ($errors->has('item_image'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('item_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if($item->stock == 1)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="stock" value="1" class="minimal" checked>
                                        Stock
                                    </label>
                                </div>
                                @if ($errors->has('stock'))
                                <span class="invalid-feedback msg" role="alert">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @else
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="stock" value="1" class="minimal">
                                        Stock
                                    </label>
                                </div>
                                @if ($errors->has('stock'))
                                <span class="invalid-feedback msg" role="alert">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @endif
                        </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box-footer">
                <a href="{{ route('manage-items') }}"> <button type="button" class="btn btn-primary"> Cancel </button> </a>
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
            }
        });
    }

</script>

@endsection
