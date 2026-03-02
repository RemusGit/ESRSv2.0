<?php 
    use Illuminate\Support\Str;
    use Carbon\Carbon;
?>
   

   <div class="table-responsive-xl mt-2">
        <table class="table table-hover table-sm table-striped shadow">

            <thead class="bg-success text-white" style="font-size: 12px;">
                <tr class="font11px">
                    <th>#</th>
                    <th>Reference#</th>
                    <th>Request-Date</th>
                    <th>Until</th>
                    <th>Category</th>
                    <th>Request-By</th>
                    <th>Employee#</th>
                    <th>Section</th>
                    <th style="width: 20%;">Description</th>
                    <th style="width: 7%;">Equip-Details</th>
                    <th>Action-Officer</th>
                    <th>Taken-Date</th>
                    <th style="width: 85px;">Action-Taken</th>
                    <th>Attachments</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">

            <?php $counter = 1; ?>
            <?php
                if(isset($_GET["page"])){
                    $currentPage = $_GET["page"];
                   
                    $counter = (($data->perPage() * $data->currentPage()) + 1) - $data->perPage();
                }
            ?>

            @foreach($data as $datas)

                <?php 
                    $txtColor = "#000";
                    $yellowMin = 0;

                    if($datas->until != '' && ($datas->statusVal == 'Open' || $datas->statusVal == 'In-Progress')){

                        $nowVsUntil = now()->diffInHours(Carbon::parse($datas->until));

                        list($hour, $minute, $second) = explode(':', $datas->repairTime);
                        $duration = (int)$hour;
                        if($duration >= 24){
                            $duration = $duration / 24;
                            $nowVsUntil = $nowVsUntil / 24;
                        }
                        // GET 50% of DURATION
                        $yellowMin = $duration * 0.5;
                        if($yellowMin >= 24){
                            $yellowMin = $yellowMin / 24;
                            $nowVsUntil = $nowVsUntil / 24;
                        }
                        
                        if( $nowVsUntil <= 0 ){
                            $txtColor = "#ad1605ff";
                        }
                        elseif( $yellowMin >= $nowVsUntil){
                            $txtColor = "#4103b4ff";
                        }
                        else{
                            $txtColor = "#000";
                        }
                    }
                ?>

                <tr style="font-size: 12px;" class="text-sm-start">
                    <td class="fw-bold text-success" style="font-size: 11px;">{{ $counter }}.</td>
                    <?php $counter++; ?>
                    <td class="" style="color: {{$txtColor}};">{{ $datas->refNo }}</td>
                    <td style="max-width: 110px; color: {{$txtColor}};">{{ $datas->reqDate }}</td>
                    <td style="max-width: 110px; color: {{$txtColor}};">
                        @if($datas->until != '')
                            {{ $datas->until }}
                        @else
                            Indefinite
                        @endif
                    </td>
                    <td style="max-width: 120px; color: {{$txtColor}};">{{ $datas->categoryVal }} @if($datas->reqOthers != '')({{ substr($datas->reqOthers , 0, 40) }}) @endif</td>
                    <td style="color: {{$txtColor}};">{{ $datas->requestBy }}</td>
                    <td style="color: {{$txtColor}};">{{ $datas->empNo }}</td>
                    <td style="max-width: 150px; color: {{$txtColor}};">{{ $datas->sectionName }}</td>

                    <?php //SET MAX DESC CHAR
                        $descMax = 75;
                        if(Auth::user()->agentunit_id == 1){
                            $descMax = 120;
                        }
                    ?>

                    <td style="max-width: 120px; color: {{$txtColor}};">
                        {{ Str::limit($datas->reqDesc , $descMax , '...') }}
                        <?php  $countDescription = mb_strlen( $datas->reqDesc ); ?>
                        @if ($countDescription >= $descMax)
                            <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Description,,{{ str_replace(",," , ".." , $datas->reqDesc) }},,{{ $datas->refNo }}'>See more</span>
                        @endif
                    </td>

                    <td style="max-width: 100px; color: {{$txtColor}};">
                        <?php $equipmentDetails = '';  ?>

                        @if($datas->eq1 != '')
                            <?php $equipmentDetails = 'Name of Equipment: <span class="text-success fw-bold">'.$datas->eq1.'</span><br>'; ?>
                        @endif
                        @if($datas->eq2 != '')
                            <?php $equipmentDetails = $equipmentDetails.'Serial #: <span class="text-success fw-bold">'.$datas->eq2.'</span><br>';  ?>
                        @endif
                        @if($datas->eq3 != '')
                            <?php $equipmentDetails = $equipmentDetails.'Model #: <span class="text-success fw-bold">'.$datas->eq3.'</span><br>'; ?>
                        @endif
                        @if($datas->eq4 != '')
                            <?php $equipmentDetails = $equipmentDetails.'Property #: <span class="text-success fw-bold">'.$datas->eq4.'</span><br>'; ?>
                        @endif

                        @if($equipmentDetails == '')
                            Not included
                        @else
                            <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Equipment Details,,{{ $equipmentDetails }},,{{ $datas->refNo }}'>
                            View Details</span>
                        @endif

                    </td>
                    
                    <td style="color: {{$txtColor}};">
                        @if($datas->officerFname != '')
                            {{ $datas->officerFname }} 
                            {{ $datas->officerMname }} 
                            {{ $datas->officerLname }}
                            {{ $datas->officerSuffix }}
                        @else
                            Waiting...
                        @endif
                    </td>

                    <td style="max-width: 100px; color: {{$txtColor}};">
                        @if($datas->dateTaken == '' || $datas->dateTaken == null)
                            N/A
                        @else
                            {{ $datas->dateTaken }}
                        @endif
                    </td>

                    <td>
                        <?php $btnClassColor = 'btn-outline-secondary'; ?>
                        @if($datas->actionTaken != '' || $datas->actionTaken != null)
                        <?php $btnClassColor = 'btn-outline-danger'; ?>
                        @endif
                        <button class="btn btn-sm {{ $btnClassColor }}  rounded-pill mt-2 pt-1 officerActionTaken" style="font-size: 8px;"
                        id='{{ $datas->refNo }}' data-bs-toggle="modal" data-bs-target="#officerActionTakenModal">
                            View Action
                        </button>
                    </td>

                    <?php
                        // Biometrics Enrollment - 12
                        // HOMIS Encoding Error - 4
                        // Network Installation / Internet Connection / Cable Transfer - 6
                        // Zoom Link - 30
                        // Website Uploads - 7
                        // System Enhancement / Modification / Homis / Other Installation - 3
                        // VMC ID Card Preparation - 13
                        // Travel Conduction - 42
                    ?>

                    <td class="text-center">
                            <!-- VIEW ATTACHMENTS -->
                            @if(
                            $datas->categoryID == 12
                            || $datas->categoryID == 4
                            || $datas->categoryID == 6
                            || $datas->categoryID == 30
                            || $datas->categoryID == 7
                            || $datas->categoryID == 3
                            || $datas->categoryID == 13
                            || $datas->categoryID == 42
                            || $datas->categoryID == 73
                            || $datas->categoryID == 74
                            || $datas->categoryID == 75
                            )
                        <span class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Attachments">
                        <a href="#" class="dropdown-item viewAttachment" id="{{ $datas->refNo }}?{{ $datas->categoryVal }}?{{ Crypt::encrypt($datas->refNo) }}"
                        data-bs-toggle="modal" data-bs-target="#viewAttachmentModal" style="font-size: 16px;"
                        ><i class="bi bi-eye-fill"></i></a></span>
                        @else
                        -      
                        @endif
                    </td>


                    <td style="width: 90px; font-size: 10px;" class="adjustOnSmall py-3">
                        @if($datas->statusVal == 'For Approval')
                        <p class="bg-secondary text-white px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @elseif($datas->statusVal == 'Acknowledge')
                            <p class="bg-warning text-dark px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @elseif($datas->statusVal == 'For Processing')
                            <p class="bg-primary text-white px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @elseif($datas->statusVal == 'In-Progress')
                            <p class="bg-info text-dark px-2 rounded-pill text-center" style="width: 100%;">{{ $datas->statusVal }}</p>
                        @elseif($datas->statusVal == 'Completed')
                            <p class="bg-success text-white px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @elseif($datas->statusVal == 'Cancelled')
                            <p class="bg-danger text-white px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @else($datas->statusVal == 'Open')
                            <p class="bg-secondary text-white px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @endif
                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>
    </div>

    <nav class="">{{ $data->links()  }}</nav>
    <!-- PAGINATION -->

</div> <!--EOF TABLE RESPONSIVE -->

