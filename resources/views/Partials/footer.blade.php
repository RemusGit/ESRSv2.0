
@if(isset(Auth::user()->account_empid))
    @include('partials.notif_container')
    @include('partials.modal_profile_pic')
    @include('partials.modal_chat')
@endif



</body>
</html>

<script>
    // FOR TOOLTIP TO ACTIVATE
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>

@include('partials.logout_confirm')


<script>

    $(document).ready(function(){

    $('.toAnimate').click(function(){
        $('.toAnimate').addClass('animate__animated animate__swing');

          setTimeout(function() {
            $('.toAnimate').removeClass("animate__animated animate__swing");
        }, 1000); // The delay in milliseconds
    });

    $('.toAnimate2').hover(function(){
        $('.toAnimate2').addClass('animate__animated animate__jackInTheBox');

          setTimeout(function() {
            $('.toAnimate2').removeClass("animate__animated animate__jackInTheBox");
        }, 1000); // The delay in milliseconds
    });
    
        //$('.actionBtnForAutoHeight').click(function(){
        $(document).on("click" , ".actionBtnForAutoHeight" , function(){

            var rowCount = $('.autoHeightTable tr').length - 1;
            //alert(rowCount - 1);

            if(rowCount <= 3){
                console.log(rowCount);
               // $('.dropdownMenu').removeClass('dropDownPosAbosulte');
               // $('.dropdownMenu').addClass('dropdownPosFixed');
                $('.autoHeightTable').css('min-height' , '250px');
            }
            else{
                
                //$('.dropdownMenu').addClass('dropDownPosAbosulte');
               // $('.dropdownMenu').removeClass('dropdownPosFixed');
            }
        
        });

        // Initialize Select2 normally
        $('.select2').select2({
            placeholder: "",
            allowClear: true,
            dropdownParent: $('#createServiceRequestModal , #modalUpdateCategory') // only if inside modal
        });

        // Fix the floating label position after selection
        $('.select2').on('change', function() {
            if ($(this).val()) {
            $(this).closest('.form-floating').find('label').addClass('active');
            } else {
            $(this).closest('.form-floating').find('label').removeClass('active');
            }
        });

    });

    window.addEventListener("load", () => {
        //document.getElementById("pageWrapper").classList.add("loaded");
        //$('#pageWrapper').addClass("loaded");
        $('.content').addClass("loaded");
    });

</script>

