<!-- Modal SEE MORE -->
<div class="modal fade" id="modalSeemore" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="modalSeemoreTitle"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    
                    <p id="modalSeemoreBody"></p>
                </div>
            </div>
        </div>

        <div class="modal-footer">
                <p class="lead text-success fw-bold" style="font-size: 14px;">Reference No. <span id="modalSeemoreRefID"></span></p>
        </div>
        
      </div>
    </div>
  </div>
</div>



<script>
    $(document).ready(function(){
        //$('.seeMoreClass').click(function(){
        $(document).on('click' , '.seeMoreClass' , function(){

            //let removeComma = this.id.replace(',',' ');

            let arrayStr = this.id.split(",,");

            let seemoreTitle = arrayStr[0];
            let seemoreVal = arrayStr[1];
            let seemoreRefID = arrayStr[2];
            
            $('#modalSeemoreRefID').html(seemoreRefID);
            $('#modalSeemoreTitle').html(seemoreTitle);
            $('#modalSeemoreBody').html(seemoreVal);

        });
    });
</script>