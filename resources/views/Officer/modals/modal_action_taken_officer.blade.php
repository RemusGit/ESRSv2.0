<!-- MODAL ACTION TAKEN -->
<div class="modal fade" id="officerActionTakenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionTakenTitle">Action Taken</h5>
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

                <div class="row">
                    <p class="lead text-center" id="actionTakenNoResult" style="display: none;">- No Data -</p>
                </div>
                

                <table class="table table-hover table-sm table-striped shadow table-bordered" style="min-height: 10px; display: none;" id="actionTakenTable">
                <thead class="bg-secondary text-white" style="font-size: 12px;" id="actionThead">
                <tr class="">
                    <th style="max-width: 5px;">#</th>
                    <th>Action Taken Details</th>
                    <th>Datetime</th>
                    <th class="text-center">Delete</th>
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
    //$('#actionTakenTable').fadeOut(100);
    $('#actionTakenTable').slideUp(100);
    
    if(viewDeleted == 0){
        $('#actionThead').html(
            `<tr>
                <th style="max-width: 5px;">#</th>
                <th>Action Taken Details</th>
                <th>Datetime</th>
                <th class="text-center">Delete</th>
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
            refID: getRefID ,
            viewDeleted: viewDeleted ,
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            
            //console.log(JSON.parse(res).length);
            if(JSON.parse(res).length == 0){
                
                //console.log('EMPTYYYYY');
                $('#actionTakenTable').hide();
                $('#actionTakenNoResult').show();
                //$('#viewActionTaken').hide();
                
            }
            else{
            
            //$('#viewActionTaken').show();
            $('#actionTakenNoResult').hide();
            $('#actionTakenBody').empty();

            $.each(JSON.parse(res), function(index, item) {

                if(viewDeleted == 0){
                    let row =
                    `<tr>
                        <td style="font-size: 12px;" class="text-success">${index+1}.</td>
                        <td>${item.action_taken}</td>
                        <td>${item.action_datetime}</td>
                        <td style="cursor: pointer;" class="text-center text-danger 
                        actionTakenDelete" id="${item.action_id},,${item.action_taken}"><i class="bi bi-x-lg"></i></td>
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

            //$('#actionTakenTable').fadeIn(700);
            $('#actionTakenTable').slideDown(500);

            }//EOF res NULL

        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });//EOF AJAX
    
}//EOF LOAD ACTION TAKEN


////////////////////////////////////////////////////////////////// ON CLICK VIEW ACTION
$(document).on('click' , '.officerActionTaken' , function(){

    let getRefID = this.id;
    $('#actionTakenFooter').html(getRefID);
    $('#viewActionTaken').val(0);
    $('#actionTakenTable').hide();
    loadActionTaken(getRefID , 0);
    
});// EOF officerActionTaken ON CLICK

////////////////////////////////////////////////////////////////// ONCHANGE SHOW/HIDE DELETED ACTIONS
$(document).on('change' , '#viewActionTaken' , function(){

    let getVal = $(this).val();

    let getRefID = $('#actionTakenFooter').html();
    loadActionTaken(getRefID , getVal);
});// EOF ONCHANGE DELETED ACTIONS


////////////////////////////////////////////////////////////////// ONCLICK DELETE ACTION CONFIRMATION
$(document).on('click' , '.actionTakenDelete' , function(){

    let array = this.id.split(",,");
    let getActionID = array[0];
    let actionTakenVal = array[1];

    let getRefID = $('#actionTakenFooter').html();

    $.confirm({
    icon: '',
    title: 'Delete Action Taken',
    content: 'Confirm Delete <br><span class="text-danger">' + actionTakenVal + '</span>',
    type: 'red',
    draggable: true,
    buttons: {
        YES: {
            text: 'YES',
            btnClass: 'btn-danger',
            keys: ['enter', 'shift'],
            action: function(){
                $.ajax({
                    url: "{{ route('ajaxDeleteActionTaken') }}", 
                    type: 'POST', 
                    data: {
                        actionID: getActionID ,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        //console.log(res);
                        // REFRESH TABLE
                        loadActionTaken(getRefID , 0);
                    },
                    error: function(error) {
                        console.error(error);
                }
                });//EOF AJAX
            }
        },
        NO: function () {
        }
    }
    });

});//EOF ONCLICK DELETE ACTION CONFIRMATION

</script>