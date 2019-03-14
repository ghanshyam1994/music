<html>
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <body>

      <form id="upload_form" role="form" method="POST" action="uploadfile" aria-label="{{ __('Upload') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row ">
                          <input id="audio" type="text" class="form-control" name="jdjj" value="hfdh" required />
                        <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('File Upload') }}</label>
                        <input id="audio" type="file" class="form-control" name="audio" required />   
                      </div>
                      <button type="" name="upload" class="addbtn" >Upload</button>
                      <?php print_r(phpinfo ()); ?>
        </form>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>
            /*Add new catagory Event*/
 $('form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);
   $.ajax({
         headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:'uploadfile',
  data:formData,
  
  async:false,
  type:'post',
  processData: false,
  contentType: false,
  success:function(response){
    console.log(response);
  },
 });
 });
        </script>
   </body>
</html>