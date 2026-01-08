<div class="modal fade" id="modalUpdateDuration" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-success" id="staticBackdropLabel">Update Duration <i class="bi bi-clock-history"></i></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{ route('officerUpdateDuration') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-outline form-floating  w-100">
                    <h5 id="categoryNamehere"></h5>
                </div>
            </div>
        </div>

        <hr class="text-success" style="height: 2px;">

        <div class="row mt-2">

            <div class="col-md-6">
                <label for="" class="w-100"> Select Duration
                    <select name="" id="selectDurationClass" class="form-select" required>
                        @foreach($durations as $duration)
                        <option value="{{ $duration->repairID }},,{{ $duration->repairTime }}">
                            {{ $duration->repairVal }} ({{ $duration->repairTime }})</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="col-md-6 mt-4">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-outline mb-2 form-floating  w-100">
                                <div class="form-outline form-floating">
                                    <input type="number" class="form-control form-control-lg text-uppercase" name="durationDay" min="0" id="durationDayFrom" readonly />
                                    <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i>FROM Day(s)</label>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-outline mb-2 form-floating  w-100">
                            <div class="form-outline form-floating">
                                <input type="number" class="form-control form-control-lg text-uppercase" name="durationHour" min="0" id="durationHourFrom" readonly />
                                <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i>FROM Hour(s)</label>
                            </div>
                        </div>
                    </div>



                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-outline mb-2 form-floating  w-100">
                                <div class="form-outline form-floating">
                                    <input type="number" class="form-control form-control-lg text-uppercase" 
                                    name="durationDay" min="0" id="durationDayTo" value="0" readonly />
                                    <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i>TO Day(s)</label>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-outline mb-2 form-floating  w-100">
                            <div class="form-outline form-floating">
                                <input type="number" class="form-control form-control-lg text-uppercase" 
                                name="durationHour" min="0" id="durationHourTo" value="4" readonly />
                                <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i>TO Hour(s)</label>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>

        </div><!--EOF ROW-->
        <p class="text-danger fst-italic text-end mt-2" style="font-size: 11px; display: none;" id="nothingToUpdate">Nothing to Update (Cannot update same value)</p>

      </div>

      <div class="modal-footer">
        <input type="hidden" id="getCategoryID" name="getCategoryID">
        <input type="hidden" name="getDurationID" id="getDurationID" value="1">
        <button type="submit" id="updateDurationSubmit" class="btn btn-success float-right">Confirm Update Duration</button>
      </div>
      
    </form>

    </div>
  </div>
</div>

<script>

$(document).ready(function(){

    $('#updateDurationSubmit').click(function(e){

        e.preventDefault();
        let getFromHoursVal = $('#durationHourFrom').val();
        let getFromDaysVal = $('#durationDayFrom').val();

        let durationHourTo = $('#durationHourTo').val();
        let durationDayTo = $('#durationDayTo').val();

        if((getFromHoursVal == durationHourTo) && (getFromDaysVal == durationDayTo)){

            $('#nothingToUpdate').show();
            return;
        }
        else{
            $('#nothingToUpdate').hide();
        }
        this.form.submit();
    });

    $('.getEditDurationInfo').click(function(){

        $('#nothingToUpdate').hide();
        let array = this.id.split(",,");
        $('#getCategoryID').val(array[0]);
        $('#categoryNamehere').html(array[1]);

        let getDay = 0 , getHours = 0;
        let arrayDuration = array[2].split(":");
        getDurationValue = arrayDuration[0];

        if(getDurationValue >= 24){
            getDay = parseInt(getDurationValue / 24);
            getHours = getDurationValue - (getDay * 24);
        }
        else{
            getHours = parseInt(getDurationValue);
        }
        $('#durationDayFrom').val(getDay);
        $('#durationHourFrom').val(getHours);

    });

    $('#selectDurationClass').change(function(){

        $('#nothingToUpdate').hide();
        let array = $(this).val().split(",,");
        let getDurationID = array[0];
        let getDurationValue = array[1];
        let getDay = 0 , getHours = 0;
        let arrayDuration = getDurationValue.split(":");
        getDurationValue = arrayDuration[0];

        if(getDurationValue >= 24){
            getDay = getDurationValue / 24;
            getDay = parseInt(getDay);

            getHours = getDurationValue - (getDay * 24);
        }
        else{
            getHours = parseInt(getDurationValue);
        }
        //console.log(getHours);

        $('#durationDayTo').val(getDay);
        $('#durationHourTo').val(getHours);
        $('#getDurationID').val(getDurationID);
    });
});// ROF DOC READY

</script>