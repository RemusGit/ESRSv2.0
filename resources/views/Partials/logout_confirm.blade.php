<script>
    $(document).ready(function(){

        //------------------------------------------------------------------ LOGOUT CONFIRM
        $('.logoutConfirm').click(function(){

            $.confirm({
                icon: 'bi bi-box-arrow-in-left',
                title: 'EXIT',
                content: 'Are you sure you want to Exit ESRS?',
                type: 'red',
                draggable: true,
                buttons: {
                    YES: {
                        text: 'YES',
                        btnClass: 'btn-red',
                        keys: ['enter', 'shift'],
                        action: function(){
                            location.href = '/logout';
                        }
                    },
                    NO: function () {
                        //console.log('User chose No');
                    }
                }
            });
        });
    });
</script>