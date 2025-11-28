<!-- MODAL UPDATES -->
<div class="modal fade" id="updatesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionTakenTitle"><p class="lead fw-bold">Updates</p></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <p class="lead text-center" id="updatesNoResult" style="display: none;">- No Updates Yet -</p>
            <table class="table table-hover table-sm table-striped shadow table-bordered" style="min-height: 10px;" id="updatesTable">
                <thead class="bg-secondary text-white" style="font-size: 12px;">
                <tr class="">
                    <th>#</th>
                    <th>Updated Details</th>
                    <th>Updated By</th>
                    <th class="">Date & Time</th>
                </tr>
                </thead>

                <tbody id="updatesBody">
                </tbody>
            </table>
      </div>
      <div class="modal-footer"><p class="lead">Reference#: <span id="updatesFooter" class="text-success fw-bold"></span></p></div>
    </div>
  </div>
</div>

<script>
    //$(document).ready(function(){
    
        //$('.getUpdatesVal').click(function(){
        $(document).on('click' , '.getUpdatesVal' , function(){

                let getRefID = this.id;
                let counter = 1;
                $('#updatesBody').empty();
                $('#updatesFooter').html(getRefID);
                //console.log(getRefID);

                    $.ajax({
                        url: "{{ route('getUpdates') }}",
                        type: "POST",
                        data: {
                            refID: getRefID,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            console.log(res);
                            if(JSON.parse(res).length == 0){

                                $('#updatesTable').hide();
                                $('#updatesNoResult').show();

                            }else
                            {
                                $('#updatesTable').show();
                                $('#updatesNoResult').hide();

                                $.each(JSON.parse(res), function(index, item) {
                                    let row =
                                        `<tr>
                                            <td style="font-size: 12px;" class="text-success">${counter}.</td>
                                            <td>${item.updateDetails}</td>
                                            <td>${item.updatedBy}</td>
                                            <td>${item.dateTime}</td>
                                        </tr>`
                                    ;
                                    counter++;
                                    $('#updatesBody').append(row);
                                });
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });//EOF AJAX
        });//EOF ON CLICK

    //});// EOF DOC READY
</script>