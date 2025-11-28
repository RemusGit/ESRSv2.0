<script>
    $(document).ready(function(){

        //------------------------------------------------------------------ CANCEL CONFIRM
        //$('.cancelRequest').click(function(e){
        $(document).on('click' , '.cancelRequest' , function(e){

                e.preventDefault();
                
                let array = this.id.split("?");
                let getRefID = array[0];
                let categoryID = array[1];
                
                numberOnly = getRefID.replace(/\D/g, '');

                $.confirm({
                    icon: 'bi bi-x-octagon-fill',
                    title: 'Request Cancellation',
                    content: 'Confirm to Cancel this Request <span class="text-success fw-bold">' + getRefID + '</span>',
                    type: 'red',
                    draggable: true,
                    buttons: {
                        CONFIRM: {
                            text: 'CONFIRM',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                            action: function(){
                                
                                //location.href = '/cancel_request/'+getRefID;
                                $('#clientCancelReq_'+numberOnly+'-'+categoryID).submit();
                            }
                        },
                        CANCEL: function () {

                        }
                    }
                });

        });// EOF ON CLICK
    }); // EOF DOC READY
</script>