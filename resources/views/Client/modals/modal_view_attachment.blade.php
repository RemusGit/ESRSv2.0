
<!-- Modal -->
<div class="modal fade" id="viewAttachmentModal"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLabel">
            <span id="attachmentCategoryTitle"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <div class="container text-sm">
            
            <label class="lead fw-bold text-secondary" id="attachmentRefID">-</label>
            <p class="lead" id="attachmentDivision">-</p>
            <hr class="border shadow-lg">

            <p class="fw-bold text-sm">Overview <i class="bi bi-eye-fill"></i></p>


            <!----------------------------------------TRAVEL CONDUCTION---------------------------------------------->
            <div id="forEfmsTC">

                <div class="row">
                    <div class="col-md-3">
                        Destination
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="efmsTCDestination"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        Purpose
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="efmsTCPurpose"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        Travel Date
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="efmsTCTravelDate"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        Travel Time
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="efmsTCTravelTime"></label>
                    </div>
                </div>
                
            </div>

            <!----------------------------------------FOR MODIFICATION---------------------------------------------->
            <div id="forModification">

                    <label for="floatingTextarea2" id="modVmcVal"></label>
                    <textarea id="modDetailsVal" class="form-control" placeholder="" id="floatingTextarea2" style="height: 200px" readonly></textarea>
                
            </div>

            <!----------------------------------------WEB UPLOADS---------------------------------------------->
            <div id="forWebUploads">

                    <label for="floatingTextarea2">Website Upload Details</label>
                    <textarea id="webUploadDetails" class="form-control" placeholder="" id="floatingTextarea2" style="height: 200px" readonly></textarea>
                    
                <a href="#" download class="text-end" id="webUploadDownloadAnchor">Download Attachment</a>
                
            </div>

            <!----------------------------------------ZOOM LINK---------------------------------------------->
            <div id="forZoomLink">

                <div class="row">
                    <div class="col-md-3">
                        VM Title
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="VmTitle"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        Meeting Date
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="VmDate"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        Meeting Time
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="VmTime"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        No. of Hours
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="VmHrsNo"></label>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3">
                        No. of Participants
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="VmParticipants"></label>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3">
                        Email Address
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="VmEmail"></label>
                    </div>
                </div>

            </div>

            <!----------------------------------------NETWORK INSTALL---------------------------------------------->
            <div id="forNetworkInstall">

                <div class="row">
                    <div class="col-md-3">
                        Connection Type
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="networkInstallConnType"></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        Description
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="networkIntallDesc"></label>
                    </div>
                </div>

            </div><!--EOF FOR NETWORK INSTALL -->

      
             <!----------------------------------------HOMIS ENCODE ERROR---------------------------------------------->
             <div id="forHomisEncodingError">

                <div class="row">
                    <div class="col-md-3">
                        Hospital No.
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="homisHospitalNo"></label>
                    </div>
                </div>  
                
                
                <div class="row">
                    <div class="col-md-3">
                        Patient First Name
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="homisPatientFname"></label>
                    </div>
                </div>     

                <div class="row">
                    <div class="col-md-3">
                        Patient Middle Name
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="homisPatientMname"></label>
                    </div>
                </div>   

                <div class="row">
                    <div class="col-md-3">
                        Patient Last Name
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="homisPatientLname"></label>
                    </div>
                </div>   


                <div class="row">
                    <div class="col-md-3">
                        Patient Suffix
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="homisPatientSuffix"></label>
                    </div>
                </div>   

                <div class="row">
                    <div class="col-md-3">
                        Encoding Error Details
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="homisErrorDetails"></label>
                    </div>
                </div>   

                <div class="row">
                    <div class="col-md-3">
                        Correct Data Details
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="homisCorrectDetails"></label>
                    </div>
                </div>  

                <div class="row">
                    <div class="col-md-3">
                        Encoded By
                    </div>
                    <div class="col-md-9 lead fw-bold text-secondary">
                        <label id="homisEncodedBy"></label>
                    </div>
                </div>  

            </div><!--EOF FOR HOMIS ENCODING-->


        <div id="forBiometrics">

                    <div class="row">
                        <div class="col-md-3">
                            First Name
                        </div>
                        <div class="col-md-9 lead fw-bold text-secondary">
                            <label id="bioFname"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            Middle Name
                        </div>
                        <div class="col-md-9 lead fw-bold text-secondary">
                            <label id="bioMname"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            Last Name
                        </div>
                        <div class="col-md-9 lead fw-bold text-secondary">
                            <label id="bioLname"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            Suffix
                        </div>
                        <div class="col-md-9 lead fw-bold text-secondary">
                            <label id="bioSuffix"></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            Designation
                        </div>
                        <div class="col-md-9 lead fw-bold text-secondary">
                            <label id="bioDesig"></label>
                        </div>
                    </div>           
                    
                    <div class="row">
                        <div class="col-md-3">
                            Current I.D Number
                        </div>
                        <div class="col-md-9 lead fw-bold text-secondary">
                            <label id="bioIdNumber"></label>
                        </div>
                    </div>      

                    <div class="row">
                        <div class="col-md-3">
                            Employment Status
                        </div>
                        <div class="col-md-9 lead fw-bold text-secondary">
                            <label id="bioEmpStatus"></label>
                        </div>
                    </div>      

        </div><!--EOF FOR BIOMETRICS-->


        <div id="formVmcIdCard">

            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('uploads\VMC_ID_Picture\na-pic1.png') }}"
                     class="img-fluid img-thumbnail float-end" alt="" id="vmcIdCardPic">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Current Employee  ID
                </div>
                <div class="col-md-9 lead fw-bold text-secondary" id="vmcIdCardEmpID">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Employee Fullname
                </div>
                <div class="col-md-9 lead fw-bold text-secondary" id="vmcIdCardEmpFullname">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Complete Address
                </div>
                <div class="col-md-9 lead fw-bold text-secondary" id="vmcIdCardAddress" style="font-size: 14px;">
                </div>
            </div>

            <div class="row">

                <div class="col-md-3">
                    Blood type
                </div>
                <div class="col-md-1 lead fw-bold text-secondary text-start" id="vmcIdBlood">
                </div>

                <div class="col-md-2 text-end">
                    Height
                </div>
                <div class="col-md-1 lead fw-bold text-secondary text-start" id="vmcIdCardHeight">
                </div>

                <div class="col-md-2 text-end">
                    Weight(kg.)
                </div>
                <div class="col-md-1 lead fw-bold text-secondary text-start" id="vmcIdCardWeight">
                </div>

            </div>

            <div class="row">
                <div class="col-md-3">
                    TIN
                </div>
                <div class="col-md-9 lead fw-bold text-secondary" id="vmcIdCardTIN">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    GSIS
                </div>
                <div class="col-md-9 lead fw-bold text-secondary" id="vmcIdCardGSIS">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Employee Position
                </div>
                <div class="col-md-9 lead fw-bold text-secondary" id="vmcIdCardEmpPosition">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" style="font-size: 14px;">
                    Emergency Contact Person
                </div>
                <div class="col-md-9 lead fw-bold text-secondary" id="vmcIdCardEmergencyFullname">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    Contact No.
                </div>
                <div class="col-md-9 lead fw-bold text-secondary" id="vmcIdCardEmergencyContact">
                </div>
            </div>

            <div class="row pb-4">
                <div class="col-md-3">
                    Address
                </div>
                <div class="col-md-9 lead fw-bold text-secondary" id="vmcIdCardEmergencyAddress" style="font-size: 14px;">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 ms-auto text-end">
                    <a href="#" target="blank" id="vmcIdCardHref">View Identification Card Form</a>
                </div>
            </div>

        </div><!--EOF FOR VMC ID CARD-->


        <!------------------------------------------------------------------------------------------------------------>

        </div><!--EOF CONTAINER-->
      </div><!--EOF MODAL BODY-->
    </div>
  </div>
