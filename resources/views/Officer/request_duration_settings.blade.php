@include('partials.header')

@include('partials.sidebar_officer')

<main class="content  vh-100">
<div class="container-fluid">

@include('partials.officer_top_display')

<!--Current PAGE-->
<div class="row ">
    <div class="col-lg-12 ">
        <div class="lead fw-bold"><i class="bi bi-gear-fill"></i> Request Duration Settings</div>
    </div>
</div>
<!--Current PAGE-->

<hr class="bg-success" style="height: 2px;">

    <div class="row mb-2">
        <div class="col-lg-9">
            <label>
                @if(session('agentunit_id') == 1)
                    <span class="fw-bold">EFMS</span> - Engineering and Facilities Management Section
                    
                @elseif(session('agentunit_id') == 2)
                    <span class="fw-bold">IMISS</span> - Integrated Management Information System Section
                @endif</label>
        </div>

        <div class="col-lg-3">
            <button class="btn btn-success btn-sm float-end"
            data-bs-toggle="modal" data-bs-target="#modalAddDuration">Add New Duration <i class="bi bi-clock-history"></i></button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">

            <!--button class="btn btn-success btn-sm mb-4 float-end"
            data-bs-toggle="modal" data-bs-target="#">Add New Duration <i class="bi bi-building-add"></i></button-->

            <!--h6 class="fw-bold text-success lead mb-4">IMISS Request</h6-->
            <table class="table table-condensed table-hover table-striped">
                <thead class="bg-success text-white" style="font-size: 12px;">
                <tr>
                    <th>#</th>
                    @if( Auth::user()->agentunit_id == 1 )
                        <th>Main Category</th>
                    @endif
                    <th>Category Name</th>
                    <th class="text-center">Request Duration</th>
                    <th class="text-center">Actions</th>
                    <th class="text-center">Activate</th>
                </tr>
                </thead>
                <?php $counter = 1; ?>
                @foreach($data as $datas)
                    <tr style="font-size: 12px;">
                        <td class="fw-bold text-success" style="font-size: 11px;">{{ $counter }}.</td>
                        @if( Auth::user()->agentunit_id == 1 )
                            @if($datas->categoryMain != '')
                                <td>{{ $datas->categoryMain }}</td>
                            @else
                                <td>N/A</td>
                            @endif
                        @endif
                        <td>{{ $datas->categoryVal }}</td>
                        <?php $array = explode(":" , $datas->repairTime); ?>
                        <?php $getHours = $array[0]; ?>
                        <?php $getDay = 0; ?>
                        <?php $duration = 0; ?>

                        @if($getHours >= 24)
                            <?php  $getDay = (int)($getHours / 24); ?>
                            <?php $additionalHours = (int)($getHours - ($getDay * 24)) ?>
                            <td class="text-center text-success fw-bold">
                                {{ $getDay }} Day(s)
                                @if($additionalHours > 0)
                                    & {{ $additionalHours }} Hr(s)
                                @endif
                            </td>
                        @else
                            @if($getHours == 0)
                                <td class="text-center text-success fw-bold">Indefinite</td>
                            @else
                                <td class="text-center text-success fw-bold">{{ $getHours }} Hour(s)</td>
                            @endif
                        @endif

                        <td>
                            <div class="btn-group dropdown " style="width:100%">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                                data-bs-toggle="dropdown" aria-expanded="false">Actions</button>

                                <ul class="dropdown-menu" style="font-size: 14px;">

                                    <li><a class="dropdown-item getEditDurationInfo" href="#" 
                                    id="{{ $datas->categoryID }},,{{ $datas->categoryVal }},,{{ $datas->repairTime }}"
                                    data-bs-toggle="modal" data-bs-target="#modalUpdateDuration"><i class="bi bi-pencil-square"></i> Edit Duration</a></li>

                                </ul>
                            </div>
                        </td>

                        <td>
                            <div class="form-check form-switch d-flex justify-content-center" style="font-size: 20px;">
                            @if($datas->categoryActive == 1)
                                <input class="form-check-input categoryActiveToggle" type="checkbox" role="switch" id="{{ $datas->categoryID }},,{{ $datas->categoryVal }}" checked>
                            @else
                                <input class="form-check-input categoryActiveToggle" type="checkbox" role="switch" id="{{ $datas->categoryID }},,{{ $datas->categoryVal }}">
                            @endif
                            </div>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
            </table>
        </div>


        <div class="col-lg-4">
            <table class="table table-condensed table-hover table-striped">
                <thead class="bg-success text-white" style="font-size: 12px;">
                <tr>
                    <th>#</th>
                    <th>Duration Name</th>
                    <th class="text-center">Duration (Hours)</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <?php $counter = 1; ?>
                <?php $durationArray = []; ?>
                @foreach($durations as $duration)
                    <tr style="font-size: 12px;">
                        <td class="fw-bold text-success" style="font-size: 11px;">{{ $counter }}.</td>
                        <td>
                            {{ $duration->repairVal }}
                                @if(
                                    $duration->repairID == 1 || 
                                    $duration->repairID == 2 || 
                                    $duration->repairID == 3 || 
                                    $duration->repairID == 4 || 
                                    $duration->repairID == 5 
                                    )
                                <span class="text-secondary" style="font-size: 9px;">(Default)</span>
                                @endif
                        </td>
                        <td class="text-center text-success fw-bold">{{ $duration->repairTime }}</td>
                        <?php array_push($durationArray , $duration->repairTime); ?>
                        <td>
                                <div class="btn-group dropdown " style="width:100%">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                                    data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                    <ul class="dropdown-menu" style="font-size: 14px;">

                                        @if(
                                            $duration->repairID == 1 || 
                                            $duration->repairID == 2 || 
                                            $duration->repairID == 3 || 
                                            $duration->repairID == 4 || 
                                            $duration->repairID == 5 
                                            )
                                            <!--li><a class="dropdown-item getDurationInfo disabled" href="#" id=""
                                            data-bs-toggle="modal" data-bs-target="#">
                                            <i class="bi bi-pencil-square"></i> Edit <span class="text-danger fst-italic" style="font-size: 10px;">(cannot modify)</span></a></li-->

                                            <li><a class="dropdown-item getDurationInfo disabled"
                                            href="#" id=""><i class="bi bi-trash3-fill"></i> Delete <span class="text-danger fst-italic" style="font-size: 10px;">(cannot modify)</span></a></li>
                                        @else
                                            <!--li><a class="dropdown-item getDurationInfo" href="#" id=""
                                            data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-pencil-square"></i> Edit</a></li-->
                                            
                                            <form action="{{ route('officerDeleteDuration') }}" method="POST" id="formDeleteDuration_{{ $duration->repairID }}">
                                                @csrf
                                                <input type="hidden" name="durationID" value="{{ $duration->repairID }}">
                                                <li><button class="dropdown-item deleteDurationBtn text-danger" type="submit"
                                                id="{{ $duration->repairID }},,{{ $duration->repairVal }}"><i class="bi bi-trash3-fill"></i> Delete</button></li>
                                            </form>
                                        @endif

                                    </ul>
                                </div>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
            </table>
        </div>

    </div><!-- EOF ROW -->
    
