<!-- Modal EDIT DATE ACCOMPLISHED -->
<div class="modal fade" id="modalEditAccomplished" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-success">Edit Date Accomplished <i class="bi bi-calendar-check"></i></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <div class="container-fluid">

        <div class="row justify-content-center mb-2">

            <label for="">From</label>
            <div class="col-md-6">
                <input type="date" class="form-control" id="dateAccomplishedDate" readonly>
            </div>
            <div class="col-md-6">
                <input type="time" class="form-control" id="dateAccomplishedTime" readonly>
            </div>
        </div><!--EOF ROW-->

        <form action="/edit_accomplished" method="post">
            <input type="hidden" name="refID" id="editAccomplishedGetRefID">
            @csrf
            
            <div class="row justify-content-center mb-5">
                <label for="">To</label>
                <div class="col-md-6">
                    <input type="date" class="form-control" name="newDateAccomplished" required id="newDateAccomplished">
                </div>
                <div class="col-md-6">
                    <input type="time" class="form-control" name="newTimeAccomplished" step="1" required id="newTimeAccomplished">
                </div>
            </div>


        <p class="lead text-end" style="font-size: 14px;">Reference #: <span id="editAccomplishedRefID" class="text-success fw-bold"></span></p>
        </div><!--EOF CONTAINER FLUID-->

            <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success w-100">Update</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

<script>
    $(document).on('click' , '.editAccomplishedBtn' , function(){

        let array = this.id.split(",,");
        let getRefID = array[0];
        let getDateTime = array[1];
        let array2 = getDateTime.split(" ");
        let getDateOnly = array2[0];
        let getTimeOnly = array2[1];

        $('#editAccomplishedRefID').html(getRefID);
        $('#editAccomplishedGetRefID').val(getRefID);
        $('#dateAccomplishedDate').val(getDateOnly);
        $('#dateAccomplishedTime').val(getTimeOnly);

        $('#newDateAccomplished').val('');
        $('#newTimeAccomplished').val('');

        //console.log("DATE: " + getDateOnly + " TIME: " + getTimeOnly);
    });
</script>