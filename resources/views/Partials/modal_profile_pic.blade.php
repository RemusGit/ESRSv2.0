<!-- Modal PROFILE PIC -->
<div class="modal fade" id="modalProfilePic" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-success">Select Avatar <i class="bi bi-person-circle"></i></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <div class="container-fluid">

        <form action="/update_avatar" method="post">
        @csrf
        <div class="row justify-content-center" id="showAllProfile">

        </div><!--EOF ROW-->
        </div><!--EOF CONTAINER FLUID-->

        <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-success w-100">Save</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

<script>
    $('#modalProfilePic').on('show.bs.modal', function(){
        
        let profilePath = "{{ asset('uploads/ESRS_profile/') }}";
        let avatarLabel = "";

        //console.log(profilePath);
        $('#showAllProfile').empty();
        for(let i = 1; i <= 64; i++){
        
         avatarLabel = i.toString().padStart(3 , '0');
         let row = `<div class="col-lg-2 text-center pb-4">
                        <label for="profilePic_${i}" class="fw-bold text-secondary"
                        style="font-size: 10px;">
                        <img src="${profilePath}/${i}.png"
                        alt="profilePic" class="rounded-circle" style="max-width: 50px; cursor:pointer;">
                        <input type="radio" class="form-radio" id="profilePic_${i}" name="profilePic" required value="${i}.png">
                        A-${avatarLabel}
                        </label>
                    </div>`;
                $('#showAllProfile').append(row);
        }
    });
</script>


