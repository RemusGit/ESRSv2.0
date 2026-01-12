@include('partials.header')
<script>
$(document).ready(function(){

$.confirm({
            theme: 'supervan',
            icon: 'bi bi-exclamation-lg',
            title: 'Authentication Failed',
            content: 'Redirect to Login Page',
            type: 'red',
            draggable: true,
            buttons: {
                CONFIRM: {
                    text: 'OK',
                    btnClass: 'btn-default',
                    keys: ['enter', 'shift'],
                    action: function(){
                        location.href = "http://192.168.12.6/VMC-Platform/Module%20Login/Pages/Page_Login.php";
                    }
                }
            }
        });

});
</script>
@include('partials.footer')