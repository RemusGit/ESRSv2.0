<!-- Modal OFFICER CANCEL REQUEST -->
<div class="modal fade" id="officerCancelRequest" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <form action="/officer_cancel_request" method="POST">
                @csrf
                <input type="hidden" name="officerFullName" value="{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}">
                <input type="hidden" name="categoryVal" value="" id="officerCancelCategoryVal">
                <input type="hidden" name="getRefID" id="officerCancelReqRefId">
                <div class="form-floating">
                    <textarea class="form-control" name="cancelReason" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px" required></textarea>
                    <label for="floatingTextarea2">Please provide reason of Cancellation</label>
                </div>

                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-danger btn-sm">Confirm Cancel Request</button>
                </div>
            </form>

        </div>
      <div class="modal-footer">
        <p class="lead">Reference#: <span class="text-success fw-bold" id="cancelReqRefID"></span></p>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
        $('.officerCancelReqBtn').click(function(){

            let array = this.id.split(",,");
            let getRefID = array[0];
            let categoryVal = array[1];

            $('#officerCancelCategoryVal').val(categoryVal);
            $('#officerCancelReqRefId').val(getRefID);
            $('#cancelReqRefID').html(getRefID);

        });
    });
</script>