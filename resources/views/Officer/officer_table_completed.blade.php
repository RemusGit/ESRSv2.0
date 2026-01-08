   <?php use Illuminate\Support\Str ?>
   
   <div class="table table-responsive mt-2">
        <table class="table table-hover table-sm table-striped shadow autoHeightTable">

            <thead class="bg-success text-white" style="font-size: 12px;" id="tHeadForAll">
                <tr class="font11px">
                    <th>#</th>
                    <th>Reference#</th>
                    <th>Request-Date</th>
                    <th>Until</th>
                    <th>Acknowledgement</th>
                    <th>Category</th>
                    <th>Request-By</th>
                    <th>Section</th>
                    <th>Description</th>
                    <th>Equip-Details</th>
                    <th>Action-Taken</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="table-group-divider" id="officer_table_completed_tbody">

            <?php $counter = 1; ?>

            <?php
                if(isset($_GET["page"])){
                    $currentPage = $_GET["page"];
                   
                    $counter = (($data->perPage() * $data->currentPage()) + 1) - $data->perPage();
                }
            ?>

            @foreach($data as $datas)
                <tr style="font-size: 12px;">
                    <td class="fw-bold text-success" style="font-size: 11px;">{{ $counter }}.</td>
                    <?php $counter++; ?>
                    <td>{{ $datas->refNo }}</td>
                    <td>{{ $datas->reqDate }}</td>
                    <td>
                        @if($datas->until != '')
                            {{ $datas->until }}
                        @else
                            Indefinite
                        @endif
                    </td>
                    <td>{{ $datas->acknowledgementDate }}</td>
                    <td style="max-width: 120px;">{{ $datas->categoryVal }}</td>
                    <td>{{ $datas->requestBy }}</td>
                    <td style="max-width: 150px;">{{ $datas->sectionName }}</td>

                    <td style="max-width: 110px;">
                        {{ Str::limit($datas->reqDesc , 20 , '...') }}
                        <?php  $countDescription = mb_strlen( $datas->reqDesc ); ?>
                        @if ($countDescription >= 20)
                            <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Description,,{{ str_replace(",," , ".." , $datas->reqDesc) }},,{{ $datas->refNo }}'>See more</span>
                        @endif
                    </td>


                    <td style="max-width: 110px;">
                        <?php $equipmentDetails = ''  ?>
                        @if($datas->eq1 == '' || $datas->eq2 == '' || $datas->eq3 == '' || $datas->eq4 == '')
                            Not included
                        @else
                            <?php $equipmentDetails = 'Equipment: '. $datas->eq1 . '\n Serial: ' . $datas->eq2 . ' Model: ' . $datas->eq3 . ' Property No. ' . $datas->eq4; ?>

                            {{ Str::limit($equipmentDetails , 20 , '...') }}
                            <?php  $countDescription = mb_strlen( $equipmentDetails ); ?>
                            @if ($countDescription >= 20)
                                <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Equipment Details,,{{ $equipmentDetails }},,{{ $datas->refNo }}'>See more</span>
                            @endif

                        @endif
                    </td>


                    <td>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill mt-2 pt-1 officerActionTaken" style="font-size: 8px;"
                        id='{{ $datas->refNo }}' data-bs-toggle="modal" data-bs-target="#officerActionTakenModal">
                            View Action
                        </button>
                    </td>


                    <td class="">

                        <div class="btn-group dropstart " style="width:100%">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle actionBtnForAutoHeight" 
                            data-bs-toggle="dropdown" aria-expanded="false">Actions</button>

                            <ul class="dropdown-menu" style="font-size: 14px;">

                                <li><a class="dropdown-item officerAddActionBtn" href="#" id="{{ $datas->refNo }}"
                                data-bs-toggle="modal" data-bs-target="#officerNewActionModal"><i class="bi bi-file-plus"></i> New Action </a></li>

                                <li><a class="dropdown-item tagAgentButtonInTable" href="#"
                                id="{{ $datas->refNo }},,{{ $datas->categoryVal }}" data-bs-toggle="modal" data-bs-target="#tagAgentModal">
                                <i class="bi bi-person-fill-add"></i> Tag Agents </a></li>

                                <!-- SERVICE REPORT FORM - EFMS ONLY -->
                                @if(Auth::user()->agentunit_id == 1)
                                    <li><a class="dropdown-item" href="/service_report_form_pdf/{{ $datas->refNo }}" target="blank">
                                    <i class="bi bi-folder-symlink-fill"></i> Service Report Form </a></li>
                                @endif

                                @if($datas->condemn == 1 && Auth::user()->agentunit_id == 2)
                                    <li><a class="dropdown-item" href="/condemn_form/{{ $datas->refNo }}" target="blank"><i class="bi bi-file-x-fill"></i> Show Condemn Form</a></li>
                                @endif

                                    <!-- VIEW ATTACHMENTS -->
                                    @if(
                                        $datas->categoryId == 12
                                        || $datas->categoryId == 4
                                        || $datas->categoryId == 6
                                        || $datas->categoryId == 30
                                        || $datas->categoryId == 7
                                        || $datas->categoryId == 3
                                        || $datas->categoryId == 13
                                        || $datas->categoryId == 42
                                    )
                                        <li><a href="#" class="dropdown-item viewAttachment" id="{{ $datas->refNo }}?{{ $datas->categoryVal }}?{{ Crypt::encrypt($datas->refNo) }}"
                                        data-bs-toggle="modal" data-bs-target="#viewAttachmentModal"><i class="bi bi-paperclip"></i> View Attachment </a></li>
                                    @endif
                                    
                            </ul>
                        </div>

                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
    </div>

    <!-- PAGINATION -->
    <nav class="">
            {{ $data->links()  }}
    </nav>

</div> <!--EOF TABLE RESPONSIVE -->

@include('partials.officer_undo_request')