</div> <!--EOF CONTAINER FLUID-->
</main>

@include('officer.modals.modal_add_duration')

@include('officer.modals.modal_update_duration')

@include('partials.footer')


<script>
$(document).ready(function(){
//------------------------------------------------------------------ DELETE CONFIRM
    $('.deleteDurationBtn').click(function(e){
        e.preventDefault();
        let array = this.id.split(",,");
        let repairID = array[0];
        let getDurationVal = array[1];
        $.confirm({
            icon: 'bi bi-box-arrow-in-left',
            title: 'Confirm Deletion',
            content: 'Are you sure you want to Delete ' + getDurationVal +'?',
            type: 'red',
            draggable: true,
            buttons: {
                YES: {
                    text: 'YES',
                    btnClass: 'btn-red',
                    keys: ['enter', 'shift'],
                    action: function(){
                        $('#formDeleteDuration_'+repairID).submit();
                    }
                },
                NO: function () {
                    //console.log('User chose No');
                }
            }
        });
    });


    $('.categoryActiveToggle').on('change' , function(){

        const checkbox = this; // preserve reference

        let array = this.id.split(',,');
        let categoryID = array[0];
        let categoryVal = array[1];

        let toggleVal = $(this).is(':checked');

        let confirmType = 'red';
        let contentVal = 'Confirm to <span class="text-danger">Deactivate</span> ';
        let btnVal = 'btn-red';
        let confirmTitle = 'Confirm Deactivation';

        //console.log(toggleVal);
        if(toggleVal == true){
            confirmType = 'green';
            contentVal = 'Confirm to <span class="text-success">Activate</span> ';
            btnVal = 'btn-success';
            confirmTitle = 'Confirm Activation';
        }

        //console.log(getCategoryVal);
        $.confirm({
            icon: 'bi bi-check2-square',
            title: confirmTitle,
            content: contentVal + '<p class="text-success fw-bold" style="font-size: 14px;">'+categoryVal+'</p>',
            type: confirmType,
            draggable: true,
            buttons: {
                YES: {
                    text: 'YES',
                    btnClass: btnVal,
                    keys: ['enter', 'shift'],
                    action: function(){
                        console.log('ID: ' + categoryID + 'Checkval: ' + toggleVal);

                        $.ajax({
                            url: "{{ route('activateCategory') }}", 
                            type: 'POST', 
                            data: {
                                    categoryID: categoryID ,
                                    activeVal: toggleVal ,
                                    _token: "{{ csrf_token() }}"
                                },
                            
                            success: function(res){
                                //console.log(res);
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });//EOF AJAX

                    }
                },
                NO: function () {
                    checkbox.checked = !toggleVal;
                }
            }
        });

    });

});//EOF DOC READY
</script>
