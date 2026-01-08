<!-- Modal OFFICER CANCEL REQUEST -->
<div class="modal fade" id="modalChat" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="modalChatHeader"></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <div class="container-fluid">
                <div class="row">

                    <!-- SIDEBAR -->
                    <div class="col-md-4 vh-100 rounded-1 border-opacity-10" 
                    style="overflow: auto; max-height: 500px; font-size: 11px; margin-left: -20px;" id="chatShowUsers">

                    </div>
                    <!-- EOF SIDEBAR -->
                    
                    <!-- MAIN BODY -->
                    <div class="col-md-8 ms-auto vh-100 border border-1 rounded-1 border-opacity-10" 
                    style="overflow: auto; max-height: 500px; position:relative; font-size: 12px;" id="chatBody">
                    
                    </div>
                    <!-- EOF MAIN BODY -->
                </div>

                <div class="row">
                    <div class="col-md-8 ms-auto">
                        <div class="input-group input-group-sm mt-2">
                            <input type="text" class="form-control form-control-sm w-100" id="chatMsg" name="chatMsg">
                        </div>
                    </div>
                </div>

            </div>

            <input type="hidden" name="senderID" value="{{ Auth::user()->account_empid }}" id="senderID">
            <input type="hidden" name="receiverID" id="receiverID">


        </div>
    </div>
  </div>
</div>


<script>
$('#modalChat').on('show.bs.modal', function(){

    $.ajax({
        url: "{{ route('loadUsers') }}", 
        type: 'POST', 
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            //console.log(res);
            
            $('#chatShowUsers').empty();
            $.each(JSON.parse(res) , function(i , item){
                
                let row = `<label style="cursor: pointer;" class="nameHover p-2 w-100" 
                id="${item.account_fname},,${item.account_lname},,${item.agentunit_abbre},,${item.account_empid}">
                <img src="{{ asset('uploads/ESRS_profile/1.png') }}" alt="..." class="rounded-circle" style="max-width: 20px;">
                ${item.account_fname} ${item.account_lname} (${item.agentunit_abbre})
                </label>`;
                $('#chatShowUsers').append(row);
            });
        },
        error: function(error) {
            console.error(error);
        }
    });//EOF AJAX
    
}); //EOF ON BS SHOW MODAL


$(document).on('click' , '.nameHover' , function(){

    let getUserInfo = this.id.split(",,");
    let userFullname = getUserInfo[0]+' '+getUserInfo[1];
    let agentUnit = getUserInfo[2];
    let userID = getUserInfo[3];

    $('#chatMsg').removeAttr('disabled');
    $('#modalChatHeader').html(userFullname +' '+'('+agentUnit+')');
    $('#receiverID').val(userID);

    if($('#chatBody > #' + userID).length == 0){

        var createChatDiv = $("<div id="+userID+"></div>");
        $('#chatBody').append(createChatDiv);
    }

});

$('#chatMsg').on('keyup' , function(e){

    
    if (event.key === 'Enter') {

        let receiverID = $('#receiverID').val();
        let senderID = $('#senderID').val();
        let chatMsg = $('#chatMsg').val();

        let senderName = "{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}";

        $('#chatMsg').val('');

        $.ajax({
            url: "{{ route('sendMsg') }}", 
            type: 'POST', 
            data: {
                receiverID: receiverID ,
                senderID: senderID ,
                chatMsg: chatMsg ,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                //console.log(res);

                if(receiverID == null || receiverID == ''){
                    alert("Please select User");
                    return;
                }

                let row = `<p class="fw-bold pt-2" style="text-align: right; font-size: 10px;">${senderName}</p>
                    <p style="text-align: right;">
                    <label class="p-2" style="background-color: #c8ffc8ff; border-radius: 50px;">${chatMsg}</label>
                </p>`
                $('#chatBody > #'+receiverID).append(row);
            },
            error: function(error) {
                console.error(error);
            }
        });//EOF AJAX
    }

});

</script>