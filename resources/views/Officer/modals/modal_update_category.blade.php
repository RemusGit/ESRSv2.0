<!-- Modal SEE MORE -->
<div class="modal fade" id="modalUpdateCategory" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6">Update Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">

            <form action="/officer_update_category" method="POST" id="updateCategoryForm" enctype="multipart/form-data">
            @csrf


            <!------------------------------------TRAVEL CONDUCTION----------------------------------------->
            <div id="showTCDetails" class="mb-4" style="display: none;">
                @include('client.modals.travel_conduction_details')
            </div>

            <!------------------------------------Biometrics Enrollment----------------------------------------->
            <div id="showBioDetails" class="mb-4" style="display: none;">
                @include('client.modals.bio_details')
            </div>
           


            <!------------------------------------HOMIS Encoding Error----------------------------------------->
            <div id="showHomisDetails" class="mb-4" style="display: none;">
                @include('client.modals.homis_details')
            </div>
            


            <!------------------------------------Network Installation / Internet Connection----------------------------------------->
            <div id="showNetworkInstallDetails" class="mb-4" style="display: none;">
                    @include('client.modals.network_install_details')
            </div>

            <!------------------------------------System Enhancement / Modification----------------------------------------->
            <div id="showNSystemEnhanceDetails" class="mb-4" style="display: none;">
                @include('client.modals.system_enhance_details')
            </div>

            <!------------------------------------VMC ID Card Preparation----------------------------------------->
            <div id="showVmcIdCardDetails" class="mb-4" style="display: none;">
                @include('client.modals.vmc_id_details')
            </div>
  
            <!------------------------------------Website Uploads----------------------------------------->
            <div id="showWebUploadsDetails" class="mb-4" style="display: none;">
                @include('client.modals.web_uploads_details')
            </div>

            <!------------------------------------Zoom Link----------------------------------------->
            <div id="showZoomLinkDetails" class="mb-4" style="display: none;">
                @include('client.modals.zoom_link_details')
            </div>

            <p class="text-danger mt-2 text-center" style="font-size: 11px; display: none;" id="showWarningRequiredAll">*PLEASE FILL ALL THE REQUIRED INFORMATION.</p>
            <hr class="text-success" style="display: none;" id="hrId">

            <div class="row">
                <div class="col-lg-3">
                    <p>Current Category: </p>
                </div>
                <div class="col-lg-9">
                    <p class="text-start text-success fw-bold" id="modalUpdateCategoryCurrentReq"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <p>Description: </p>
                </div>
                <div class="col-lg-9">
                    <p class="text-start" id="modalUpdateCategoryCurrentDesc" style="font-size: 12px;"></p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-3">
                    <p>New Category: </p>
                </div>
                <div class="col-lg-9">
                    <input type="hidden" name="formCurrentCategoryID" id="formCurrentCategoryID">
                    <div class="form-floating pb-2">
                    <select class="form-select select2" id="updateCategoryNewCategoryID"
                    aria-label="Floating label select example"  style="width: 100%;" name="updateCategoryNewCategory" required>
                    </select>
                    <label><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Select Category</label>
                    </div>
                    <p class="text-danger" style="font-size: 11px; display: none;" id="showWarning">*Please select category</p>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-lg-3 ms-auto">
                    <input type="hidden" id="getRequestDate" name="getRequestDate">
                    <input type="hidden" id="currentCategoryVal" name="currentCategoryVal">
                    <input type="hidden" id="newCategoryValId" name="newCategoryValId">
                    <input type="hidden" id="newCategoryValText" name="newCategoryValText">
                    <input type="hidden" id="categoryGetRefID" name="getRefID">
                    <button type="submit" class="btn btn-success btn-sm  w-100" id="updateCategoryFormSubmit">Update Category</button>
                </div>
                </form>
            </div>

        </div>

        <div class="modal-footer">
                <p class="lead text-success fw-bold" style="font-size: 14px;">Reference No. <span id="modalUpdateCategoryRefID"></span></p>
        </div>
        
      </div>
    </div>
  </div>
