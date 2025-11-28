   <?php 
   use Illuminate\Support\Str;
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
                    <th>Description</th>
                    <th>Equip-Details</th>
                    <th>Action-Officer</th>
                    <th >Taken-Date</th>
                    <th>Action-Taken</th>
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
                <tr style="font-size: 12px;" class="text-sm-start">
                    <td class="fw-bold text-success" style="font-size: 11px;">{{ $counter }}.</td>
                    <?php $counter++; ?>
                    <td class="">{{ $datas->refNo }}</td>
                    <td style="max-width: 110px;">{{ $datas->reqDate }}</td>
                    <td style="max-width: 110px;">
                        @if($datas->until != '')
                            {{ $datas->until }}
                        @else
                            Indefinite
                        @endif
                    </td>
                    <td style="max-width: 120px;">{{ $datas->categoryVal }}</td>
                    <td>{{ $datas->requestBy }}</td>
                    <td>{{ $datas->empNo }}</td>
                    <td style="max-width: 150px;">{{ $datas->sectionName }}</td>

                    <td style="max-width: 120px;">
                        {{ Str::limit($datas->reqDesc , 20 , '...') }}
                        <?php  $countDescription = mb_strlen( $datas->reqDesc ); ?>
                        @if ($countDescription >= 20)
                            <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Description,,{{ $datas->reqDesc }},,{{ $datas->refNo }}'>See more</span>
                        @endif
                    </td>
                    <td style="max-width: 100px;">
                        <?php $equipmentDetails = ''  ?>
                        @if($datas->eq1 == '' || $datas->eq2 == '' || $datas->eq3 == '' || $datas->eq4 == '')
                            Not included
                        @else
                            <?php $equipmentDetails = 'Equipment: '. $datas->eq1 . '<br> Serial: ' . $datas->eq2 . '<br> Model: ' . $datas->eq3 . '<br> Property No. ' . $datas->eq4; ?>

                            {{ Str::limit($equipmentDetails , 20 , '...') }}
                            <?php  $countDescription = mb_strlen( $equipmentDetails ); ?>
                            @if ($countDescription >= 20)
                                <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Equipment Details,,{{ $equipmentDetails }},,{{ $datas->refNo }}'>See more</span>
                            @endif

                        @endif
                    </td>
                    <td>
                        @if($datas->officerFname != '')
                            {{ $datas->officerFname }} 
                            {{ $datas->officerMname }} 
                            {{ $datas->officerLname }}
                            {{ $datas->officerSuffix }}
                        @else
                            Waiting...
                        @endif
                    </td>

                    <td style="max-width: 110px;">
                        @if($datas->dateTaken == '' || $datas->dateTaken == null)
                            N/A
                        @else
                            {{ $datas->dateTaken }}
                        @endif
                    </td>
                    <?php $actionTaken = $datas->actionTaken  ?>
                    @if($actionTaken == '' || $actionTaken == null)
                        <td>N/A</td>
                    @else
                        <td style="max-width: 110px;">{{ Str::limit($actionTaken , 20 , '...') }}
                            <?php  $countActionTaken = mb_strlen( $actionTaken ); ?>
                            @if ($countActionTaken >= 20)
                                <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                                data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Action Taken,,{{ $actionTaken }},,{{ $datas->refNo }}'>See more</span>
                            @endif
                        </td>
                    @endif


                    <td class="text-center">
                            <!-- VIEW ATTACHMENTS -->
                            @if(
                            $datas->categoryVal == 'Biometrics Enrollment' 
                            || $datas->categoryVal == 'HOMIS Encoding Error'
                            || $datas->categoryVal == 'Network Installation / Internet Connection / Cable Transfer'
                            || $datas->categoryVal == 'Zoom Link'
                            || $datas->categoryVal == 'Website Uploads'
                            || $datas->categoryVal == 'System Enhancement / Modification / Homis / Other Installation'
                            || $datas->categoryVal == 'VMC ID Card Preparation'
                            || $datas->categoryVal == 'Travel Conduction'
                            )
                        <span class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Attachments">
                        <a href="#" class="dropdown-item viewAttachment" id="{{ $datas->refNo }}?{{ $datas->categoryVal }}?{{ Crypt::encrypt($datas->refNo) }}"
                        data-bs-toggle="modal" data-bs-target="#viewAttachmentModal" style="font-size: 16px;"
                        ><i class="bi bi-eye-fill"></i></a></span>
                        @else
                        -      
                        @endif
                    </td>


                    <td style="width: 90px; font-size: 10px;" class="adjustOnSmall">
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

@include('client.modals.modal_view_attachment')