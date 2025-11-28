          <!-- ROW / CONTACT DETAILS 1-->
          <div class="row">
          <p class="lead fw-semibold">Contact Details</p>
          <hr class="border border-2 border-success">
          
              <div class="col-lg-3 mb-4">
                    <div class="form-floating">
                    <select class="form-select select2 locationClassForAll" id="contactDetailsLocationRepairCW"  style="width: 100%;" name="getLocation" required>
                        <option value=""></option>
                    </select>
                    <label for="contactDetailsLocationRepairCW"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Location/Building</label>
                    </div>
              </div>  


              <div class="col-lg-3 mb-4">
                    <div class="form-floating">
                    <select class="form-select select2" id="contactDetailsFloorRepairCW"  style="width: 100%;" name="getFloor" required>
                        <option value=""></option>
                    </select>
                    <label for="contactDetailsFloorRepairCW"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Floor</label>
                    </div>
              </div>  


              <div class="col-lg-3 mb-4">
                    <div class="form-outline form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text"  class="form-control form-control-lg" placeholder="Requested By" name="getRequestBy" required />
                            <label class="form-label" ><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Requested By</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-3 mb-4">
                    <div class="form-outline form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text"  class="form-control form-control-lg" placeholder="Employee No." name="getEmpNo" required />
                            <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Employee No.</label>
                        </div>
                  </div>
              </div>  

          </div>
          <!-- EOF ROW / CONTACT DETAILS 1-->


          <!-- ROW / CONTACT DETAILS 2-->
          <div class="row">
          
              <div class="col-lg-3 mb-4">
                    <div class="form-outline form-floating  w-100">
                        <div class="form-outline  form-floating">
                            <input type="text"  class="form-control form-control-lg" placeholder="Telephone No." name="getTelNo" />
                            <label class="form-label" >Telephone No.</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-3 mb-4">
                    <div class="form-outline form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text"  class="form-control form-control-lg" placeholder="Fax No." name="getFaxNo" />
                            <label class="form-label" >Fax No.</label>
                        </div>
                  </div>
              </div>  

          </div>
          <!-- ROW / CONTACT DETAILS 2-->



          <!-- ROW / REQUEST DETAILS 1-->

          <div class="row mt-4">
          <p class="lead fw-semibold">Request Details</p>
          <hr class="border border-2 border-success">
          
              <div class="col-lg-3 mb-4">
                    <div class="form-outline form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text"  class="form-control form-control-lg" placeholder="Name of Equipment" name="getNameOfEquipment" />
                            <label class="form-label" >Name of Equipment</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-3 mb-4">
                    <div class="form-outline form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text"  class="form-control form-control-lg" placeholder="Serial No." name="getSerialNo" />
                            <label class="form-label" >Serial No.</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-3 mb-4">
                    <div class="form-outline form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text"  class="form-control form-control-lg" placeholder="Model No." name="getModelNo" />
                            <label class="form-label" >Model No.</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-3 mb-4">
                    <div class="form-outline form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text"  class="form-control form-control-lg" placeholder="Property No." name="getPropertyNo" />
                            <label class="form-label" >Property No.</label>
                        </div>
                  </div>
              </div>  

          </div>
          <!-- EOF ROW / REQUEST DETAILS 1-->


          <!-- ROW / REQUEST DETAILS 2-->
          <div class="row">
          
              <div class="col-lg-3 mb-4">
                    <div class="form-outline form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text"  class="form-control form-control-lg" placeholder="Others please specify" name="getOthers" required />
                            <label class="form-label" ><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Others please specify</label>
                        </div>
                  </div>
              </div>  

              <div class="col-lg-9">
                    <div class="form-outline form-floating  w-100">
                      <div class="form-floating ">
                        <textarea class="form-control" placeholder="Description (Detailed information eg. 'I.D for Juan Dela Cruz')" 
                        id="floatingTextarea" style="height: 200px" name="getDescription" required></textarea>
                        <label for="floatingTextarea"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Description (Detailed information eg. 'I.D for Juan Dela Cruz')</label>
                      </div>
                  </div>
              </div>  


          </div>
          <!-- EOF ROW / REQUEST DETAILS 2-->