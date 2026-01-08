<div class="modal fade" id="modalAddDuration" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-success" id="staticBackdropLabel">Add New Duration <i class="bi bi-clock-history"></i></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{ route('officerAddDuration') }}" method="POST" id="addDurationSubmit">
        @csrf
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="text" class="form-control form-control-lg" placeholder="Duration Name" name="durationName" required />
                            <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Duration Name</label>
                        </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="number" class="form-control form-control-lg text-uppercase" name="durationHour" id="durationHour" min="0" required />
                            <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Hour(s)</label>
                        </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="number" class="form-control form-control-lg text-uppercase" name="durationDay" id="durationDay" min="0" required />
                            <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Day(s)</label>
                        </div>
                </div>
            </div>
        </div>

        <p class="text-danger fst-italic" style="font-size: 10px;">Note: Put 0(zero) if not applicable.</p>

        <p class="text-danger fst-italic text-center" style="font-size: 11px; display: none;" id="durationExist">Duration Already Exist</p>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success w-100">Save</button>
      </div>
    </form>

    </div>
  </div>
</div>

<script>

  let durationArray = @json($durationArray);
  let countArray = durationArray.length;

  $('#durationHour').on('change , keyup' ,function(){
      $('#durationExist').slideUp();
  });

  $('#durationDay').on('change , keyup' , function(){
      $('#durationExist').slideUp();
  });

  $('#addDurationSubmit').submit(function(e){

      e.preventDefault();
      let durationHour = $('#durationHour').val();
      let durationDay = $('#durationDay').val();

      let totalHours = parseInt((durationDay * 24)) + parseInt(durationHour);
      let convertToHours;

      if(totalHours == 0){
        convertToHours = totalHours+'0:00:00';
      }
      else{
        convertToHours = totalHours+':00:00';
      }
      console.log(convertToHours);

    for(let i = 0; i < countArray; i++){
      if(durationArray[i] == convertToHours){
        $('#durationExist').slideDown();
        return false;
      }
    }
    $('#addDurationSubmit')[0].submit();
  });

</script>