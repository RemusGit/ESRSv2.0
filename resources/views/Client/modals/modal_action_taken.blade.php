<!-- MODAL ACTION TAKEN -->
<div class="modal fade" id="actionTakenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionTakenTitle"><p class="lead fw-bold">Action Taken</p></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">

            <div class="clearfix mb-2">
                <div class="float-end">
                    <select name="" id="viewActionTaken" class="form-select">
                        <option value="0">All Actions</option>
                        <option value="1">Deleted Actions</option>
                    </select>
                </div>
            </div>

            <p class="lead text-center" id="actionTakenNoResult" style="display: none;">- No Data -</p>
                <table class="table table-hover table-sm table-striped shadow table-bordered" style="min-height: 10px; display: none;" id="actionTakenTable">

                <thead class="bg-secondary text-white" style="font-size: 12px;" id="actionThead">
                <tr class="">
                    <th>#</th>
                    <th>Action Taken Details</th>
                    <th class="">Date & Time</th>
                </tr>
                </thead>

                <tbody id="actionTakenBody">
                </tbody>
            </table>

        </div>
      <div class="modal-footer"><p class="lead">Reference#: <span id="actionTakenFooter" class="text-success fw-bold"></span></p></div>
    </div>
  </div>
</div>

<script>

function loadActionTaken(getRefID , viewDeleted){

    $('#actionTakenTable').fadeOut(100);

    if(viewDeleted == 0){
        $('#actionThead').html(
            `<tr>
                <th style="max-width: 5px;">#</th>
                <th>Action Taken Details</th>
                <th>Datetime</th>
            </tr>`
        );
    }
    else{
        $('#actionThead').html(
            `<tr>
                <th style="max-width: 5px;">#</th>
                <th>Action Taken Details</th>
                <th>Datetime Deleted</th>
                <th>Deleted By</th>
            </tr>`
        );
    }

    $.ajax({
        url: "{{ route('getAction') }}",
        type: "POST",
        data: {
            refID: getRefID,
            viewDeleted: viewDeleted,
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            $('#actionTakenBody').empty();
            //console.log(JSON.parse(res).length);
            if(JSON.parse(res).length == 0){
                
                //console.log('EMPTYYYYY');
                $('#actionTakenTable').hide();
                $('#actionTakenNoResult').show();
            }
            else{
            
            //$('#actionTakenTable').show();
            $('#actionTakenNoResult').hide();

            $.each(JSON.parse(res), function(index, item) {

                if(viewDeleted == 0){
                    let row =
                    `<tr>
                        <td style="font-size: 12px;" class="text-success">${index+1}.</td>
                        <td>${item.action_taken}</td>
                        <td>${item.action_datetime}</td>
                    </tr>`;
                    $('#actionTakenBody').append(row);
                }
                else{
                    let row =
                    `<tr>
                        <td style="font-size: 12px;" class="text-success">${index+1}.</td>
                        <td class="text-danger">${item.action_taken}</td>
                        <td class="text-danger">${item.deleted_datetime}</td>
                        <td class="text-danger">${item.deleted_by}</td>
                    </tr>`;
                    $('#actionTakenBody').append(row);
                }

            });

             $('#actionTakenTable').fadeIn(700);

            }//EOF res NULL

        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });//EOF AJAX
}

//$('.getActionTakenVal').click(function(){
$(document).on('click' , '.getActionTakenVal' , function(){

    $('#viewActionTaken').val(0);

    let getRefID = this.id;
    let counter = 1;
    $('#actionTakenBody').empty();
    $('#actionTakenFooter').html(getRefID);

    loadActionTaken(getRefID , 0);
});

$(document).on('change' , '#viewActionTaken' , function(){

    let getVal = $(this).val();
    let getRefID = $('#actionTakenFooter').html();
    loadActionTaken(getRefID , getVal);

});// EOF ONCHANGE DELETED ACTIONS

    //});
</script>