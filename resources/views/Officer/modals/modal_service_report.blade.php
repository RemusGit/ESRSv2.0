<!-- Modal OFFICER CANCEL REQUEST -->
<div class="modal fade" id="officerServiceReportModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div class="container">

                <form action="/officer_service_report" method="POST">
                @csrf
                <input type="hidden" name="getRefID" id="officerServiceReportRefID">

                <p><span class="fw-bold">Description: </span> <span id="serviceReportDesc"></span></p>
                <p><span class="fw-bold">Property Number: </span> <span id="serviceReportPropNo"></span></p>

                <hr class="text-success" style="height: 2px;">
                <p class="fw-bold text-sm text-success">Equipment Details</p>
                <div class="row mb-2">

                    <div class="col-md-4">
                        <div class="form-outline form-floating  w-100">
                          <div class="form-outline form-floating">
                                <input type="text"  class="form-control form-control-lg" placeholder="Requested By" id="getNameOfEqSR" name="getNameOfEqSR" required />
                                <label class="form-label" ><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Name of Equipment</label>
                          </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-outline form-floating  w-100">
                          <div class="form-outline form-floating">
                                <input type="text"  class="form-control form-control-lg" placeholder="Requested By" id="getModelNoSR" name="getModelNoSR" required />
                                <label class="form-label" ><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Model Number</label>
                          </div>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-outline form-floating  w-100">
                          <div class="form-outline form-floating">
                                <input type="text"  class="form-control form-control-lg" placeholder="Requested By" id="getSerialNoSR" name="getSerialNoSR" required />
                                <label class="form-label" ><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Serial Number</label>
                          </div>
                      </div>
                    </div>

                </div>

                <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Leave a comment here" style="height: 200px" id="getComplaintSR" name="getComplaintSR" required></textarea>
                    <label for="floatingTextarea2"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Complaint/Observation</label>
                </div>


                <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Leave a comment here" style="height: 200px"  id="getRemarksSR" name="getRemarksSR"></textarea>
                    <label for="floatingTextarea2"> Remarks</label>
                </div>


                <hr class="text-success" style="height: 2px;">

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="fw-bold text-sm text-success">Equipment Parts</label>
                    </div>

                    <div class="col-md-2">
                        <input type="number" class="form-control" min="0" max="100" value="0" id="eqPartsNumber">
                    </div>

                    <div class="col-md-3">
                         <a class="btn btn-outline-secondary w-100" id="eqPartsCreate">Create</a>
                    </div>

                    <div class="col-md-2">
                         <a class="btn btn-outline-danger w-100" id="eqPartsClear">Clear</a>
                    </div>
                </div>

                <div class="mb-4" id="eqPartsBody">

                </div>


                <hr class="text-success" style="height: 2px;">
                <p class="fw-bold text-sm text-success">Recommendation</p>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="recommendationSR" id="inlineRadio1" value="1" checked>
                    <label class="form-check-label" for="inlineRadio1">For Outside Repair</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="recommendationSR" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">For Condemn</label>
                </div>

                <div class="form-floating mb-2">
                    <textarea class="form-control" placeholder="Leave a comment here" style="height: 200px" id="getReasonSR" name="getReasonSR" required></textarea>
                    <label for="floatingTextarea2"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Reason</label>
                </div>


                <div class="d-flex flex-row-reverse mt-4">
                    <input type="hidden" name="getPartsCounter" id="getPartsCounter" value="0">
                    <button type="submit" class="btn btn-success">Create Service Report</button>
                </div>
            </form>

      </div>


        </div>
      <div class="modal-footer">
        <p class="lead">Reference#: <span class="text-success fw-bold" id="serviceReportRefID"></span></p>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
        $(document).on('click' , '.officerServiceReportBtn' , function(){

            let array = this.id.split(",,");
            let getRefID = array[0];
            let nameOfEquipment = array[1];
            let serialNo = array[2];
            let modelNo = array[3];
            let propertyNo = array[4];
            let desc = array[5];

            if(nameOfEquipment == null){
              nameOfEquipment = '';
            } 
            if(serialNo == null){
              serialNo = '';
            } 
            if(modelNo == null){
              modelNo = '';
            } 
            if(propertyNo == null || propertyNo == ''){
              propertyNo = 'N/A';
            } 

            $('#serviceReportDesc').html(desc);
            $('#officerServiceReportRefID').val(getRefID);
            $('#getNameOfEqSR').val(nameOfEquipment);
            $('#getSerialNoSR').val(serialNo);
            $('#getModelNoSR').val(modelNo);
            $('#serviceReportPropNo').html(propertyNo);

            $('#serviceReportRefID').html(getRefID);

        });
    });
</script>


<script>

    $('#eqPartsCreate').on('click' , function(){

        let eqPartsCounter = $('#eqPartsNumber').val();
        $('#getPartsCounter').val(eqPartsCounter);

        // SET MAX OF 100 ONLY
        if(eqPartsCounter > 100){
            eqPartsCounter = 100;
            $('#getPartsCounter').val(eqPartsCounter);
            $('#eqPartsNumber').val(eqPartsCounter);
        }

        console.log(eqPartsCounter);
        let counter = 1;
        
        $('#eqPartsBody').empty();

        for (let i = 0; i < eqPartsCounter; i++) {

        let rowIndex = counter + i;

        let eqPartsCreate = $(`
            <div class="row mb-2" data-row="${rowIndex}">
                
                <div class="col-md-1 pt-4"><span class="fw-bold text-success">${rowIndex}.</span></div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input 
                            type="text"
                            class="form-control"
                            id="eqPartName_${rowIndex}"
                            name="eqPartName_${i}"
                            placeholder="Equipment Part Name"
                            required
                        >
                        <label for="eqPartName_${rowIndex}">
                            <i class="bi bi-asterisk text-danger" style="font-size:10px;"></i>
                            Equipment Part Name
                        </label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-floating">
                        <input 
                            type="text"
                            class="form-control"
                            id="eqPartAmount_${rowIndex}"
                            name="eqPartAmount_${i}"
                            placeholder="Amount"
                            required
                        >
                        <label for="eqPartAmount_${rowIndex}">
                            <i class="bi bi-asterisk text-danger" style="font-size:10px;"></i>
                            Amount
                        </label>
                    </div>
                </div>

                <div class="col-md-2 d-flex align-items-center">
                    <div class="form-check">
                        <input 
                            id="operational_${rowIndex}"
                            class="form-check-input"
                            type="radio"
                            name="recommendationSR_${i}"
                            value="1"
                            checked
                        >
                        <label class="form-check-label" style="font-size:10px;" for="operational_${rowIndex}">
                            Operational Parts
                        </label>
                    </div>
                </div>

                <div class="col-md-2 d-flex align-items-center">
                    <div class="form-check">
                        <input 
                            id="needed_${rowIndex}"
                            class="form-check-input"
                            type="radio"
                            name="recommendationSR_${i}"
                            value="2"
                        >
                        <label class="form-check-label" style="font-size:10px;" for="needed_${rowIndex}">
                            Needed Parts
                        </label>
                    </div>
                </div>

            </div>
        `);

        $('#eqPartsBody').append(eqPartsCreate);

        }

    });


    $('#eqPartsClear').on('click' , function(){

        $('#eqPartsNumber').val(0);
        $('#eqPartsBody').empty();
        $('#getPartsCounter').val(0);
    });

</script>