<!-- Modal OFFICER CANCEL REQUEST -->
<div class="modal fade" id="officerNewActionModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <form action="/officer_add_action" method="POST">
                @csrf
                <input type="hidden" name="getRefID" id="officerAddActionId">
                <div class="form-floating">
                    <textarea class="form-control" name="getAction" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px" required></textarea>
                    <label for="floatingTextarea2">Provide Action</label>
                </div>

                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-success btn-sm">Submit Action</button>
                </div>
            </form>

        </div>
      <div class="modal-footer">
        <p class="lead">Reference#: <span class="text-success fw-bold" id="addActionRefId"></span></p>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
        $('.officerAddActionBtn').click(function(){

            let getRefID = this.id;

            $('#officerAddActionId').val(getRefID);
            $('#addActionRefId').html(getRefID);

        });
    });
</script>