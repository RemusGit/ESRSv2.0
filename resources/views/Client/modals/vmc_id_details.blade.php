
          <!-- ROW / VMC ID DETAILS 1-->
          <div class="row mt-2">
          <p class="lead fw-semibold">Identification Card Details</p>
          <hr class="border border-2 border-success">
          
          <p class="lead text-success fw-bold" style="font-size: 12px;">Employment Details</p>
              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="floatingInput" class="form-control form-control-lg" placeholder="Employee No." name="idrequest_empno" />
                            <label class="form-label" for="floatingInput">Employee No.</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-9">
                    <div class="form-floating pb-2">
                        <select class="form-select select2" id="vmcIdCardEmpStatus" aria-label="Floating label select example"  
                        style="width: 100%;" name="employstatus_id" required>
                            <option value=""></option>
                        </select>
                        <label for="vmcIdCardEmpStatus"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Employment Status</label>
                    </div>
              </div>                 

          </div>
          <!-- EOF ROW / VMC ID DETAILS 1-->


          <div class="row mt-2">

              <div class="col-lg-12">
                    <div class="form-floating pb-2">
                        <select class="form-select select2" id="vmcIdCardPosition" aria-label="Floating label select example"  
                        style="width: 100%;" name="position_id" required>
                            <option value=""></option>
                        </select>
                        <label for="vmcIdCardPosition"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Position</label>
                    </div>
              </div>  
          </div>


        <!-- ROW / VMC ID DETAILS 2 -->
          <div class="row mt-2">
          
            <p class="lead text-success fw-bold" style="font-size: 12px;">Personal Details</p>
              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_fname" class="form-control form-control-lg" 
                            placeholder="First Name" name="idrequest_fname" required />
                            <label class="form-label" for="idrequest_fname"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> First Name</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_mname" 
                            class="form-control form-control-lg" placeholder="Middle Name" name="idrequest_mname" />
                            <label class="form-label" for="idrequest_mname">Middle Name</label>
                        </div>
                  </div>
              </div>  
              

              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="vmcIdCardLastname" class="form-control form-control-lg" 
                            placeholder="Last Name" name="idrequest_lname" required />
                            <label class="form-label" for="vmcIdCardLastname"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Last Name</label>
                        </div>
                  </div>
              </div>      
              
              
                <div class="col-xl-3 col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <select name="idrequest_suffix" class="form-control">
                            <option value=""></option>
                            <option value="SR">Sr.</option>
                            <option value="JR">Jr.</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                            <option value="X">X</option>
                        </select>
                        <label class="form-label" for="floatingInput">Suffix</label>
                  </div>
              </div> 

          </div>
          <!-- EOF ROW / VMC ID DETAILS 2-->

        <div class="row">

            <div class="col-xl-3 col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="date" id="idrequest_dob" class="form-control form-control-lg" 
                            placeholder="Date of Birth" name="idrequest_dob" required />
                            <label class="form-label" for="idrequest_dob"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Date of Birth</label>
                        </div>
                  </div>
            </div>

        </div>

          <!-- ROW / VMC ID DETAILS 3 -->
          <div class="row mt-2"> 

          <p class="lead text-success fw-bold" style="font-size: 12px;">Address</p>
            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_street" class="form-control form-control-lg"
                            placeholder="Street" name="idrequest_street" required/>
                            <label class="form-label" for="idrequest_street"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Street</label>
                        </div>
                  </div>
            </div>  


            <div class="col-lg-6">
                    <div class="form-floating pb-2">
                        <select class="form-select select2" id="vmcIdCardCity" aria-label="Floating label select example"  
                        style="width: 100%;" name="ctycode" required>
                        </select>
                        <label for="vmcIdCardCity"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> City</label>
                    </div>
            </div> 


            <div class="col-lg-3">
                    <div class="form-floating pb-2">
                        <select class="form-select select2" id="vmcIdCardBarangay" aria-label="Floating label select example"  
                        style="width: 100%;" name="bgycode" required>
                        </select>
                        <label for="vmcIdCardBarangay"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Barangay</label>
                    </div>
            </div>         


          </div>
          <!-- EOF ROW / VMC ID DETAILS 3 -->



          <!-- ROW / VMC ID DETAILS 4 -->
          <div class="row mt-2">       

            <p class="lead text-success fw-bold" style="font-size: 12px;">Government ID Details</p>
            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_tinno" class="form-control form-control-lg" 
                            placeholder="TIN No." name="idrequest_tinno" required />
                            <label class="form-label" for="idrequest_tinno"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> TIN No.</label>
                        </div>
                  </div>
            </div>      

            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_gsis" class="form-control form-control-lg" 
                            placeholder="GSIS No." name="idrequest_gsis" required />
                            <label class="form-label" for="idrequest_gsis"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> GSIS No.</label>
                        </div>
                  </div>
            </div>     

          </div>
          <!-- EOF ROW / VMC ID DETAILS 4 -->

          
          <!-- ROW / VMC ID DETAILS 5-->
          <div class="row mt-2">       

            <p class="lead text-success fw-bold" style="font-size: 12px;">Physical Details</p>
            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_blood" class="form-control form-control-lg" 
                            placeholder="Blood Type" name="idrequest_blood" required />
                            <label class="form-label" for="idrequest_blood"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Blood Type</label>
                        </div>
                  </div>
            </div>      


            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_height" class="form-control form-control-lg" 
                            placeholder="Height" name="idrequest_height" required />
                            <label class="form-label" for="idrequest_height"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Height</label>
                        </div>
                  </div>
            </div>     


            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_weight" class="form-control form-control-lg" 
                            placeholder="Weight (in kg.)"  name="idrequest_weight" required />
                            <label class="form-label" for="idrequest_weight"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Weight (in kg.)</label>
                        </div>
                  </div>
            </div>  

          </div>
          <!-- EOF ROW / VMC ID DETAILS 5 -->


          <!-- ROW / VMC ID DETAILS 6-->
          <div class="row mt-2">       

            <p class="lead text-success fw-bold" style="font-size: 12px;">In Case of Emergency Details</p>
            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_emerfname" class="form-control form-control-lg" 
                            placeholder="First Name"  name="idrequest_emerfname" required />
                            <label class="form-label" for="idrequest_emerfname"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> First Name</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="floatingInput" class="form-control form-control-lg" 
                            placeholder="Middle Name" name="idrequest_emermname" />
                            <label class="form-label" for="floatingInput"> Middle Name</label>
                        </div>
                  </div>
              </div>  
              

              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_emerlname" class="form-control form-control-lg" 
                            placeholder="Last Name" name="idrequest_emerlname" required />
                            <label class="form-label" for="idrequest_emerlname"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Last Name</label>
                        </div>
                  </div>
              </div>                 

              <div class="col-xl-3 col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <select id="" class="form-control" name="idrequest_emersuffix">
                            <option value=""></option>
                            <option value="SR">Sr.</option>
                            <option value="JR">Jr.</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                            <option value="X">X</option>
                        </select>
                        <label class="form-label" for="floatingInput">Suffix</label>
                  </div>
              </div> 

          </div>
          <!-- EOF ROW / VMC ID DETAILS 6 -->

          <div class="row mt-2">

            <div class="col-xl-3 col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_emercontactno" class="form-control form-control-lg" 
                            placeholder="Contact No." name="idrequest_emercontactno" required />
                            <label class="form-label" for="idrequest_emercontactno"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Contact No.</label>
                        </div>
                  </div>
            </div>
          </div>


          <!-- ROW / VMC ID DETAILS 3 -->
          <div class="row mt-2" id="emergencyAddress"> 
            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="idrequest_emerstreet" class="form-control form-control-lg"
                            placeholder="Street" name="idrequest_emerstreet" required/>
                            <label class="form-label" for="idrequest_emerstreet"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Street</label>
                        </div>
                  </div>
            </div>  


            <div class="col-lg-6">
                    <div class="form-floating pb-2">
                        <select class="form-select select2" id="vmcIdCardCityEmergency" aria-label="Floating label select example"  
                        style="width: 100%;" name="emerctycode" required>
                        </select>
                        <label for="vmcIdCardCityEmergency"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> City</label>
                    </div>
            </div> 


            <div class="col-lg-3">
                    <div class="form-floating pb-2">
                        <select class="form-select select2" id="vmcIdCardBarangayEmergency" aria-label="Floating label select example"  
                        style="width: 100%;" name="emerbgycode" required>
                        </select>
                        <label for="vmcIdCardBarangayEmergency"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Barangay</label>
                    </div>
            </div>      
        

          </div>
          <!-- EOF ROW / VMC ID DETAILS 3 -->


        <div class="clearfix" style="font-size: 14px;">
            <div class="float-start form-check">
                <label class="form-check-label" for="sameAsAboveAddress">
                Same as Above Address
                </label>
                <input class="form-check-input" type="checkbox" id="sameAsAboveAddress" name="sameAsAboveAddress">
            </div>
        </div>


          <!-- ROW / VMC ID DETAILS 7 -->
          <div class="row mt-2" id="picSigHide">       
            
            <p class="lead text-success fw-bold" style="font-size: 12px;">Upload Picture and Signature</p>    
            <div class="col-lg-6">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="file" id="idrequest_picture" class="form-control" 
                            placeholder="Picture (max 1mb) / Must be formal" name="idrequest_picture" required />
                            <label class="form-label" for="idrequest_picture"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Picture (max 1mb) / Must be formal</label>
                        </div>
                  </div>
            </div>      

            <div class="col-lg-6">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="file" id="idrequest_signature" class="form-control" 
                            placeholder="Signature (max 1mb)" name="idrequest_signature" required />
                            <label class="form-label" for="idrequest_signature"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Signature (max 1mb)</label>
                        </div>
                  </div>
            </div>     

          </div>
          <!-- EOF ROW / VMC ID DETAILS 7 -->


        <div class="clearfix" style="font-size: 14px;">
            <div class="float-start form-check">
                <label class="form-check-label" for="picSigBypass">
                Already Uploaded Picture & Signature
                </label>
                <span class="text-danger fst-italic" style="font-size: 9px;">(Note: We use your Firstname and Lastname as Reference.)</span>
                <input class="form-check-input" type="checkbox" id="picSigBypass" name="picSigBypass">
            </div>
        </div>


