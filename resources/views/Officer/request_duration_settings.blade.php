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

    <div class="row mb-4">
        <div class="col-lg-12">
            <button class="btn btn-success btn-sm float-end"
            data-bs-toggle="modal" data-bs-target="#modalAddDuration">Add New Duration <i class="bi bi-clock-history"></i></button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">

            <!--button class="btn btn-success btn-sm mb-4 float-end"
            data-bs-toggle="modal" data-bs-target="#">Add New Duration <i class="bi bi-building-add"></i></button-->

            <!--h6 class="fw-bold text-success lead mb-4">IMISS Request</h6-->
            <table class="table table-condensed table-hover table-striped">
                <thead class="bg-success text-white" style="font-size: 12px;">
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th class="text-center">Request Duration</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <?php $counter = 1; ?>
                @foreach($data as $datas)
                    <tr style="font-size: 12px;">
                        <td class="fw-bold text-success" style="font-size: 11px;">{{ $counter }}.</td>
                        <td>{{ $datas->categoryVal }}</td>
                        <?php $array = explode(":" , $datas->repairTime); ?>
                        <?php $getHours = $array[0]; ?>
                        <?php $getDay = 0; ?>
                        <?php $duration = 0; ?>

                        @if($getHours >= 24)
                            <?php  $getDay = $getHours / 24; ?>
                            <td class="text-center text-success fw-bold">{{ $getDay }} Day(s)</td>
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

                                    <li><a class="dropdown-item getLocInfo" href="#" id=""
                                    data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-pencil-square"></i> Edit Duration</a></li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
            </table>
        </div>


        <div class="col-lg-5">
            <table class="table table-condensed table-hover table-striped">
                <thead class="bg-success text-white" style="font-size: 12px;">
                <tr>
                    <th>#</th>
                    <th>Duration Name</th>
                    <th class="text-center">Duration</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <?php $counter = 1; ?>
                @foreach($durations as $duration)
                    <tr style="font-size: 12px;">
                        <td class="fw-bold text-success" style="font-size: 11px;">{{ $counter }}.</td>
                        <td>{{ $duration->repairVal }}</td>
                        <td class="text-center text-success fw-bold">{{ $duration->repairTime }}</td>
                        <td>
                                <div class="btn-group dropdown " style="width:100%">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                                    data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                    <ul class="dropdown-menu" style="font-size: 14px;">

                                        <li><a class="dropdown-item getLocInfo" href="#" id=""
                                        data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-pencil-square"></i> Edit</a></li>

                                    </ul>
                                </div>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
            </table>
        </div>

    </div><!-- EOF ROW -->

    @include('officer.modals.modal_add_duration')


</div> <!--EOF CONTAINER FLUID-->
</main>

@include('partials.footer')



