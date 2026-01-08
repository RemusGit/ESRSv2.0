
          <!-- ROW / WEB UPLOADS DETAILS 1-->
          <div class="row mt-2">
          <p class="lead fw-semibold">Website Upload Details</p>
          <hr class="border border-2 border-success">
          

            <div class="col-lg-12">
                <div class="form-outline mb-2 form-floating  w-100">
                    <div class="form-floating mb-4">
                    <textarea class="form-control" placeholder="Web Upload Details" id="updateCatwebUploadDetails" name="webUploadDetails" required
                    style="height: 200px"></textarea>
                    <label for="updateCatwebUploadDetails"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Web Upload Details</label>
                    </div>
                </div>
            </div>  

          </div>
          <!-- EOF ROW / WEB UPLOADS DETAILS 1-->


          
          <!-- ROW / WEB UPLOADS DETAILS 2 -->
          <div class="row mt-2">
          
            <div class="col-lg-12">
                <div class="form-outline mb-2 form-floating  w-100">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="file" id="updateCatwebUploadFile" class="form-control" placeholder="Attachment (max 1mb)" name="webUploadFile" accept="image/*" required />
                            <label class="form-label" for="updateCatwebUploadFile"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Attachment (max 1mb)</label>
                            <p class="text-danger" id="maxFileSizeText" style="display: none;">Maximum File size is 1MB only</p>
                        </div>
                  </div>
                </div>
            </div>  

          </div>
          <!-- EOF ROW / WEB UPLOADS DETAILS 2 -->
     

<script>

  $('#updateCatwebUploadFile').on('change' , function(){

    var files = this.files;

        // Check if a file was selected
        if (files && files.length > 0) {
            // Get the first file object (since a single file input is used)
            var file = files[0];

            // GET FILESIZE IN MB
            var fileSize = (file.size / 1024) / 1000;

            console.log('File size in MB: ' + fileSize);

            if(fileSize > 1){
              $('#maxFileSizeText').show();
              $('#webUploadSubmitBtn').attr('disabled' , 'disabled');
            }else{
              $('#maxFileSizeText').hide();
              $('#webUploadSubmitBtn').removeAttr('disabled');
            }
            
        }
  });

</script>