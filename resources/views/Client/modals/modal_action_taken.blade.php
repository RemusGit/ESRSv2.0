<!-- MODAL ACTION TAKEN -->
<div class="modal fade" id="actionTakenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionTakenTitle"><p class="lead fw-bold">Action Taken</p></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <p class="lead text-center" id="actionTakenNoResult" style="display: none;">- No Action Taken Yet -</p>
                <table class="table table-hover table-sm table-striped shadow table-bordered" style="min-height: 10px;" id="actionTakenTable">

                <thead class="bg-secondary text-white" style="font-size: 12px;">
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
    //$(document).ready(function(){

        //$('.getActionTakenVal').click(function(){
        $(document).on('click' , '.getActionTakenVal' , function(){

            let getRefID = this.id;
            let counter = 1;
            $('#actionTakenBody').empty();
            $('#actionTakenFooter').html(getRefID);

                    $.ajax({
                        url: "{{ route('getAction') }}",
                        type: "POST",
                        data: {
                            refID: getRefID,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {

                            //console.log(JSON.parse(res).length);
                            if(JSON.parse(res).length == 0){
                                
                                //console.log('EMPTYYYYY');
                                $('#actionTakenTable').hide();
                                $('#actionTakenNoResult').show();
                            }
                            else{
                            
                            $('#actionTakenTable').show();
                            $('#actionTakenNoResult').hide();

                            $.each(JSON.parse(res), function(index, item) {
                                let row =
                                    `<tr>
                                        <td style="font-size: 12px;" class="text-success">${counter}.</td>
                                        <td>${item.action_taken}</td>
                                        <td>${item.action_datetime}</td>
                                    </tr>`
                                ;
                                counter++;
                                $('#actionTakenBody').append(row);
                            });

                            }//EOF res NULL

                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });//EOF AJAX
            });

    //});
</script>