</div>

<script>

    $(document).ready(function(){

        ///////////////////////////////////////////////////////////// GET CATEGORY ID ON CHANGE CATEGORY SELECT TAG
        $('#updateCategoryNewCategoryID').change(function(){

            let categoryID = $(this).val();
            let categoryVal = $('#updateCategoryNewCategoryID option:selected').text();

            $('#showWarningRequiredAll').hide();
            $('#showBioDetails').slideUp();
            $('#showHomisDetails').slideUp();
            $('#showNSystemEnhanceDetails').slideUp();
            $('#showVmcIdCardDetails').slideUp();
            $('#showWebUploadsDetails').slideUp();
            $('#showZoomLinkDetails').slideUp();
            $('#showNetworkInstallDetails').slideUp();
            $('#showTCDetails').slideUp();
            $('#hrId').slideUp();
            
            //console.log(categoryVal);

            //////////////////////////////////////////////////////////////////////////////////// TRAVEL CONDUCTION
            if(categoryVal == 'Travel Conduction'){

                $('#showTCDetails').slideDown();
                $('#hrId').slideDown();
            }

            //////////////////////////////////////////////////////////////////////////////////// BIOMETRICS ENROLLMENT
            if(categoryVal == 'Biometrics Enrollment'){
                
                let getEmploymentStatusItems = $('#bioEmpStatusSelect option').length;
                //console.log(getSectionItems);
                if(getEmploymentStatusItems == 1){

                    // LOAD ALL EMPLOYMENT STATUS FROM employstatus
                     $.ajax({
                        url: "{{ route('loadEmpStatus') }}", 
                          type: 'GET', 
                          success: function(res) {
                            //console.log(res);
                              $.each(JSON.parse(res) , function(i , val){
                                $('#bioEmpStatusSelect').append('<option value='+val.employstatus_id+'>'+val.employstatus_val+'</option>');
                              });
                          },
                          error: function(error) {
                              console.error(error);
                          }
                        });//EOF AJAX
                }// EOF IF EMPLOYMENT STATUS IS EMPTY

                let getSectionItems = $('#bioSectionSelect option').length;
                if(getSectionItems == 1){
                    // LOAD ALL SECTION FROM section_tab
                     $.ajax({
                        url: "{{ route('loadSection') }}", 
                          type: 'GET', 
                          success: function(res) {
                            //console.log(res);
                            
                              $.each(JSON.parse(res) , function(i , val){
                                $('#bioSectionSelect').append('<option value='+val.section_id+'>'+val.section_name+'</option>');
                              });
                          },
                          error: function(error) {
                              console.error(error);
                          }
                        });//EOF AJAX
                }// EOF IF SECTION ITEMS IS EMPTY

                let getDesignationItems = $('#bioDesignationSelect option').length;
                if(getDesignationItems == 1){
                    // LOAD ALL DESIGNATION FROM position_tab
                     $.ajax({
                        url: "{{ route('loadDesignation') }}", 
                          type: 'GET', 
                          success: function(res) {
                            //console.log(res);
                            
                              $.each(JSON.parse(res) , function(i , val){
                                $('#bioDesignationSelect').append('<option value='+val.position_id+'>'+val.position_name+'</option>');
                              });
                          },
                          error: function(error) {
                              console.error(error);
                          }
                        });//EOF AJAX
                }// EOF IF DESIGNATION IS EMPTY

                $('#showBioDetails').slideDown();
                $('#hrId').slideDown();
            }
            //////////////////////////////////////////////////////////////////////////////////// HOMIS ENCODING ERROR
            if(categoryVal == 'HOMIS Encoding Error'){
                $('#showHomisDetails').slideDown();
                $('#hrId').slideDown();
            }
            //////////////////////////////////////////////////////////////////////////////////// SYSTEM ENHANCEMENT / MODIFICATION
            if(categoryVal == 'System Enhancement / Modification / Homis / Other Installation'){

                if($('#systemEnhanceSelectSystemID option').length == 1){

                    // LOAD ALL CONNECTION FROM connectiontype_tab
                    $.ajax({
                    url: "{{ route('loadVmcSystem') }}", 
                    type: 'GET', 
                    success: function(res) {
                        console.log(res);
                        
                        $.each(JSON.parse(res) , function(i , val){

                            $('#systemEnhanceSelectSystemID').append('<option value='+val.vmcsystem_id +'>'+val.vmcsystem_value+'</option>');
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                    });//EOF AJAX
                    
                }//EOF SYSTEM ENHANCE LENGTH

                $('#showNSystemEnhanceDetails').slideDown();
                $('#hrId').slideDown();
            }
            //////////////////////////////////////////////////////////////////////////////////// VMC ID CARD PREPARATION
            if(categoryVal == 'VMC ID Card Preparation'){

                let getEmploymentStatusItems = $('#vmcIdCardEmpStatus option').length;
                if(getEmploymentStatusItems == 1){
                    // LOAD ALL EMPLOYMENT STATUS FROM employstatus
                     $.ajax({
                        url: "{{ route('loadEmpStatus') }}", 
                          type: 'GET', 
                          success: function(res) {
                            //console.log(res);
                              $.each(JSON.parse(res) , function(i , val){
                                $('#vmcIdCardEmpStatus').append('<option value='+val.employstatus_id+'>'+val.employstatus_val+'</option>');
                              });
                          },
                          error: function(error) {
                              console.error(error);
                          }
                        });//EOF AJAX
                }// EOF IF EMPLOYMENT STATUS IS EMPTY


                let getDesignationItems = $('#vmcIdCardPosition option').length;
                if(getDesignationItems == 1){

                    // LOAD ALL DESIGNATION FROM position_tab
                     $.ajax({
                        url: "{{ route('loadDesignation') }}", 
                          type: 'GET', 
                          success: function(res) {
                            //console.log(res);
                              $.each(JSON.parse(res) , function(i , val){
                                $('#vmcIdCardPosition').append('<option value='+val.position_id+'>'+val.position_name+'</option>');
                              });
                          },
                          error: function(error) {
                              console.error(error);
                          }
                        });//EOF AJAX
                    }// EOF IF DESIGNATION IS EMPTY


                let getCityItems = $('#vmcIdCardCity option').length;
                if(getEmploymentStatusItems == 1){
                    // LOAD ALL EMPLOYMENT STATUS FROM employstatus
                     $.ajax({
                        url: "{{ route('loadCity') }}", 
                          type: 'GET', 
                          success: function(res) {
                            //console.log(res);
                              $.each(JSON.parse(res) , function(i , val){
                                $('#vmcIdCardCity').append('<option></option>');
                                $('#vmcIdCardCity').append('<option value='+val.cityCode+'>'+val.cityName+' ('+val.provinceName+')</option>');

                                $('#vmcIdCardCityEmergency').append('<option></option>');
                                $('#vmcIdCardCityEmergency').append('<option value='+val.cityCode+'>'+val.cityName+' ('+val.provinceName+')</option>');
                              });
                          },
                          error: function(error) {
                              console.error(error);
                          }
                        });//EOF AJAX
                }// EOF IF CITY IS EMPTY


                $('#vmcIdCardCity , #vmcIdCardCityEmergency').change(function(){

                        let toUpdate = 0;
                        if(this.id == 'vmcIdCardCity'){
                            $('#vmcIdCardBarangay').empty();
                            $('#vmcIdCardBarangay').append('<option></option>');
                            toUpdate = 1;
                        }

                        if(this.id == 'vmcIdCardCityEmergency'){
                            $('#vmcIdCardBarangayEmergency').empty();
                            $('#vmcIdCardBarangayEmergency').append('<option></option>');
                            toUpdate = 2;
                        }

                        //console.log(toUpdate);
                        let getCityCode = $(this).val();
                        $.ajax({
                        url: "load_barangay/"+getCityCode, 
                          type: 'GET', 
                          success: function(res) {
                            //console.log(res);
                              $.each(JSON.parse(res) , function(i , val){
                                if(toUpdate == 1){
                                    $('#vmcIdCardBarangay').append('<option value='+val.barangayCode+'>'+val.barangayName+'</option>');
                                }
                                if(toUpdate == 2){
                                    $('#vmcIdCardBarangayEmergency').append('<option value='+val.barangayCode+'>'+val.barangayName+'</option>');
                                }

                              });
                          },
                          error: function(error) {
                              console.error(error);
                          }
                        });//EOF AJAX
                });// EOF CITY ON CHANGE

                $('#showVmcIdCardDetails').slideDown();
                $('#hrId').slideDown();
            }
            //////////////////////////////////////////////////////////////////////////////////// WEB UPLOADS
            if(categoryVal == 'Website Uploads'){
                $('#showWebUploadsDetails').slideDown();
                $('#hrId').slideDown();
            }
            //////////////////////////////////////////////////////////////////////////////////// ZOOM LINK
            if(categoryVal == 'Zoom Link'){
                $('#showZoomLinkDetails').slideDown();
                $('#hrId').slideDown();
            }
            //////////////////////////////////////////////////////////////////////////////////// NETWORK INSTALLATION
            if(categoryVal == 'Network Installation / Internet Connection / Cable Transfer'){

                //console.log($('#networkInstallConnectionId option').length);
                if($('#networkInstallConnectionId option').length == 0){

                    $('#networkInstallConnectionId').empty();
                    $('#networkInstallConnectionId').append('<option></option>');
                    
                    // LOAD ALL CONNECTION FROM connectiontype_tab
                    $.ajax({
                    url: "{{ route('loadConnection') }}", 
                    type: 'GET', 
                    success: function(res) {
                        //console.log(res);
                        
                        $.each(JSON.parse(res) , function(i , val){
                            $('#networkInstallConnectionId').append('<option value='+val.connectiontype_id +'>'+val.connectiontype_value+'</option>');
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                    });//EOF AJAX

                }// EOF COUNT OPTION LENGTH

                $('#showNetworkInstallDetails').slideDown();
                $('#hrId').slideDown();
            }

            $('#newCategoryValId').val(categoryID);
            $('#newCategoryValText').val(categoryVal);
        });

        ///////////////////////////////////////// GET ALL INFO AFTER CLICKING UPDATE CATEGORY BUTTON ON IN-PROGRESS TABLE
        $('.updateCategoryClassBtn').click(function(){

            let array = this.id.split(",,");
            let refID = array[0];
            let categoryVal = array[1];
            let desc = array[2];
            let currentCategoryID = array[3];
            let requestDate = array[4];

            $('#getRequestDate').val(requestDate);
            $('#currentCategoryVal').val(categoryVal);
            $('#categoryGetRefID').val(refID);
            $('#modalUpdateCategoryRefID').html(refID);
            $('#modalUpdateCategoryCurrentReq').html(categoryVal);
            $('#modalUpdateCategoryCurrentDesc').html(desc);
            $('#formCurrentCategoryID').val(currentCategoryID);
            
        });//EOF ON CLICK

        ///////////////////////////////////////////////////////////// ON MODAL SHOW - VIEW ALL CATEOGRY UNDER AGENT ID
        $('#modalUpdateCategory').on('show.bs.modal' , function(){

                $('#showBioDetails').hide();
                $('#showHomisDetails').hide();
                $('#showSystemEnhanceDetails').hide();
                $('#showVmcIdCardDetails').hide();
                $('#showWebUploadsDetails').hide();
                $('#showZoomLinkDetails').hide();
                $('#showNetworkInstallDetails').hide();
                $('#showWarningRequiredAll').hide();
                $('#showNSystemEnhanceDetails').hide();

                $('#showWarning').hide();
                $('#updateCategoryNewCategoryID').empty();
                $('#updateCategoryNewCategoryID').append('<option></option>');

                // LOAD ALL CATEGORY BASED ON USER AGENT ID
                $.ajax({
                url: "/load_all_category", 
                type: 'GET', 
                success: function(res) {
                    $.each(JSON.parse(res) , function(i , val){

                        if(val.main_category != ''){
                            $('#updateCategoryNewCategoryID').append('<option value='+val.category_id+'>('+val.main_category+') '+val.category_value+'</option>');
                        }
                        else{
                            $('#updateCategoryNewCategoryID').append('<option value='+val.category_id+'>'+val.category_value+'</option>');
                        }
                        
                    });
                },
                error: function(error) {
                    console.error(error);
                }
                });//EOF AJAX
        });// EOF ON MODAL SHOW


        //////////////////////////////////////////////////////////////////////////////////////// FORM SUBMISSION - UPDATE CATEGORY
        $('#updateCategoryFormSubmit').click(function(e){

            e.preventDefault();

            /////////////////////////////////////////////////////////////// CHECK IF CATEGORY IS NULL
            let getCategoryVal = $('#updateCategoryNewCategoryID').val();
            let getCurrentCategory = $('#modalUpdateCategoryCurrentReq').html();
            if(getCategoryVal == ''){
                $('#showWarning').html("*Please select category");
                $('#showWarning').show();
                
                return;
            }else{
                $('#showWarning').hide();
                getCategoryVal = $('#updateCategoryNewCategoryID').val();
            }
            
            let newCategoryValText = $('#newCategoryValText').val();

            ///////////////////////// TRAVEL CONDUCTION VALIDATION
            if(newCategoryValText == 'Travel Conduction'){
                if(
                    $('#EfmsTcDestination').val() == '' ||
                    $('#EfmsTcPurpose').val() == '' ||
                    $('#EfmsTcDate').val() == '' ||
                    $('#EfmsTcTime').val() == '' 
                ){
                    $('#showWarningRequiredAll').show();
                    return;
                }else{
                    $('#showWarningRequiredAll').hide();
                }
            }

            ///////////////////////// BIOMETRICS ENROLLMENT VALIDATION
            if(newCategoryValText == 'Biometrics Enrollment'){
                if(
                    $('#updateCatbioFname').val() == '' ||
                    $('#updateCatbioLname').val() == '' ||
                    $('#bioCurrentIDNo').val() == '' ||
                    $('#bioEmpStatusSelect').val() == '' ||
                    $('#bioSectionSelect').val() == '' ||
                    $('#bioDesignationSelect').val() == '' 
                ){
                    $('#showWarningRequiredAll').show();
                    return;
                }else{
                    $('#showWarningRequiredAll').hide();
                }
            }

            ///////////////////////// HOMIS ENCODING ERROR VALIDATION
            if(newCategoryValText == 'HOMIS Encoding Error'){

                if(
                    $('#updateCathomisHospitalNo').val() == '' ||
                    $('#updateCathomisEncodedBy').val() == '' ||
                    $('#updateCathomisFname').val() == '' ||
                    $('#updateCathomisLName').val() == '' ||
                    $('#updateCathomisEncodingError').val() == '' ||
                    $('#updateCathomisCorrectDetails').val() == '' 
                ){
                    $('#showWarningRequiredAll').show();
                    return;
                }else{
                    $('#showWarningRequiredAll').hide();
                }
            }

            ///////////////////////// SYSTEM ENHANCEMENT VALIDATION
            if(newCategoryValText == 'System Enhancement / Modification / Homis / Other Installation'){
                if($('#systemEnhanceSelectSystemID').val() == '' || $('#systemEnhanceRequestDetails').val() == ''){
                    $('#showWarningRequiredAll').show();
                    return;
                }else{
                    $('#showWarningRequiredAll').hide();
                }
            }

            ///////////////////////// NETWORK INSTALLATION VALIDATION
            if(newCategoryValText == 'Network Installation / Internet Connection / Cable Transfer'){
                if($('#networkInstallConnectionId').val() == '' ||
                $('#networkInstallRequestDetails').val() == ''){
                    $('#showWarningRequiredAll').show();
                    return;
                }else{
                    $('#showWarningRequiredAll').hide();
                }
            }

            ///////////////////////// WEB UPLOADS VALIDATION
            if(newCategoryValText == 'Website Uploads'){
                //console.log($('#webUploadFile')[0].files.length);
                if($('#updateCatwebUploadDetails').val() == '' || $('#updateCatwebUploadFile')[0].files.length == 0){
                    $('#showWarningRequiredAll').show();
                    return;
                }else{
                    $('#showWarningRequiredAll').hide();
                }
            }

            ///////////////////////// WEB UPLOADS VALIDATION
            if(newCategoryValText == 'Zoom Link'){
                if(
                    $('#zoomTitle').val() == '' ||
                    $('#zoomDate').val() == '' ||
                    $('#zoomTime').val() == '' ||
                    $('#zoomParticipants').val() == '' ||
                    $('#zoomDuration').val() == '' ||
                    $('#zoomEmail').val() == ''
                ){
                    $('#showWarningRequiredAll').show();
                    return;
                }else{
                    $('#showWarningRequiredAll').hide();
                }
            }

            ///////////////////////// VMC ID CARD VALIDATION
            if(newCategoryValText == 'VMC ID Card Preparation'){
                if(
                    $('#vmcIdCardEmpStatus').val() == '' ||
                    $('#vmcIdCardPosition').val() == '' ||
                    $('#idrequest_fname').val() == '' ||
                    $('#vmcIdCardLastname').val() == '' ||
                    $('#idrequest_dob').val() == '' ||
                    $('#idrequest_street').val() == '' ||
                    $('#vmcIdCardCity').val() == '' ||
                    $('#vmcIdCardBarangay').val() == '' ||
                    $('#idrequest_tinno').val() == '' ||
                    $('#idrequest_gsis').val() == '' ||
                    $('#idrequest_blood').val() == '' ||
                    $('#idrequest_height').val() == '' ||
                    $('#idrequest_weight').val() == '' ||
                    $('#idrequest_emerfname').val() == '' ||
                    $('#idrequest_emerlname').val() == '' ||
                    $('#idrequest_emercontactno').val() == '' ||
                    $('#idrequest_emerstreet').val() == '' ||
                    $('#vmcIdCardCityEmergency').val() == '' ||
                    $('#vmcIdCardBarangayEmergency').val() == '' ||
                    $('#idrequest_picture')[0].files.length == 0 ||
                    $('#idrequest_signature')[0].files.length == 0
                ){
                    $('#showWarningRequiredAll').show();
                    return;
                }else{
                    $('#showWarningRequiredAll').hide();
                }

            }


            /////////////////////////////////////////////////////////////// CHECK IF OLD CATEGORY vs NEW CATEGORY is SAME
            let categoryIdCurrent = $('#formCurrentCategoryID').val();
            let categoryIdNew = $('#newCategoryValId').val();
            if(categoryIdCurrent === categoryIdNew){

                $('#showWarning').html("*Selected Category is SAME");
                $('#showWarning').show();
                return;
            }else{
                $('#showWarning').hide();
            }

            let categoryTextVal =  $("#updateCategoryNewCategoryID option:selected").text();

            $.confirm({
                icon: '',
                title: 'Confirm Update Category',
                content: 'Confirm Update Category From ' + `<p class="text-success text-sm fw-bold">` + getCurrentCategory + '</p>To<p class="text-success text-sm fw-bold">' + categoryTextVal + `</p>`,
                type: 'dark',
                draggable: true,
                buttons: {
                    YES: {
                        text: 'YES',
                        btnClass: 'btn-success',
                        keys: ['enter', 'shift'],
                        action: function(){

                            //location.href = "/reopen_request/"+getRefID;
                            $('#updateCategoryForm').submit();
                        }
                    },
                    NO: function () {
                    }
                }
            });// EOF JQUERY CONFIRM 
        });//EOF REOPEN REQUEST CLICK
    });// EOF DOC READY
</script>




