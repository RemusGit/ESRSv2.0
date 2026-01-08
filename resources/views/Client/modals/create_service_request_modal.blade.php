
<!-- CONTACT/REQUEST DETAILS -->

<!-- Modal -->
<div class="modal fade" id="createServiceRequestModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5 text-success" id="contact_request_details_modal">
        <span id="contact_request_details_title">
        </span> <i class="bi bi-fingerprint" id="contact_details_request_icon"></i>
        <span class="text-secondary" style="font-size: 14px;" id="categoryDuration"></span></h2>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <div class="modal-body">

            <div class="container">
                
                <!-----------------------------------------------                      EFMS CATEGORY            --------------------->

                <!-- ALL EFMS -->
                <div id="divAllEfms" class="allDivDetails">
                  <form action="/add_all_efms_request" method="POST" id="efmsCategoryForm">
                    @csrf
                    @include('client.modals.contact_request_details_others_efms')
                    <input type="hidden" name="categoryID" id="addRequestCategoryID" value=""> <!-- 41 = EFMS CATEGORY ID  -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <!--input type="hidden" name="getEfmsInitials" value="(OT)"--> <!-- 1 = EFMS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>

                <!-----------------------------------------------                      IMISS CATEGORY            --------------------->
                <!-- OTHERS IMISS -->
                <div id="divForOthersImissDetails" class="allDivDetails">
                  <form action="/add_others_imiss" method="POST" id="imissForm33" class="imissClassForm">
                    @csrf
                    @include('client.modals.contact_request_details_others_imiss')
                    <input type="hidden" name="categoryID" value="33"> <!-- 33 = Others IMISS  -->
                    <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>

                <!-- REPAIR IT EQUIPMENT -->
                <div id="divForRepairItEquipmentDetails" class="allDivDetails">
                  <form action="/add_repait_it_equipment" method="POST" id="imissForm1" class="imissClassForm">
                    @csrf
                    @include('client.modals.contact_request_details_repair_it_eq')
                    <input type="hidden" name="categoryID" value="1"> <!-- 1 = REPAIR IT EQUIPMENT  -->
                    <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>

                <!-- TECHNICAL ASSISTANCE -->
                <div id="divForTechAssistDetails" class="allDivDetails">
                  <form action="/add_technical_assistance" method="POST" id="imissForm8" class="imissClassForm">
                    @csrf
                    @include('client.modals.contact_request_details_tech_assist')
                    <input type="hidden" name="categoryID" value="8"> <!-- 8 = TECHNICAL ASSISTANCE --->
                    <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>


                <!-- TRAINING ORIENTATION / COMPUTER LITERACY -->
                <div id="divForTrainingOrientationDetails" class="allDivDetails">
                  <form action="/add_training_orientation" method="POST" id="imissForm10" class="imissClassForm">
                    @csrf
                    @include('client.modals.contact_request_details_training_orient')
                    <input type="hidden" name="categoryID" value="10"> <!-- 10 = TRAINING ORIENTATION --->
                    <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>


                <!-- USER ACCOUNT MANAGEMENT -->
                <div id="divForUserAccMngtDetails" class="allDivDetails">
                  <form action="/add_user_account_management" method="POST" id="imissForm11" class="imissClassForm">
                    @csrf
                    @include('client.modals.contact_request_details_user_account')
                    <input type="hidden" name="categoryID" value="11"> <!-- 11 = USER ACCOUNT MANAGEMENT --->
                    <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>

                <!--BIO DETAILS-->
                <div id="divForBioDetails" class="allDivDetails">
                  <form action="/add_biometrics_enrollment" method="POST" id="imissForm12" class="imissClassForm">
                    @csrf
                    @include('client.modals.contact_request_details_bio')
                    <input type="hidden" name="categoryID" value="12"> <!-- 12 = Biometrics Enrollment  -->
                    <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                    @include('client.modals.bio_details')
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>

                <!--HOMIS DETAILS-->
                <div id="divForHomisDetails" class="allDivDetails">
                      <form action="/add_homis_encode_error" method="POST" id="imissForm4" class="imissClassForm">
                      @csrf
                      @include('client.modals.contact_request_details_homis')
                      <input type="hidden" name="categoryID" value="4"> <!-- 4 = iHOMIS Encode Error  -->
                      <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                      @include('client.modals.homis_details')
                        <div class="modal-footer mt-5">
                        <button type="submit" class="btn btn-success">Submit Request</button>
                      </div>
                    </form>
                </div>

                <!--NETWORK INSTALL DETAILS-->
                <div id="divForNetworkInstallDetails" class="allDivDetails">
                      <form action="/add_network_install" method="POST" id="imissForm6" class="imissClassForm">
                        @csrf
                        @include('client.modals.contact_request_details_network_install')
                        <input type="hidden" name="categoryID" value="6"> <!-- 6 = NETWORK INSTALL  -->
                        <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                        @include('client.modals.network_install_details')
                        <div class="modal-footer mt-5">
                          <button type="submit" class="btn btn-success">Submit Request</button>
                        </div>
                    </form>
                </div>

                <!--SYSTEM ENHANCE DETAILS-->
                <div id="divForSystemEnhanceDetails" class="allDivDetails">
                      <form action="/add_system_enhance" method="POST" id="imissForm3" class="imissClassForm">
                        @csrf
                        @include('client.modals.contact_request_details_system_enhance')
                        <input type="hidden" name="categoryID" value="3"> <!-- 3 = SYSTEM ENHANCEMENT  -->
                        <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                         @include('client.modals.system_enhance_details')
                        <div class="modal-footer mt-5">
                          <button type="submit" class="btn btn-success">Submit Request</button>
                        </div>
                    </form>
                </div>

                <!--SYSTEM VMC ID DETAILS-->
                <div id="divForVMCIDDetails" class="allDivDetails">
                    <form action="/add_vmc_id_card" method="POST" enctype="multipart/form-data" id="imissForm13" class="imissClassForm">
                      @csrf
                      @include('client.modals.contact_request_details_vmc_card')
                      <input type="hidden" name="categoryID" value="13"> <!-- 13 = VMC ID CARD PREPARATION  -->
                      <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                      @include('client.modals.vmc_id_details')
                      <div class="modal-footer mt-5">
                        <button type="submit" class="btn btn-success" id="vmcIdSubmitBtn">Submit Request</button>
                      </div>
                    </form>
                </div>

                <!--SYSTEM WEB UPLOADS DETAILS-->
                <div id="divForWebUploadsDetails" class="allDivDetails">
                      <form action="/add_web_uploads" method="POST" enctype="multipart/form-data" id="imissForm7" class="imissClassForm">
                        @csrf
                        @include('client.modals.contact_request_details_web_uploads')
                        <input type="hidden" name="categoryID" value="7"> <!-- 7 = Web Uploads  -->
                        <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                        @include('client.modals.web_uploads_details')
                        <div class="modal-footer mt-5">
                          <button type="submit" class="btn btn-success" id="webUploadSubmitBtn">Submit Request</button>
                        </div>
                    </form>
                </div>

                <!--SYSTEM ZOOM LINK DETAILS-->
                <div id="divForZoomLinkDetails" class="allDivDetails">
                    <form action="/add_zoom_link" method="POST" id="imissForm30" class="imissClassForm">
                      @csrf
                      @include('client.modals.contact_request_details_zoom')
                      <input type="hidden" name="categoryID" value="30"> <!-- 30 = ZOOM MEETING  -->
                      <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                      @include('client.modals.zoom_link_details')
                      <div class="modal-footer mt-5">
                        <button type="submit" class="btn btn-success">Submit Request</button>
                      </div>
                    </form>
                </div>
                
                
            </div>
            <!-- EOF CONTAINER-->

          </div>
      <!--div class="modal-footer">
        <button type="button" class="btn btn-success">Submit Request</button>
      </div-->
    </div>
  </div>
