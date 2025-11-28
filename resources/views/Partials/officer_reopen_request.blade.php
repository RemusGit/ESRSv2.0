<script>
        //$('.reopenRequest').click(function(){
        $(document).on('click' , '.reopenRequest' , function(){
            let array = this.id.split("?");
            let getRefID = array[0];
            let categoryID = array[1];

            let numberOnly = getRefID.replace(/\D/g, '');

            //alert(getRefID);
                $.confirm({
                    icon: '',
                    title: 'Confirm Reopen Request',
                    content: 'Are you sure you want to Reopen this request? ' + `<p class="text-success fw-bold">` + getRefID + `</p>`,
                    type: 'dark',
                    draggable: true,
                    buttons: {
                        YES: {
                            text: 'YES',
                            btnClass: 'btn-success',
                            keys: ['enter', 'shift'],
                            action: function(){

                               //location.href = "/reopen_request/"+getRefID;
                               $('#formReopen_'+numberOnly+'-'+categoryID).submit();
                            }
                        },
                        NO: function () {
                        }
                    }
                });
        });//EOF REOPEN REQUEST CLICK
</script>