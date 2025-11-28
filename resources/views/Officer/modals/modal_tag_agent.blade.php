<!-- Modal DISTRIBUTE-->
<div class="modal fade" data-bs-backdrop="static" id="tagAgentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tag Agent</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="table table-responsive">
                <table class="table table-condense table-hover table-sm table-striped shadow" style="font-size: 12px;">
                    <thead>
                        <tr class="bg-success text-white">
                            <th>#</th>
                            <th>Employee No.</th>
                            <th>Action Officer</th>
                            <th>User Type</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tagAgentTbody">
                    </tbody>
                </table>
            </div>
      </div>
      <div class="modal-footer">
        <p class="lead">Reference#: <span id="tagAgentRefID" class="lead text-success fw-bold"></span></p></div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

    //--------------------------------------------------- ONCLICK TAG AGENTS ---------------------------
    //$('.distributeRequestGetRefID').click(function(){
    $(document).on('click' , '.tagAgentButtonInTable' , function(){

        let array = this.id.split(",,");
        let getRefID = array[0];
        let getCategoryVal = array[1];
        let getAgentID = {{session('agentunit_id')}};

        $('#tagAgentRefID').html(getRefID);
        loadTagAgents(getRefID , getAgentID);

    });// EOF TAG AGENTS ON CLICK

    //--------------------------------------------------- ONCLICK CONFIRM TAG AGENT ---------------------------
    $(document).on('click', '.tagAgentFormButton', function(e) {

        e.preventDefault();
        let array = this.id.split(",,");

        //console.log(array);
        
        let getStaffID = array[0];
        let getStaffName = array[1];
        let getRefID = array[2];
        let tagValue = array[3];
        let getAgentID = {{session('agentunit_id')}};

        let tagTitle = "Confirm Tag Agent";
        let tagContent = "Tag this request to ";
        if(tagValue == 1){
            tagTitle = "Confirm Untag Agent";
            tagContent = "Are you sure you want to Untag ";
        }

        $.confirm({
            icon: '',
            title: tagTitle,
            content: tagContent + `<span class="text-success fw-bold">` + getStaffName + `</span>` + '?',
            type: 'dark',
            draggable: true,
            buttons: {
                YES: {
                    text: 'YES',
                    btnClass: 'btn-success',
                    keys: ['enter', 'shift'],
                    action: function(){
                        $('#tagAgentTbody').fadeOut();
                        $.ajax({
                            url: "{{ route('ajaxTagAgentConfirm') }}", 
                            type: 'POST', 
                            data: {
                                refID: getRefID,
                                tagAgentID: getStaffID,
                                tagValue: tagValue,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                    //console.log(res);
                                    // REFRESH TABLE
                                    loadTagAgents(getRefID , getAgentID);
                                    $('#tagAgentTbody').fadeIn();
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

    });//EOF CONFIRM TAG AGENT BTN CLICK


    function loadTagAgents(getRefID , getAgentID){
        $.ajax({
            url: "{{ route('ajaxLoadTagAgents') }}",
            type: "POST",
            data: {
                refID: getRefID,
                agentID: getAgentID,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                $('#tagAgentTbody').empty();
                $.each(JSON.parse(res) , function(i , item){
                    let csrf = '{{ csrf_token() }}';

                    let row =
                        `<tr>
                            <td style="font-size: 12px;" class="text-success">${i+1}.</td>
                            <td>${item.empNo}</td>
                            <td>${item.empFname} ${item.empLname}</td>
                            <td>${item.userType}</td>
                            <td>
                                    ${ item.tagId == 1 ?
                                        `<button class="btn btn-danger btn-sm w-100 tagAgentFormButton"
                                        style="font-size:12px;" id="${item.empNo},,${item.empFname} ${item.empLname},,${getRefID},,1">Untag Agent</button>
                                        <input type="hidden" name="tagValue" value="1">`
                                    :
                                        `<button class="btn btn-secondary btn-sm w-100 tagAgentFormButton"
                                        style="font-size:12px;" id="${item.empNo},,${item.empFname} ${item.empLname},,${getRefID},,0">Tag Agent</button>
                                        <input type="hidden" name="tagValue" value="0">`
                                    }
                            </td>
                        </tr>`;

                        $('#tagAgentTbody').append(row);
                });
            }, 
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });//EOF AJAX

    }//EOF LOAD TAG AGENTS

});//EOF DOC READY
</script>