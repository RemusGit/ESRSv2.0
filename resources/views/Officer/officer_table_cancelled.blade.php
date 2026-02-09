   <?php use Illuminate\Support\Str ?>
   
   <div class="table table-responsive mt-2">
        <table class="table table-hover table-sm table-striped shadow autoHeightTable">

            <thead class="bg-success text-white" style="font-size: 12px;" id="tHeadForAll">
                <tr class="font11px">
                    <th>#</th>
                    <th>Reference#</th>
                    <th>Request-Date</th>
                    <th>Cancelled</th>
                    <th>Category</th>
                    <th>Request-By</th>
                    <th>Section</th>
                    <th style="width: 20%;">Description</th>
                    <th style="width: 7%;">Equip-Details</th>
                    <th style="width: 7%;">Action Taken</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="table-group-divider" id="officer_table_cancelled_tbody">

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
                    <td>{{ $datas->cancelledDate }}</td>
                    <td style="max-width: 120px;">{{ $datas->categoryVal }} @if($datas->reqOthers != '')({{ substr($datas->reqOthers , 0, 40) }}) @endif</td>
                    <td>{{ $datas->requestBy }}</td>
                    <td style="max-width: 150px;">{{ $datas->sectionName }}</td>

                    <?php //SET MAX DESC CHAR
                        $descMax = 75;
                        if(Auth::user()->agentunit_id == 1){
                            $descMax = 120;
                        }
                    ?>

                    <td style="max-width: 110px;">
                        {{ Str::limit($datas->reqDesc , $descMax , '...') }}
                        <?php  $countDescription = mb_strlen( $datas->reqDesc ); ?>
                        @if ($countDescription >= $descMax)
                            <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Description,,{{ str_replace(",," , ".." , $datas->reqDesc) }},,{{ $datas->refNo }}'>See more</span>
                        @endif
                    </td>

                    <td style="max-width: 110px;">
                        <?php $equipmentDetails = ''  ?>

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

                    <td>

                        <div class="btn-group dropstart " style="width:100%">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle actionBtnForAutoHeight" 
                            data-bs-toggle="dropdown" aria-expanded="false">Actions</button>

                            <ul class="dropdown-menu" style="font-size: 14px;">

                                <li><a class="dropdown-item officerAddActionBtn" href="#" id="{{ $datas->refNo }}"
                                data-bs-toggle="modal" data-bs-target="#officerNewActionModal"><i class="bi bi-file-plus"></i> New Action </a></li>

                                <li><a class="dropdown-item tagAgentButtonInTable" href="#"
                                id="{{ $datas->refNo }},,{{ $datas->categoryVal }}" data-bs-toggle="modal" data-bs-target="#tagAgentModal">
                                <i class="bi bi-person-fill-add"></i> Tag Agents </a></li>

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
                                        || $datas->categoryId == 73
                                        || $datas->categoryId == 74
                                        || $datas->categoryId == 75
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