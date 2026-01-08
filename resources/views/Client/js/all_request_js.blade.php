<script>

    $(document).ready(function(){

        $('.all_request_class').click(function(){

            var getClassIcon = $(this).find('i').attr('class');

            let array = this.id.split(",,");
            let getRequestID = array[0];
            let mainCategory = array[1];
            let categoryVal = array[2];
            let durationVal = array[3];

            let categoryID = "";
            if(getRequestID == 'EFMS'){
                categoryID = array[4];
            }

            //console.log(getRequestID);

            let splitDuration = durationVal.split(":");
            let getHours = splitDuration[0];
            let getDays = 0;

            if(getHours >= 24){
                getDays = parseInt(getHours / 24);
                getHours = parseInt(getHours - (getDays * 24));
            }
            let convertedDuration = "Indefinite";

            if(getDays > 0){
                if(getHours > 0){
                    convertedDuration = getDays + ' Day(s) ' + getHours + ' Hour(s)'; 
                }
                else{
                    convertedDuration = getDays + ' Day(s)'; 
                }
            }
            else if(getHours > 0){
                convertedDuration = getHours + ' Hour(s)'; 
            }

            $('.allDivDetails').hide();

            //BIOMETRICS
            if(getRequestID == "12")
            {
               
                $('#request_title , #contact_request_details_title').html("Biometrics Enrollment");
                $('#request_desc').html("Biometric Enrollment means the process of collecting biometric data samples from a person and subsequently storing the data in our databases.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }
                


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

                $('#divForBioDetails').show();
            }

            //HOMIS ENCODE ERROR
            if(getRequestID == "4")
            {
                $('#request_title , #contact_request_details_title').html("HOMIS Encoding Error");
                $('#request_desc').html("HOMIS Encoding Error is an amongst the most typical data entry problems is inputting the incorrect data.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForHomisDetails').show();
            }            

            //NETWORK INSTALLATION
            if(getRequestID == "6")
            {
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

                $('#request_title , #contact_request_details_title').html("Network Installation / Internet Connection");
                $('#request_desc').html("Computer networking refers to connected computing devices such as laptops, desktops, servers, smartphones, and tablets.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForNetworkInstallDetails').show();
            }

            //REPAIR IT EQUIPMENT
            if(getRequestID == "1")
            {
                $('#request_title , #contact_request_details_title').html("Repair of I.T Equipment");
                $('#request_desc').html("Computer repair is the process of identifying, troubleshooting and resolving problems and issues in a faulty computer.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForRepairItEquipmentDetails').show();
            }

            //SYSTEM ENHANCE
            if(getRequestID == "3")
            {

                $('#systemEnhanceSelectSystemID').empty();
                $('#systemEnhanceSelectSystemID').append('<option></option>');

                // LOAD ALL CONNECTION FROM connectiontype_tab
                $.ajax({
                url: "{{ route('loadVmcSystem') }}", 
                type: 'GET', 
                success: function(res) {
                    //console.log(res);
                    
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
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForSystemEnhanceDetails').show();
            }

            //TECHNICAL ASSIST
            if(getRequestID == "8")
            {
                $('#request_title , #contact_request_details_title').html("Technical Assistance");
                $('#request_desc').html("Providing technical support such as resolving technical issues in a timely manner using available resources.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForTechAssistDetails').show();
            }

            //TRAINING ORIENTATION
            if(getRequestID == "10")
            {
                $('#request_title , #contact_request_details_title').html("Training - Orientation / Computer Literacy");
                $('#request_desc').html("The ability to effectively use computer technology to solve problems and efficiently meet personal and professional needs.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForTrainingOrientationDetails').show();
            }


            //USER ACC MANAGEMENT
            if(getRequestID == "11")
            {
                $('#request_title , #contact_request_details_title').html("User Account Management");
                $('#request_desc').html("User Management role is authorized to create and delete user accounts, change user passwords, change roles assigned to other users.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForUserAccMngtDetails').show();
            }

            //VMC ID
            if(getRequestID == "13")
            {
                $('#request_title , #contact_request_details_title').html("VMC ID Card Preparation");
                $('#request_desc').html("I.D cards are your ultimate source of identification for easy introductions, whether you’re a contractual or permanent employee.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

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
            if(getRequestID == "7")
            {
                $('#request_title , #contact_request_details_title').html("Website Uploads");
                $('#request_desc').html("Website upload is the process of putting web pages, images and files onto a web server.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForWebUploadsDetails').show();
            }
            
            //ZOOM LINK
            if(getRequestID == "30")
            {
                $('#request_title , #contact_request_details_title').html("Zoom Link");
                $('#request_desc').html("Zoom meeting links are used to invite prospective participants to a meeting. These links may contain information like the meeting ID, password, and web address.");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForZoomLinkDetails').show();
            }

            //OTHERS for IMISSS
            if(getRequestID == "33")
            {
                $('#request_title , #contact_request_details_title').html("Others");
                $('#request_desc').html("Other request for IMISS (Integrated Management Information System Section)");
                
                if(convertedDuration == "Indefinite"){
                    $('#request_duration').html("Indefinite");
                }else{
                    $('#request_duration').html("Maximum of " + convertedDuration);
                }

                $('#divForOthersImissDetails').show();
            }

            //OTHERS for EFMS
            if(getRequestID == "EFMS")
            {
                $('#request_title , #contact_request_details_title').html(categoryVal);

                if(convertedDuration == "Indefinite"){
                    $('#categoryDuration').html("Duration: Indefinite");
                }else{
                    $('#categoryDuration').html('Duration: Maximum of '+convertedDuration);
                }

                $('#addRequestCategoryID').val(categoryID);
                $('#divAllEfms').show();
            }
            
            $('#request_icon , #contact_details_request_icon').removeClass();
            $('#request_icon , #contact_details_request_icon').addClass(getClassIcon);

            
        });//EOF ALL REQUEST CLASS CLICK


    });//EOF DOC READY

</script>