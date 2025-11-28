   <?php use Illuminate\Support\Str ?>
   
   <div class="table table-responsive mt-2">
        <table class="table table-hover table-sm table-striped shadow autoHeightTable">

            <thead class="bg-success text-white" style="font-size: 12px;" id="tHeadForAll">
                <tr class="font11px">
                    <th>#</th>
                    <th>Reference#</th>
                    <th>Request-Date</th>
                    <th>Until</th>
                    <th>Category</th>
                    <th>Request-By</th>
                    <th>Section</th>
                    <th>Location</th>
                    <th>Floor</th>
                    <th>Description</th>
                    <th>Equip-Details</th>
                    <th>Action Taken</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="table-group-divider" id="officer_table_inprogress_tbody">

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
                        @endif</td>
                    <td style="max-width: 120px;">{{ $datas->categoryVal }}</td>
                    <td>{{ $datas->requestBy }}</td>
                    <td style="max-width: 150px;">{{ $datas->sectionName }}</td>
                    <td>{{ $datas->locationVal }}</td>
                    <td>{{ $datas->bldgFloorVal }}</td>

                    <td style="max-width: 110px;">
                        {{ Str::limit($datas->reqDesc , 20 , '...') }}
                        <?php  $countDescription = mb_strlen( $datas->reqDesc ); ?>
                        @if ($countDescription >= 20)
                            <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Description,,{{ $datas->reqDesc }},,{{ $datas->refNo }}'>See more</span>
                        @endif
                    </td>

                    <td style="max-width: 110px;">
                        <?php $equipmentDetails = ''  ?>
                        @if($datas->eq1 == '' || $datas->eq2 == '' || $datas->eq3 == '' || $datas->eq4 == '')
                            Not included
                        @else
                            <?php $equipmentDetails = 'Equipment: '. $datas->eq1 . ' Serial: ' . $datas->eq2 . ' Model: ' . $datas->eq3 . ' Property No. ' . $datas->eq4; ?>

                            {{ Str::limit( $equipmentDetails , 20 , '...') }}
                            <?php  $countDescription = mb_strlen( $equipmentDetails ); ?>
                            @if ($countDescription >= 20)
                                <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Equipment Details,,{{ $equipmentDetails }},,{{ $datas->refNo }}'>See more</span>
                            @endif

                        @endif
                    </td>

                    <?php $actionTaken = $datas->actionTaken  ?>
                    <td style="max-width: 110px;">{{ Str::limit($actionTaken , 20 , '...') }}
                        <?php  $countActionTaken = mb_strlen( $actionTaken ); ?>
                        @if ($countActionTaken >= 20)
                            <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Action Taken,,{{ $actionTaken }},,{{ $datas->refNo }}'>See more</span>
                        @endif
                        @if($countActionTaken == '' || $countActionTaken == null)
                        N/A
                        @endif
                    </td>

                    <td class="">

                        <div class="btn-group dropstart " style="width:100%">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle actionBtnForAutoHeight" 
                            data-bs-toggle="dropdown" aria-expanded="false">Actions</button>

                            <ul class="dropdown-menu" style="font-size: 14px;">

                                <li><a class="dropdown-item officerAddActionBtn" href="#" id="{{ $datas->refNo }}"
                                data-bs-toggle="modal" data-bs-target="#officerNewActionModal"><i class="bi bi-file-plus"></i> New Action </a></li>

                                
                                <li><a class="dropdown-item updateCategoryClassBtn" href="#" 
                                id="{{ $datas->refNo }},,{{ $datas->categoryVal }},,{{ $datas->reqDesc }},,{{ $datas->categoryId }},,{{ $datas->reqDate }}"
                                data-bs-toggle="modal" data-bs-target="#modalUpdateCategory"
                                ><i class="bi bi-arrow-up-right-square-fill"></i> Update Category </a></li>


                                <li><a class="dropdown-item officerCondemnRequestBtn" href="#" 
                                id="{{ $datas->refNo }},,{{ $datas->eq1 }},,{{ $datas->eq2 }},,{{ $datas->eq3 }},,{{ $datas->eq4 }}"
                                data-bs-toggle="modal" data-bs-target="#officerCondemnModal"><i class="bi bi-bell-slash-fill"></i> Condemn </a></li>


                                    <form action="/done_request" method="POST" id="doneRequestForm_{{ preg_replace('/[^0-9]/', '', $datas->refNo) }}-{{ $datas->categoryId }}">
                                    @csrf
                                    <input type="hidden" name="categoryVal" value="{{ $datas->categoryVal }}">
                                    <input type="hidden" name="officerFullName" value="{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}">
                                    <input type="hidden" name="refID" value="{{ $datas->refNo }}">
                                    <input type="hidden" name="agentStaffID" value="{{ session('account_empid') }}">
                                        <li><a class="dropdown-item doneRequest" href="#" id="{{ $datas->refNo }}?{{ $datas->categoryId }}"><i class="bi bi-send-check-fill"></i> Done </a></li>
                                    </form>

                                <li>
                                    <form action="/reopen_request" method="POST" id="formReopen_{{ preg_replace('/[^0-9]/', '', $datas->refNo) }}-{{ $datas->categoryId }}">
                                        @csrf
                                        <input type="hidden" name="categoryVal" value="{{ $datas->categoryVal }}">
                                        <input type="hidden" name="getRefID" value="{{ $datas->refNo }}">
                                        <input type="hidden" name="officerFullName" value="{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}">
                                        <a class="dropdown-item reopenRequest" 
                                        href="#" id="{{ $datas->refNo }}?{{ $datas->categoryId }}"><i class="bi bi-envelope-open"></i> Re-Open 
                                        </a>
                                    </form>
                                </li>

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
                                        <li><a href="#" class="dropdown-item viewAttachment" id="{{ $datas->refNo }}?{{ $datas->categoryVal }}?{{ Crypt::encrypt($datas->refNo) }}"
                                        data-bs-toggle="modal" data-bs-target="#viewAttachmentModal"><i class="bi bi-paperclip"></i> View Attachment </a></li>
                                    @endif

                                <li><a class="dropdown-item officerCancelReqBtn" href="#" id="{{ $datas->refNo }},,{{ $datas->categoryVal }}"
                                    data-bs-toggle="modal" data-bs-target="#officerCancelRequest" href="#"><i class="bi bi-x-square-fill"></i> Cancel Request </a>
                                </li>

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

@include('partials.officer_reopen_request')

@include('officer.modals.modal_cancel_request')

@include('client.modals.modal_view_attachment')

@include('officer.modals.modal_new_action')

@include('partials.officer_done_request')

@include('officer.modals.modal_condemn_request')

@include('officer.modals.modal_update_category')