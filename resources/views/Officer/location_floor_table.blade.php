    <div class="row">
        <div class="col-lg-6">

            <button class="btn btn-success btn-sm mb-4 float-end"
            data-bs-toggle="modal" data-bs-target="#modalAddLoc">Add New Location <i class="bi bi-building-add"></i></button>

            <table class="table table-condensed table-hover table-striped">
                <thead class="bg-success text-white" style="font-size: 12px;">
                <tr>
                    <th>#</th>
                    <th>Location Name</th>
                    <th class="text-center">Abbreviation</th>
                    <th class="text-center">No. of Floor(s)</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <?php $counter = 1; ?>
                @foreach($data as $datas)
                    <tr>
                        <td class="fw-bold text-success" style="font-size: 11px;">{{ $counter }}.</td>
                        <td>{{ $datas->locVal }}</td>
                        <td class="text-center">{{ $datas->locAbbr }}</td>
                        <td class="text-center">{{ $datas->totalFloor }}</td>
                        <td>
                                <div class="btn-group dropend " style="width:100%">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                                    data-bs-toggle="dropdown" aria-expanded="false">Actions</button>

                                    <ul class="dropdown-menu" style="font-size: 14px;">

                                        <li><a class="dropdown-item getLocInfo" href="#" id="{{ $datas->locID }},,{{ $datas->locVal }},,{{ $datas->locAbbr }},,{{ $datas->totalFloor }}"
                                        data-bs-toggle="modal" data-bs-target="#modalEditLoc"><i class="bi bi-pencil-square"></i> Edit </a></li>

                                        <form action="{{ route('officerDeleteLocation') }}" method="POST" id="deleteLocForm_{{ $datas->locID }}">
                                        @csrf
                                            <input type="hidden" name="locID" value="{{ $datas->locID }}">
                                            <li><a class="dropdown-item text-danger deleteLocation" 
                                            href="#" id="{{ $datas->locID }},,{{ $datas->locVal }}"><i class="bi bi-trash"></i> Delete </a></li>
                                        </form>

                                    </ul>
                                </div>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
            </table>
        </div>

    </div><!-- EOF ROW -->

    
<script>
    $(document).ready(function(){
        //------------------------------------------------------------------ DELETE LOCATION CONFIRM
        $('.deleteLocation').click(function(e){
                e.preventDefault();
                
                let array = this.id.split(",,");
                let getLocID = array[0];
                let getLocName = array[1];

                $.confirm({
                    icon: 'bi bi-x-octagon-fill',
                    title: 'Delete Location',
                    content: 'Are you sure you want to Delete <span class="text-success fw-bold">' + getLocName + '?</span>',
                    type: 'red',
                    draggable: true,
                    buttons: {
                        CONFIRM: {
                            text: 'CONFIRM',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                            action: function(){
                                
                                //location.href = '/cancel_request/'+getRefID;
                                $('#deleteLocForm_'+getLocID).submit();
                            }
                        },
                        CANCEL: function () {

                        }
                    }
                });

        });// EOF ON CLICK
    }); // EOF DOC READY
</script>