</div>

@include('client.modals.modal_load_floor_per_location')

<script>

    /////////////////////////////////////////////////////////// CHECK ACKNOWLEDGE ALL IMISS REQUEST
    $('.imissClassForm').on('submit' , function(e){
    
    const form = this;

    e.preventDefault();

      //var getFormID = $(this).closest('form').attr('id');
      //var getFormID = this.id;
      //console.log(getFormID);
      
      let AccountID = "{{ Auth::user()->account_empid }}";
      let agentUnitID = 2;

      checkAcknowledge(AccountID , agentUnitID , function(res){

      if(res == "OK"){
          form.submit();
        }
      });

    });

    /*
    /////////////////////////////////////////////////////////// CHECK ACKNOWLEDGE OTHERS (IMISS)
    $('#imissSubmit33').on('click' , function(e){

        e.preventDefault();
        let AccountID = "{{ Auth::user()->account_empid }}";
        let agentUnitID = 2;

        checkAcknowledge(AccountID , agentUnitID , '#imissForm33');
    });
    */

    /////////////////////////////////////////////////////////// CHECK ACKNOWLEDGE ALL EFMS
    $('#efmsCategoryForm').on('submit' , function(e){

        const form = this;

        e.preventDefault();
        let AccountID = "{{ Auth::user()->account_empid }}";
        let agentUnitID = 1;

        checkAcknowledge(AccountID , agentUnitID , function(res){

          if(res == "OK"){
            form.submit();
          }

        });
    });

    function checkAcknowledge(AccountID , agentUnitID , callback){

          var getReturnVal = "ERROR";

          $.ajax({
          url: "{{ route('checkAcknowledge') }}", 
            type: 'POST', 
            data: {
              AccountID: AccountID,
              agentUnitID: agentUnitID,
              _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                console.log(res);
                if(res == 1){
                  $.dialog({
                      icon: 'bi bi-exclamation-circle-fill',
                      title: 'Unable to Create Request',
                      type: 'red',
                      draggable: true,
                      content: 'Please Acknowledge current request first. '+
                      '<div class="float-end"><a href="/client_acknowledge_request" class="mt-4 btn btn-sm btn-secondary">Go to Acknowledge <i class="bi bi-arrow-bar-right"></i></a></div>',
                  });
                }else{
                    getReturnVal = "OK";
                    //console.log(getReturnVal);
                    callback(getReturnVal);
                }
            },
            error: function(error) {
              console.error(error);
            }
          });//EOF AJAX
    }

</script>