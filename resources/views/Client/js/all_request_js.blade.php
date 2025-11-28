<script>

    $(document).ready(function(){

        $('.all_request_class').click(function(){

            var getClassIcon = $(this).find('i').attr('class');
            let getRequestID = this.id;

            $('.allDivDetails').hide();

            //BIOMETRICS
            if(getRequestID == "bioEnroll")
            {
               
                $('#request_title , #contact_request_details_title').html("Biometrics Enrollment");
                $('#request_desc').html("Biometric Enrollment means the process of collecting biometric data samples from a person and subsequently storing the data in our databases.");
                $('#request_duration').html("Maximum of 5 working days");


                let getSectionItems = $('#bioSectionSelect option').length;
                let getDesignationItems = $('#bioDesignationSelect option').length;
                let getEmploymentStatusItems = $('#bioEmpStatusSelect option').length;

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

                if(getEmploymentStatusItems == 1){

                    // LOAD ALL EMPLOYMENT STATUS FROM employstatus
                     $.ajax({
                        url: "{{ route('loadEmpStatus') }}", 
                          type: 'GET', 
                          success: function(res) {
                            console.log(res);
                            
                              $.each(JSON.parse(res) , function(i , val){

                                $('#bioEmpStatusSelect').append('<option value='+val.employstatus_id+'>'+val.employstatus_val+'</option>');
                              });
                          },
                          error: function(error) {
                              console.error(error);
                          }
                        });//EOF AJAX
                }// EOF IF EMPLOYMENT STATUS IS EMPTY

                $('#divForBioDetails').show();
            }

            //HOMIS ENCODE ERROR
            if(getRequestID == "homisEncode")
            {
                $('#request_title , #contact_request_details_title').html("HOMIS Encoding Error");
                $('#request_desc').html("HOMIS Encoding Error is an amongst the most typical data entry problems is inputting the incorrect data.");
                $('#request_duration').html("Maximum of 3 working days");

                $('#divForHomisDetails').show();
            }            

            //NETWORK INSTALLATION
            if(getRequestID == "networkInstall")
            {
                $('#networkInstallConnectionId').empty();
                $('#networkInstallConnectionId').append('<option></option>');

                // LOAD ALL CONNECTION FROM connectiontype_tab
                $.ajax({
                url: "{{ route('loadConnection') }}", 
                type: 'GET', 
                success: function(res) {
                    console.log(res);
                    
                    $.each(JSON.parse(res) , function(i , val){

                        $('#networkInstallConnectionId').append('<option value='+val.connectiontype_id +'>'+val.connectiontype_value+'</option>');
                    });
                },
                error: function(error) {
                    console.error(error);
                }
                });//EOF AJAX

                $('#request_title , #contact_request_details_title').html("Network Installation / Internet Connection");
                $('#request_desc').html("Computer networking refers to connected computing devices such as laptops, desktops, servers, smartphones, and tablets.");
                $('#request_duration').html("Maximum of 3 working days");

                $('#divForNetworkInstallDetails').show();
            }

            //REPAIR IT EQUIPMENT
            if(getRequestID == "repairIT")
            {
                $('#request_title , #contact_request_details_title').html("Repair of I.T Equipment");
                $('#request_desc').html("Computer repair is the process of identifying, troubleshooting and resolving problems and issues in a faulty computer.");
                $('#request_duration').html("Maximum of 3 working days");

                $('#divForRepairItEquipmentDetails').show();
            }

            //SYSTEM ENHANCE
            if(getRequestID == "systemEnhance")
            {

                $('#systemEnhanceSelectSystemID').empty();
                $('#systemEnhanceSelectSystemID').append('<option></option>');

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

                $('#request_title , #contact_request_details_title').html("System Enhancement / Modification");
                $('#request_desc').html("A system enhancement is any application change or upgrade that increases application capabilities beyond original end-user specifications.");
                $('#request_duration').html("Indefinite");

                $('#divForSystemEnhanceDetails').show();
            }

            //TECHNICAL ASSIST
            if(getRequestID == "techAssist")
            {
                $('#request_title , #contact_request_details_title').html("Technical Assistance");
                $('#request_desc').html("Providing technical support such as resolving technical issues in a timely manner using available resources.");
                $('#request_duration').html("Maximum of 4 office hours");

                $('#divForTechAssistDetails').show();
            }

            //TRAINING ORIENTATION
            if(getRequestID == "trainingOrient")
            {
                $('#request_title , #contact_request_details_title').html("Training - Orientation / Computer Literacy");
                $('#request_desc').html("The ability to effectively use computer technology to solve problems and efficiently meet personal and professional needs.");
                $('#request_duration').html("Indefinite");

                $('#divForTrainingOrientationDetails').show();
            }


            //USER ACC MANAGEMENT
            if(getRequestID == "userAccMngt")
            {
                $('#request_title , #contact_request_details_title').html("User Account Management");
                $('#request_desc').html("User Management role is authorized to create and delete user accounts, change user passwords, change roles assigned to other users.");
                $('#request_duration').html("Maximum of 4 office hours");

                $('#divForUserAccMngtDetails').show();
            }

            //VMC ID
            if(getRequestID == "vmcID")
            {
                $('#request_title , #contact_request_details_title').html("VMC ID Card Preparation");
                $('#request_desc').html("I.D cards are your ultimate source of identification for easy introductions, whether you’re a contractual or permanent employee.");
                $('#request_duration').html("Maximum of 3 working days");

                $('#divForVMCIDDetails').show();

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

                        let toUpdate = 1;
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
            }

            //WEB UPLOADS
            if(getRequestID == "webUploads")
            {
                $('#request_title , #contact_request_details_title').html("Website Uploads");
                $('#request_desc').html("Website upload is the process of putting web pages, images and files onto a web server.");
                $('#request_duration').html("Maximum of 1 working day");

                $('#divForWebUploadsDetails').show();
            }
            
            //ZOOM LINK
            if(getRequestID == "zoomLink")
            {
                $('#request_title , #contact_request_details_title').html("Zoom Link");
                $('#request_desc').html("Zoom meeting links are used to invite prospective participants to a meeting. These links may contain information like the meeting ID, password, and web address.");
                $('#request_duration').html("Maximum of 4 office hours");

                $('#divForZoomLinkDetails').show();
            }
            

            //REPAIR MEDICAL EQUIPMENT
            if(getRequestID == "repairMedEquipment")
            {
                $('#request_title , #contact_request_details_title').html("Repair of Medical Equipment");
                $('#request_desc').html("Medical equipment repairers install, maintain, and repair patient care equipment.");
                $('#request_duration').html("Indefinite");

                $('#divForRepairMedEQ').show();
            }


            //REPAIR OFFICE EQUIPMENT
            if(getRequestID == "repairOfficeEquipment")
            {
                $('#request_title , #contact_request_details_title').html("Repair of Office Equipment");
                $('#request_desc').html("This involves inspecting the machinery and making sure it works efficiently, and if necessary, replacing any worn out or faulty parts, or cleaning some equipment regularly with specialist tools.");
                $('#request_duration').html("Indefinite");

                $('#divForRepairOfficeEQ').show();
            }    
         

            //REPAIR ARCHITECTURAL WORKS
            if(getRequestID == "repairArcWorks")
            {
                $('#request_title , #contact_request_details_title').html("Repair of Architectural Works");
                $('#request_desc').html("The restoration of an asset or a component to such a condition that it may be effectively utilised for its designed purpose by the overhaul, reprocessing or replacement of constituent parts or materials that have deteriorated by action of the elements or usage and have not been corrected by maintenance.");
                $('#request_duration').html("Indefinite");

                $('#divForRepairArchWorks').show();
            } 


            //REPAIR CIVIL WORKS
            if(getRequestID == "repairCivilWorks")
            {
                $('#request_title , #contact_request_details_title').html("Repair of Civil Works");
                $('#request_desc').html("The construction or reconstruction of road, sewer, water, bridge and other municipal services.");
                $('#request_duration').html("Indefinite");

                $('#divForRepairCivilWorks').show();
            }  
            

            //REPAIR ELECTRICAL WORKS
            if(getRequestID == "repairElectricWorks")
            {
                $('#request_title , #contact_request_details_title').html("Repair of Electrical Works");
                $('#request_desc').html("Fixing any sort of electrical device should it become out of working order or broken (known as repair, unscheduled, or casualty maintenance).");
                $('#request_duration').html("Indefinite");

                $('#divForRepairElecWorks').show();
            } 
            

            //REPAIR PLUMBING WORKS
            if(getRequestID == "repairPlumbingWorks")
            {
                $('#request_title , #contact_request_details_title').html("Repair of Plumbing Works");
                $('#request_desc').html("Plumbing work means the design, installation, alteration, construction, reconstruction, or repair of plumbing, gas, and drainage systems.");
                $('#request_duration').html("Indefinite");

                $('#divForRepairPlumbingWorks').show();
            }

            //TECHNICAL ASSISTANCE
            if(getRequestID == "techAssist2")
            {
                $('#request_title , #contact_request_details_title').html("Technical Assistance");
                $('#request_desc').html("Support Management and provision of technical support by suitably qualified and experienced engineers.");
                $('#request_duration').html("Indefinite");

                $('#divForRepairTechAssist').show();
            }

            //TRAVEL CONDUCTION
            if(getRequestID == "travelConduct")
            {
                $('#request_title , #contact_request_details_title').html("Travel Conduction");
                $('#request_desc').html("Support Management and provision of technical support by suitably qualified and experienced engineers.");
                $('#request_duration').html("Indefinite");

                $('#divForEfmsTC').show();
            }


            //OTHERS for IMISSS
            if(getRequestID == "othersIMISS")
            {
                $('#request_title , #contact_request_details_title').html("Others (IMISS)");
                $('#divForOthersImissDetails').show();
            }

            //OTHERS for EFMS
            if(getRequestID == "othersEFMS")
            {
                $('#request_title , #contact_request_details_title').html("Others (EFMS)");
                $('#divForOthersEfmsDetails').show();
            }
            
            $('#request_icon , #contact_details_request_icon').removeClass();
            $('#request_icon , #contact_details_request_icon').addClass(getClassIcon);

            
        });//EOF ALL REQUEST CLASS CLICK


    });//EOF DOC READY

</script>