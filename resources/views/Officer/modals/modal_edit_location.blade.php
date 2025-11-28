<div class="modal fade" id="modalEditLoc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-success" id="staticBackdropLabel">Update Location Info <i class="bi bi-pencil-square"></i></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{ route('officerUpdateLoc') }}" method="POST">
        @csrf
        
        <input type="hidden" name="getLocID" id="editLocID">

        <div class="row">
            <div class="col-md-12">
                <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text" class="form-control form-control-lg" placeholder="Location Name" name="locationName" id="locationName" required />
                            <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Location Name</label>
                        </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text" class="form-control form-control-lg text-uppercase" placeholder="Location Abbreviation" name="locAbbr" id="locAbbr" required />
                            <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Location Abbreviation</label>
                        </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="number" class="form-control form-control-lg" placeholder="Number of Floors" name="floorNo" id="floorNo" required />
                            <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Number of Floors</label>
                        </div>
                </div>
            </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success w-100">Update</button>
      </div>
    </form>

    </div>
  </div>
</div>


<script>

    $(document).ready(function(){

        $('.getLocInfo').click(function(){

            let array = this.id.split(",,");
            let locID = array[0];
            let locVal = array[1];
            let locAbbre = array[2];
            let locTotalFloor = array[3];

            $('#editLocID').val(locID);
            $('#locationName').val(locVal);
            $('#locAbbr').val(locAbbre);
            $('#floorNo').val(locTotalFloor);


            
        });

    });

</script>