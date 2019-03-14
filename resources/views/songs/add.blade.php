@extends('layouts.admin_inner')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Song
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> song </a></li>
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
                    <form role="form" method="POST" action="{{ route('store-song') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Category </label>
                                    <select class="form-control select2" name="category_id" id="category_id" onchange="get_subcategories(this.value);" style="width: 100%;">
                                        <option value="" selected="selected">Select Category </option>
                                        @foreach($categories as $option)
                                        @if (old('category_id') == $option['id'])
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
                                    <select class="form-control select2" id="sub_category" name="sub_category_id" style="width: 100%;">
                                        <option value="" selected="selected">Select Sub Category </option>
                                        <div id="suboptions"></div>
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
                                    <label for="name"> Song Name </label>
                                    <input type="text" name="song_name" class="form-control" value="@if(old('song_name'))  {{ old('song_name') }}  @endif" id="name" placeholder="Song Name">
                                    @if ($errors->has('song_name'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('song_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Select File of Folder </label>
                                    <select class="form-control select2" id="upload_type" name="upload_type" onchange="select_file_or_folder(this.value);" style="width: 100%;">
                                        <?php $files = array(array('id' => 1, 'name' => 'folder'),array('id' => 2,'name' => 'file')); ?>
                                        @foreach($files as $val)
                                        @if (old('upload_type') == $val['name'])
                                        <option value="{{ $val['name'] }}" selected>{{ $val['name'] }}</option>
                                        @else
                                        <option value="{{ $val['name'] }}">{{ $val['name'] }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('upload_type'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('upload_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display: none;" id="folder">
                                <div class="form-group">
                                    <label for="categoryInputFile"> upload songs folder </label>
                                    <input type="file" name="song_uplod[]" multiple webkitdirectory="" id="idfolder">

                                    <p class="help-block">Example :- mp3  etc.</p>
                                    @if ($errors->has('song_uplod'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('song_uplod') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display: none;" id="file">
                                <div class="form-group">
                                    <label for="categoryInputFile"> upload song </label>
                                    <input type="file" name="song_uplods" id="myfile">

                                    <p class="help-block">Example :- mp3  etc.</p>
                                    @if ($errors->has('song_uplod'))
                                    <span class="invalid-feedback msg" role="alert">
                                            <strong>{{ $errors->first('song_uplod') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
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

    function select_file_or_folder(selected) {
        if(selected == 'file')
        {
            $('#file').css('display','block');
            $('#folder').css('display','none');
        }else{
            $('#folder').css('display','block');
            $('#file').css('display','none');
        }
    }

    @if (old('upload_type') == 'file')
    $('#file').css('display','block');
    $('#folder').css('display','none');
    @else
    $('#folder').css('display','block');
    $('#file').css('display','none');
    @endif


    function get_subcategories(category_id){
        var saveData = $.ajax({
            type: 'GET',
            url: "{{ url('ajax-subcategory') }}/"+category_id ,
            dataType: "text",
            success: function(resultData) {

                var myObj = JSON.parse(resultData);
                var string = '';
                select = document.getElementById('sub_category');
                for (i = 0; i < myObj.response.length; i++)
                {
                   // string += '<option value="' + myObj.response[i].id + '" selected>' + myObj.response[i].sub_category_name + '</option>';
                    var opt = document.createElement('option');
                    opt.value = myObj.response[i].id;
                    opt.innerHTML = myObj.response[i].sub_category_name;
                    select.appendChild(opt);
                }
                //var x = document.getElementById("sub_category");
                //var option = document.createElement("option");
                //option.text = "Kiwi";
                //x.add(option);
                //$('#suboptions').html(string);
                console.log(myObj.response);
                console.log(string);
            }
        });
        //saveData.error(function() { alert("Something went wrong"); });
    }

</script>

@endsection
