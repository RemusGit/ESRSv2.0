<div class="modal fade" id="modalAddDuration" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-success" id="staticBackdropLabel">Add New Duration <i class="bi bi-clock-history"></i></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{ route('officerAddDuration') }}" method="POST">
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
                            <input type="number" class="form-control form-control-lg text-uppercase" name="durationHour" min="0" required />
                            <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Hour(s)</label>
                        </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="form-outline mb-2 form-floating  w-100">
                        <div class="form-outline form-floating">
                            <input type="number" class="form-control form-control-lg text-uppercase" name="durationDay" min="0" required />
                            <label class="form-label"><i class="bi bi-asterisk text-danger" style="font-size: 10px;"></i> Day(s)</label>
                        </div>
                </div>
            </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success w-100">Save</button>
      </div>
    </form>

    </div>
  </div>
</div>