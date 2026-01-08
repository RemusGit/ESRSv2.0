<script>
        //$('.takeRequest').click(function(){
        $(document).on('click' , '.takeRequest' , function(){

            let array = this.id.split("?");
            let getRefID = array[0];
            let categoryID = array[1];


            let numberOnly = getRefID.replace(/\D/g, '');
            $.confirm({
                icon: '',
                title: 'Confirm Take Request',
                content: 'Are you sure you want to take this request? ' + `<p class="text-success fw-bold">` + getRefID + `</p>`,
                type: 'dark',
                draggable: true,
                buttons: {
                    YES: {
                        text: 'YES',
                        btnClass: 'btn-success',
                        keys: ['enter', 'shift'],
                        action: function(){ 
                            //console.log(numberOnly+'-'+categoryID);
                            $('#takeRequestForm_'+numberOnly+'-'+categoryID).submit();
                        }
                    },
                    NO: function () {
                    }
                }
            });

        });// EOF TAKE REQUEST CLICK
</script>