</div>


<script>
        //$('.viewAttachment').click(function(){
        $(document).on('click' , '.viewAttachment' , function(){

            let arraysplit = this.id.split("?");
            let getRefID = arraysplit[0];
            let getCategoryVal = arraysplit[1];
            let encryptedRefID = arraysplit[2];

            console.log(getRefID);

            $('#forHomisEncodingError').hide();
             $('#forBiometrics').hide();
             $('#forNetworkInstall').hide();
             $('#forZoomLink').hide();
             $('#forWebUploads').hide(); 
             $('#forModification').hide(); 
             $('#formVmcIdCard').hide(); 
             $('#forEfmsTC').hide(); 
             
            if(getCategoryVal == 'Biometrics Enrollment'){

                $('#attachmentCategoryTitle').html("Biometrics Attachment");
                $('#forBiometrics').show();
            }

            if(getCategoryVal == 'HOMIS Encoding Error'){

                $('#attachmentCategoryTitle').html("HOMIS Encoding Error Attachment");
                $('#forHomisEncodingError').show();
            }

            if(getCategoryVal == 'Network Installation / Internet Connection / Cable Transfer'){

                $('#attachmentCategoryTitle').html("Connection Attachment");
                $('#forNetworkInstall').show();
            }

            if(getCategoryVal == 'Zoom Link'){

                $('#attachmentCategoryTitle').html("Virtual Meeting Attachment");
                $('#forZoomLink').show();
            }

            if(getCategoryVal == 'Website Uploads'){

                $('#attachmentCategoryTitle').html("Website Upload Attachment");
                $('#forWebUploads').show(); 
            }

            if(getCategoryVal == 'System Enhancement / Modification / Homis / Other Installation'){

                $('#attachmentCategoryTitle').html("Modification Attachment");
                $('#forModification').show(); 
            }

            if(getCategoryVal == 'VMC ID Card Preparation'){

                $('#attachmentCategoryTitle').html("VMC ID Card Preparation");
                $('#formVmcIdCard').show(); 
            }

            if(getCategoryVal == 'Travel Conduction'){

                $('#attachmentCategoryTitle').html("Travel Conduction");
                $('#forEfmsTC').show(); 
            }

            let imgPath = "{{ asset('uploads/VMC_ID_Picture/') }}/";
            
            //console.log(getCategoryVal);

                    $.ajax({
                        url: "{{ route('viewAttachment') }}",
                        type: "POST",
                        data: {
                            refID: getRefID,
                            categoryVal: getCategoryVal,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {

                            $.each(JSON.parse(res) , function(i , val){

                                if(getCategoryVal == 'Travel Conduction'){

                                    $('#efmsTCDestination').html(val.travel_destination);
                                    $('#efmsTCPurpose').html(val.travel_purpose);
                                    $('#efmsTCTravelDate').html(val.travel_date);
                                    $('#efmsTCTravelTime').html(val.travel_time);
                                }

                                if(getCategoryVal == 'VMC ID Card Preparation'){
                                    let getEmpSuffix = val.empSuffix;
                                    if(getEmpSuffix == null){
                                        getEmpSuffix = "";
                                    }

                                    $('#vmcIdCardHref').attr("href" , "/vmc_card_form/"+encryptedRefID);
                                   
                                    $('#vmcIdCardEmpID').html(val.empID);
                                    $('#vmcIdCardEmpFullname').html(val.empLname + ' , ' + ' ' + val.empFname + ' ' + val.empMname + ' ' + getEmpSuffix);
                                    $('#vmcIdCardEmpPosition').html(val.empPosition);
                                    $('#vmcIdCardEmpBday').html(val.empBday);
                                    $('#vmcIdCardAddress').html(val.addressSt + ' ' + val.cityName + '(' + val.provName + ') ' + val.brgyName );
                                    $('#vmcIdCardTIN').html(val.tinNo);
                                    $('#vmcIdCardGSIS').html(val.GSIS);
                                    $('#vmcIdBlood').html(val.bloodType);
                                    $('#vmcIdCardHeight').html(val.empHeight);
                                    $('#vmcIdCardWeight').html(val.empWeight);

                                    $('#vmcIdCardPic').attr('src', imgPath + val.empPic);
                                    $('#vmcIdCardPic').on('error' , function(){
                                        $('#vmcIdCardPic').attr('src', imgPath + 'na-pic1.png');
                                    });
           
                                    $('#vmcIdCardEmergencyFullname').html(val.emergencyFname + ' ' + val.emergencyMname + ' ' + val.emergencyLname) + ' ' + val.emergencySuffix;
                                    $('#vmcIdCardEmergencyContact').html(val.emergencyContactNo);
                                    $('#vmcIdCardEmergencyAddress').html(val.emergencyStreet + ' ' + val.emergencyCityName + '(' + val.emergencyProvName +')' + ' ' + val.emergencyBrgyName);
                                }// EOF VMC CARD PREP

                                if(getCategoryVal == 'Biometrics Enrollment'){

                                        $('#bioFname').html(val.firstName);
                                        $('#bioMname').html(val.middleName);
                                        $('#bioLname').html(val.lastName);
                                        $('#bioSuffix').html(val.suffix);
                                        $('#bioIdNumber').html(val.currentID);
                                        $('#bioDesig').html(val.positionName);
                                        $('#bioEmpStatus').html(val.employmentStatus);


                                    }//EOF CATEGORYVAL FOR BIOMETRICS


                                    if(getCategoryVal == 'HOMIS Encoding Error'){

                                        $('#homisHospitalNo').html(val.hospitalNo);
                                        $('#homisPatientFname').html(val.patientFname);
                                        $('#homisPatientMname').html(val.patientMname);
                                        $('#homisPatientLname').html(val.patientLname);
                                        $('#homisPatientSuffix').html(val.patientSuffix);
                                        $('#homisErrorDetails').html(val.encodeError);
                                        $('#homisCorrectDetails').html(val.encodeCorrect);
                                        $('#homisEncodedBy').html(val.encodedBy);

                                    }//EOF CATEGORYVAL FOR HOMIS ENCODING ERROR


                                    if(getCategoryVal == 'Network Installation / Internet Connection / Cable Transfer'){

                                        $('#networkInstallConnType').html(val.connectionVal);
                                        $('#networkIntallDesc').html(val.networkDesc);

                                    }//EOF CATEGORYVAL FOR NETWORK INSTALL


                                    if(getCategoryVal == 'Zoom Link'){

                                        $('#VmTitle').html(val.vmTile);
                                        $('#VmDate').html(val.vmDate);
                                        $('#VmTime').html(val.vmTime);
                                        $('#VmHrsNo').html(val.vmHrs);
                                        $('#VmParticipants').html(val.vmParticipants);
                                        $('#VmEmail').html(val.vmEmail);

                                    }// EOF ZOOM LINK


                                    if(getCategoryVal == 'Website Uploads'){

                                        $('#webUploadDetails').val(val.webDetails); 
                                        $('#webUploadDownloadAnchor').attr("href", "web_upload_download/"+getRefID+'.zip');
                                    }// EOF WEB UPLOADS

                                    $('#attachmentDivision').html(val.sectionName);
                                     

                                    // NOTE SYSTEM ENHANCE / VMC ID CARD HAS NO SECTION-ID IN THE TABLE
                                    if(getCategoryVal == 'System Enhancement / Modification / Homis / Other Installation' || getCategoryVal == 'VMC ID Card Preparation'){

                                        $('#modVmcVal').html(val.modVmcVal);
                                        $('#modDetailsVal').html(val.modDetails);
                                        $('#attachmentDivision').html("-"); 
                                    }// EOF SYSTEM MODIFICATION

                                    
                               
                                $('#attachmentRefID').html(getRefID);
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });//EOF AJAX
        });
</script>