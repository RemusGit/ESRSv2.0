
          <!-- ROW / HOMIS DETAILS 1-->
          <div class="row mt-2">
          <p class="lead fw-semibold">HOMIS Encoding Error Details</p>
          <hr class="border border-2 border-success">
          
            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="updateCathomisHospitalNo" class="form-control form-control-lg" placeholder="Hospital No." name="homisHospitalNo" required />
                            <label class="form-label" for="updateCathomisHospitalNo"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Hospital No.</label>
                        </div>
                  </div>
              </div>  


              <div class="col-lg-6">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="updateCathomisEncodedBy" class="form-control form-control-lg" placeholder="Encoded By" name="homisEncodedBy" required />
                            <label class="form-label" for="updateCathomisEncodedBy"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Encoded By</label>
                        </div>
                  </div>
              </div>   

          </div>
          <!-- EOF ROW / HOMIS DETAILS 1-->


          <!-- ROW / HOMIS DETAILS 2 -->
          <div class="row mt-2">

              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="updateCathomisFname" class="form-control form-control-lg" placeholder="Patient First Name" name="homisFname" required />
                            <label class="form-label" for="updateCathomisFname"><i class="bi bi-asterisk text-danger" 
                            style="font-size: 10px;"></i> <span style="font-size: 14px;">Patient First Name</span></label>
                        </div>
                  </div>
              </div>   

              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="homisMName" class="form-control form-control-lg" placeholder="Patient Middle Name" name="homisMName" />
                            <label class="form-label" for="homisMName"><span style="font-size: 14px;">Patient Middle Name</span></label>
                        </div>
                  </div>
              </div>  


            <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline mb-2 form-floating">
                            <input type="text" id="updateCathomisLName" class="form-control form-control-lg" placeholder="Patient Last Name" name="homisLName" required />
                            <label class="form-label" for="updateCathomisLName"><i class="bi bi-asterisk text-danger" 
                            style="font-size: 10px;"></i> <span style="font-size: 14px;">Patient Last Name</span></label>
                        </div>
                  </div>
            </div>  

              <div class="col-lg-3">
                    <div class="form-outline mb-2 form-floating  w-100">
                        <select name="" id="" class="form-control" name="homisSuffix">
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
                        <label class="form-label" for="floatingInput">Patient Suffix</label>
                  </div>
              </div> 

          </div>
          <!-- EOF ROW / HOMIS DETAILS 2 -->



          <!-- ROW / HOMIS DETAILS 3 -->
          <div class="row mt-2">       

            <div class="col-lg-6">
                <div class="form-outline mb-2 form-floating  w-100">
                    <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Encoding Error Details" id="updateCathomisEncodingError"
                    style="height: 200px" name="homisEncodingError" required></textarea>
                    <label for="updateCathomisEncodingError"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Encoding Error Details</label>
                    </div>
                </div>
            </div>      

            <div class="col-lg-6">
                <div class="form-outline mb-2 form-floating  w-100">
                    <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Correct Data Details" id="updateCathomisCorrectDetails"
                    style="height: 200px" name="homisCorrectDetails" required></textarea>
                    <label for="updateCathomisCorrectDetails"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Correct Data Details</label>
                    </div>
                </div>
            </div>  

          </div>
          <!-- EOF ROW / HOMIS DETAILS 3 -->