
<!--ALL REQUEST MODAL-->
<div class="modal fade" id="all_request_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-success" id="exampleModalLabel"><span id="request_title"></span></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="d-flex justify-content-center">
            <i class="bi bi-fingerprint" style="font-size: 50px;" id="request_icon"></i>
        </div>

        <p id="request_desc"></p>
        <p class="lead">Duration: <span id="request_duration"></span></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" 
        data-bs-toggle="modal" data-bs-target="#createServiceRequestModal">Proceed</button>
      </div>
    </div>
  </div>
</div>
<!--ALL REQUEST MODAL-->