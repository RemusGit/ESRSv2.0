<script>
$(document).ready(function(){

    //------------------------------------------------------------------ UNDO CONFIRM
    //$('.undoRequestClient').click(function(e){
    $(document).on('click' , '.undoRequestClient' , function(e){
        e.preventDefault();
        
        let array = this.id.split("?");
        let getRefID = array[0];
        let categoryID = array[1];

        numberOnly = getRefID.replace(/\D/g, '');

        $.confirm({
            icon: 'bi bi-exclamation-lg',
            title: 'Undo Request',
            content: 'Confirm to Undo this Request? <p class="text-success fw-bold">' + getRefID + '</p>',
            type: 'red',
            draggable: true,
            buttons: {
                CONFIRM: {
                    text: 'CONFIRM',
                    btnClass: 'btn-danger',
                    keys: ['enter', 'shift'],
                    action: function(){

                        $('#clientUndo_'+numberOnly+'-'+categoryID).submit();
                    }
                },
                CANCEL: function () {

                }
            }
        });
    });// EOF ON CLICK
}); // EOF DOC READY
</script>