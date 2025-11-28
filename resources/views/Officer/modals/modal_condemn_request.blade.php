<!-- Modal OFFICER CANCEL REQUEST -->
<div class="modal fade" id="officerCondemnModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Condemn Equipment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div class="container">

                <form action="/officer_condemn_request" method="POST">
                @csrf
                <input type="hidden" name="getRefID" id="officerCondemnId">

                <div class="row mb-2">

                    <div class="col-md-6">
                        <div class="form-outline form-floating  w-100">
                          <div class="form-outline form-floating">
                                <input type="text"  class="form-control form-control-lg" placeholder="Requested By" id="getNameOfEq" name="getNameOfEq" required />
                                <label class="form-label" ><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Name of Equipment</label>
                          </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-outline form-floating  w-100">
                          <div class="form-outline form-floating">
                                <input type="text"  class="form-control form-control-lg" placeholder="Requested By" id="getSerialNo" name="getSerialNo" required />
                                <label class="form-label" ><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Serial No.</label>
                          </div>
                      </div>
                    </div>
                </div>


                <div class="row mb-2">
                    <div class="col-md-6">
                      <div class="form-outline form-floating  w-100">
                          <div class="form-outline form-floating">
                                <input type="text"  class="form-control form-control-lg" placeholder="Requested By" id="getModelNo" name="getModelNo" required />
                                <label class="form-label" ><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Model No.</label>
                          </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-outline form-floating  w-100">
                          <div class="form-outline form-floating">
                                <input type="text"  class="form-control form-control-lg" placeholder="Requested By" id="getPropertyNo" name="getPropertyNo" required />
                                <label class="form-label" ><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Property No.</label>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Leave a comment here" style="height: 200px" id="getFindings" name="getFindings" required></textarea>
                    <label for="floatingTextarea2"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Findings</label>
                </div>


                <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Leave a comment here" style="height: 200px"  id="getRecommendation" name="getRecommendation" required></textarea>
                    <label for="floatingTextarea2"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Recommendation</label>
                </div>

                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-success">Condemn</button>
                </div>
            </form>

      </div>


        </div>
      <div class="modal-footer">
        <p class="lead">Reference#: <span class="text-success fw-bold" id="condemnActionRefId"></span></p>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
        $('.officerCondemnRequestBtn').click(function(){

            let array = this.id.split(",,");
            let getRefID = array[0];
            let nameOfEquipment = array[1];
            let serialNo = array[2];
            let modelNo = array[3];
            let propertyNo = array[4];

            $('#officerCondemnId').val(getRefID);
            $('#getNameOfEq').val(nameOfEquipment);
            $('#getSerialNo').val(serialNo);
            $('#getModelNo').val(modelNo);
            $('#getPropertyNo').val(propertyNo);

            $('#condemnActionRefId').html(getRefID);

        });
    });
</script>