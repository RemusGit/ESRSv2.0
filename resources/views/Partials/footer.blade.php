
@if(isset(Auth::user()->account_empid))
    @include('partials.notif_container')
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

        $('.actionBtnForAutoHeight').click(function(){

            var rowCount = $('.autoHeightTable tr').length - 1;
            //alert(rowCount - 1);

            if(rowCount <= 2){

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

</script>