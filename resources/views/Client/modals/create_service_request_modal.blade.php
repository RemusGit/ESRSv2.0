
<!-- CONTACT/REQUEST DETAILS -->

<!-- Modal -->
<div class="modal fade" id="createServiceRequestModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-success" id="contact_request_details_modal">
        <span id="contact_request_details_title">
        </span> <i class="bi bi-fingerprint" id="contact_details_request_icon"></i></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <div class="modal-body">

            <div class="container">
                
                <!-----------------------------------------------                      EFMS CATEGORY            --------------------->

                <!-- TRAVEL CONDUCTION -->
                <div id="divForEfmsTC" class="allDivDetails">
                  <form action="/add_efms_tc" method="POST">
                    @csrf
                    @include('client.modals.contact_request_details_tc')
                    <input type="hidden" name="categoryID" value="42"> <!-- 42 = TRAVEL CONDUCTION  -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <input type="hidden" name="getEfmsInitials" value="(TC)"> <!-- 1 = EFMS  -->
                    @include('client.modals.travel_conduction_details')
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>


                <!-- OTHERS EFMS -->
                <div id="divForOthersEfmsDetails" class="allDivDetails">
                  <form action="/add_all_efms_request" method="POST">
                    @csrf
                    @include('client.modals.contact_request_details_others_efms')
                    <input type="hidden" name="categoryID" value="41"> <!-- 41 = Others IMISS  -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <input type="hidden" name="getEfmsInitials" value="(OT)"> <!-- 1 = EFMS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>

                <!-- Technical Assistance -->
                <div id="divForRepairTechAssist" class="allDivDetails">
                  <form action="/add_all_efms_request" method="POST">
                    @csrf
                    @include('client.modals.contact_request_details_repair_ew')
                    <input type="hidden" name="categoryID" value="40"> <!-- 40 = Technical Assistance -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <input type="hidden" name="getEfmsInitials" value="(TA)"> <!-- 1 = EFMS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>


                <!-- Repair of Plumbing Works -->
                <div id="divForRepairPlumbingWorks" class="allDivDetails">
                  <form action="/add_all_efms_request" method="POST">
                    @csrf
                    @include('client.modals.contact_request_details_repair_ew')
                    <input type="hidden" name="categoryID" value="39"> <!-- 39 = Repair of Plumbing Works -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <input type="hidden" name="getEfmsInitials" value="(PW)"> <!-- 1 = EFMS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>


                <!-- Repair of Electrical Works -->
                <div id="divForRepairElecWorks" class="allDivDetails">
                  <form action="/add_all_efms_request" method="POST">
                    @csrf
                    @include('client.modals.contact_request_details_repair_ew')
                    <input type="hidden" name="categoryID" value="38"> <!-- 38 = Repair of Electrical Works -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <input type="hidden" name="getEfmsInitials" value="(EW)"> <!-- 1 = EFMS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>

                <!-- Repair of Civil Works -->
                <div id="divForRepairCivilWorks" class="allDivDetails">
                  <form action="/add_all_efms_request" method="POST">
                    @csrf
                    @include('client.modals.contact_request_details_repair_cw')
                    <input type="hidden" name="categoryID" value="37"> <!-- 37 = Repair of Civil Works  -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <input type="hidden" name="getEfmsInitials" value="(CW)"> <!-- 1 = EFMS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>


                <!-- Repair of Architectural Works -->
                <div id="divForRepairArchWorks" class="allDivDetails">
                  <form action="/add_all_efms_request" method="POST">
                    @csrf
                    @include('client.modals.contact_request_details_repair_aw')
                    <input type="hidden" name="categoryID" value="36"> <!-- 36 = Repair of Architectural Works  -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <input type="hidden" name="getEfmsInitials" value="(AW)"> <!-- 1 = EFMS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>

                <!-- Repair of Office Equipment -->
                <div id="divForRepairOfficeEQ" class="allDivDetails">
                  <form action="/add_all_efms_request" method="POST">
                    @csrf
                    @include('client.modals.contact_request_details_repair_oe')
                    <input type="hidden" name="categoryID" value="35"> <!-- 35 = Repair of Office Equipment  -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <input type="hidden" name="getEfmsInitials" value="(OE)"> <!-- 1 = EFMS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>

                <!-- Repair of Medical Equipment -->
                <div id="divForRepairMedEQ" class="allDivDetails">
                  <form action="/add_all_efms_request" method="POST">
                    @csrf
                    @include('client.modals.contact_request_details_repair_me')
                    <input type="hidden" name="categoryID" value="34"> <!-- 34 = Repair of Medical Equipment  -->
                    <input type="hidden" name="agentUnitID" value="1"> <!-- 1 = EFMS  -->
                    <input type="hidden" name="getEfmsInitials" value="(ME)"> <!-- 1 = EFMS  -->
                    <div class="modal-footer mt-5">
                      <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>
                  </form>
                </div>


                <!-----------------------------------------------                      IMISS CATEGORY            --------------------->
                <!-- OTHERS IMISS -->
                <div id="divForOthersImissDetails" class="allDivDetails">
                  <form action="/add_others_imiss" method="POST">
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
                  <form action="/add_repait_it_equipment" method="POST">
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
                  <form action="/add_technical_assistance" method="POST">
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
                  <form action="/add_training_orientation" method="POST">
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
                  <form action="/add_user_account_management" method="POST">
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
                  <form action="/add_biometrics_enrollment" method="POST">
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
                      <form action="/add_homis_encode_error" method="POST">
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
                      <form action="/add_network_install" method="POST">
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
                      <form action="/add_system_enhance" method="POST">
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
                    <form action="/add_vmc_id_card" method="POST" enctype="multipart/form-data">
                      @csrf
                      @include('client.modals.contact_request_details_vmc_card')
                      <input type="hidden" name="categoryID" value="13"> <!-- 13 = VMC ID CARD PREPARATION  -->
                      <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                      @include('client.modals.vmc_id_details')
                      <div class="modal-footer mt-5">
                        <button type="submit" class="btn btn-success">Submit Request</button>
                      </div>
                    </form>
                </div>

                <!--SYSTEM WEB UPLOADS DETAILS-->
                <div id="divForWebUploadsDetails" class="allDivDetails">
                      <form action="/add_web_uploads" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('client.modals.contact_request_details_web_uploads')
                        <input type="hidden" name="categoryID" value="7"> <!-- 7 = Web Uploads  -->
                        <input type="hidden" name="agentUnitID" value="2"> <!-- 2 = IMISS  -->
                        @include('client.modals.web_uploads_details')
                        <div class="modal-footer mt-5">
                          <button type="submit" class="btn btn-success">Submit Request</button>
                        </div>
                    </form>
                </div>

                <!--SYSTEM ZOOM LINK DETAILS-->
                <div id="divForZoomLinkDetails" class="allDivDetails">
                    <form action="/add_zoom_link" method="POST">
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
