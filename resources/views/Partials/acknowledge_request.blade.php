<script>

    $(document).ready(function(){

        //var getSection = "{{ session('section_abbre') }}";
        //------------------------------------------------------------------ ACKNOWLEDGE CONFIRM
        //$('.acknowledgeRequest').click(function(e){
        $(document).on('click' , '.acknowledgeRequest' , function(e){

                e.preventDefault();

                let array = this.id.split("?");
                let getRefID = array[0];
                let categoryID = array[1];
                let agentAbbre = array[2];
                //console.log(agentUnitID);


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
                                //window.open('https://hcss.valmed.ph/?unit='+window.btoa(getSection) , '_blank');
                                window.open('https://hcss.valmed.ph/?unit='+window.btoa(agentAbbre) , '_blank');
                            }
                        },
                        CANCEL: function () {

                        }
                    }
                });

        });// EOF ON CLICK
    }); // EOF DOC READY
</script>