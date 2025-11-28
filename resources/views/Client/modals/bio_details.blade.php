
          <!-- ROW / BIOMETRICS DETAILS 1-->
          <div class="row mt-2">
          <p class="lead fw-semibold">Biometrics Details</p>
          <hr class="border border-2 border-success">
          
              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="updateCatbioFname" class="form-control form-control-lg" placeholder="First Name" name="bioFname" required />
                            <label class="form-label" for="bioFname"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> First Name</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="bioMname" class="form-control form-control-lg" placeholder="Middle Name" name="bioMname" />
                            <label class="form-label" for="bioMname">Middle Name</label>
                        </div>
                  </div>
              </div>  
              

              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="updateCatbioLname" class="form-control form-control-lg" placeholder="Last Name" name="bioLname" required />
                            <label class="form-label" for="bioLname"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Last Name</label>
                        </div>
                  </div>
              </div>                 


              <div class="col-lg-2">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <select name="bioSuffix" id="" class="form-control">
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
          <!-- EOF ROW / BIOMETRICS DETAILS 1-->



          <!-- ROW / BIOMETRICS DETAILS 2 -->
          <div class="row mt-2">
              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="bioCurrentIDNo" class="form-control form-control-lg" placeholder="Current ID Number" name="bioCurrentIDNo" required />
                            <label class="form-label" for="bioCurrentIDNo"><i class="bi bi-asterisk text-danger" style="font-size: 9px;"></i> Current ID No.</label>
                        </div>
                  </div>
              </div>  


            <div class="col-lg-9">
                    <div class="form-floating pb-2">
                    <select class="form-select select2" id="bioEmpStatusSelect" aria-label="Floating label select example"  
                    style="width: 100%;" name="bioEmpStatus" required>
                        <option value=""></option>
                    </select>
                    <label for="bioEmpStatusSelect"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Employment Status</label>
                    </div>
            </div>         


          </div>
          <!-- EOF ROW / BIOMETRICS DETAILS 2 -->

          <!-- ROW / BIOMETRICS DETAILS 3 -->
          <div class="row mt-2">       

            <div class="col-lg-12">
                    <div class="form-floating">
                    <select class="form-select select2" id="bioSectionSelect" 
                    aria-label="Floating label select example"  style="width: 100%;" name="bioSection" required>
                        <option value=""></option>
                    </select>
                    <label for="bioSectionSelect"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Section</label>
                    </div>
              </div>      

          </div>
          <!-- EOF ROW / BIOMETRICS DETAILS 3 -->

          <div class="row mt-2">
              <div class="col-lg-12">
                    <div class="form-floating">
                    <select class="form-select select2" id="bioDesignationSelect" 
                    aria-label="Floating label select example"  style="width: 100%;" name="bioDesignation" required>
                        <option value=""></option>
                    </select>
                    <label for="bioDesignationSelect"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Designation</label>
                    </div>
              </div> 
          </div>
          