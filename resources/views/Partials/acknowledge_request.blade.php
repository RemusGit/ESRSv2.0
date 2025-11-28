<script>
    $(document).ready(function(){

        //------------------------------------------------------------------ ACKNOWLEDGE CONFIRM
        //$('.acknowledgeRequest').click(function(e){
        $(document).on('click' , '.acknowledgeRequest' , function(e){

                e.preventDefault();

                let array = this.id.split("?");
                let getRefID = array[0];
                let categoryID = array[1];


                numberOnly = getRefID.replace(/\D/g, '');

                $.confirm({
                    icon: 'bi bi-folder-check',
                    title: 'Request Acknowledge',
                    content: 'Confirm to Acknowledge this Request? <p class="text-success fw-bold">' + getRefID + '</p>',
                    type: 'green',
                    draggable: true,
                    buttons: {
                        CONFIRM: {
                            text: 'CONFIRM',
                            btnClass: 'btn-success',
                            keys: ['enter', 'shift'],
                            action: function(){

                                $('#clientAcknowledge_'+numberOnly+'-'+categoryID).submit();
                            }
                        },
                        CANCEL: function () {

                        }
                    }
                });

        });// EOF ON CLICK
    }); // EOF DOC READY
</script>