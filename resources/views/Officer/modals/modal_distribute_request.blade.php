<!-- Modal DISTRIBUTE-->
<div class="modal fade" data-bs-backdrop="static" id="distributeRequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Distribute Request</h5>
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
                    <tbody id="distributeRequestStaffTable">
                    </tbody>
                </table>
            </div>
      </div>
      <div class="modal-footer">
        <p class="lead">Reference#: <span id="distributeRequestRefID" class="lead text-success fw-bold"></span></p></div>
    </div>
  </div>
</div>



<script>

//--------------------------------------------------- ONCLICK DISTRIBUTE REQUEST ---------------------------
//$('.distributeRequestGetRefID').click(function(){
$(document).on('click' , '.distributeRequestGetRefID' , function(){

    let array = this.id.split(",,");
    let getRefID = array[0];
    let getCategoryVal = array[1];
    console.log(getCategoryVal);
    let getAgentID = {{session('agentunit_id')}};
    //console.log(getAgentID);

    $('#distributeRequestRefID').html(getRefID);
    $('#distributeRequestStaffTable').empty();

    $.ajax({
        url: "{{ route('ajaxDistributeRequest') }}",
        type: "POST",
        data: {
            refID: getRefID,
            agentID: getAgentID,
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {

            $.each(JSON.parse(res) , function(i , item){

                let csrf = '{{ csrf_token() }}';

                let row =
                    `<tr>
                        <td style="font-size: 12px;" class="text-success">${i+1}.</td>
                        <td>${item.empNo}</td>
                        <td>${item.empFname} ${item.empLname}</td>
                        <td>${item.userType}</td>
                        <td>
                            <form action="{{ route('assignStaff') }}" method="POST" id="formAssignTask_${item.empNo}">
                                <input type="hidden" name="_token" value="${csrf}">
                                <input type="hidden" name="getTakenByName" value="${item.empFname} ${item.empLname}">
                                <input type="hidden" name="getCategoryVal" value="${getCategoryVal}">
                                <input type="hidden" name="getStaffID" value="${item.empNo}">
                                <input type="hidden" name="getRefID" value="${getRefID}">
                                <button class="btn btn-secondary btn-sm w-100 assigningStaff"
                                style="font-size:12px;" id="${item.empNo},,${item.empFname} ${item.empLname},,${getRefID}">Assign Task</button>
                            </form>
                        </td>
                        
                    </tr>`;

                    $('#distributeRequestStaffTable').append(row);
            });
        }, 
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });//EOF AJAX

});// EOF DISTRIBUTE REQUEST ON CLICK


//--------------------------------------------------- ONCLICK ASSIGN STAFF ---------------------------
//$('#distributeRequestStaffTable').on('click', '.assigningStaff', function(e) {
$(document).on('click' , '.assigningStaff' , function(e){
    e.preventDefault();
    array = this.id.split(",,");
    
    let getStaffID = array[0];
    let getStaffName = array[1];
    let getRefID = array[2];

    $.confirm({
        icon: '',
        title: 'Confirm Assigning Staff',
        content: 'Assign this request to ' + `<span class="text-success fw-bold">` + getStaffName + `</span>` + '?',
        type: 'dark',
        draggable: true,
        buttons: {
            YES: {
                text: 'YES',
                btnClass: 'btn-success',
                keys: ['enter', 'shift'],
                action: function(){
                    
                    //location.href = '/assign_staff/'+getStaffID+'/'+getRefID;
                    $('#formAssignTask_'+getStaffID).submit();
                }
            },
            NO: function () {
            }
        }
    });

});//EOF ASSIGNING STAFF BTN CLICK

</script>