<script>

    $(document).ready(function(){


        $('#picSigBypass').click(function(){

            var checkVal = $('#picSigBypass:checked').val();

            if(checkVal == 'on'){

                $('#picSigHide').slideUp();
                $('#idrequest_picture').removeAttr("required");
                $('#idrequest_signature').removeAttr("required");
            }
            else{
                $('#picSigHide').slideDown();
                $('#idrequest_picture').attr("required" , "required");
                $('#idrequest_signature').attr("required" , "required");
            }
        });

        $('#sameAsAboveAddress').click(function(){

            let getStreet1 = $('#idrequest_street').val();
            let getCity1 = $('#vmcIdCardCity').val();
            let getBrgy1 = $('#vmcIdCardBarangay').val();

            var checkVal = $('#sameAsAboveAddress:checked').val();
            //console.log(checkVal);
            //console.log('City:' + getCity1 + ' / BRGY:' + getBrgy1);

            if(checkVal == 'on'){
                $('#emergencyAddress').slideUp();
                $('#idrequest_emerstreet').removeAttr("required");
                $('#vmcIdCardCityEmergency').removeAttr("required");
                $('#vmcIdCardBarangayEmergency').removeAttr("required");
            }else{
                $('#emergencyAddress').slideDown();
                $('#idrequest_emerstreet').attr("required","required");
                $('#vmcIdCardCityEmergency').attr("required","required");
                $('#vmcIdCardBarangayEmergency').attr("required","required");
            }
            /*
            if(getStreet1 != '' && checkVal == 'on'){
                $('#idrequest_emerstreet').val(getStreet1);
            }
            if(getCity1 != '' && checkVal == 'on'){
                $('#vmcIdCardCityEmergency').val(getCity1).trigger('change');
            }
            if(getCity1 != '' && getBrgy1 != '' && checkVal == 'on'){
                $('#vmcIdCardBarangayEmergency').val(getBrgy1).trigger('change');
            }
                */
        });
    });

</script>