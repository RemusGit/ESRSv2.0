<div id="clientList">
@foreach($data as $datas)

<!-- REFERENCE ID + ACTION OFFICER -->
   <div class="row mt-4">
        <div class="col-lg-6">
            <p class="lead">Reference#: <span class="lead text-success fw-bold">{{ $datas->refID }}</span> </p>
        </div>

        <div class="col-lg-6 ms-auto text-end">
            @if( $datas->actionOfficer != null )
                <p>Action Officer: <span class="text-success">{{ $datas->actionOfficer }}</span></p>
            @else
                <p class="">Action Officer: <span class="text-danger">Waiting...</span></p>
            @endif
        </div>
   </div>

    <?php 
            $categoryIcon = "bi bi-question-diamond-fill"; // TEMP DEFAULT ICON
            switch($datas->categoryId){
                case 1:
                    $categoryIcon = 'bi bi-hdd-network-fill';
                    break;

                case 3:
                    $categoryIcon = 'bi bi-pc-display';
                    break;

                case 4:
                        $categoryIcon = 'bi bi-keyboard-fill';
                        break;

                case 6:
                        $categoryIcon = 'bi bi-wifi';
                        break;

                case 7:
                        $categoryIcon = 'bi bi-cloud-arrow-up-fill';
                        break;

                case 8:
                        $categoryIcon = 'bi bi-people-fill';
                        break;

                case 10:
                        $categoryIcon = 'bi bi-person-badge';
                        break;

                case 11:
                        $categoryIcon = 'bi bi-person-gear';
                        break;

                case 12:
                        $categoryIcon = 'bi bi-fingerprint';
                        break;

                case 13:
                        $categoryIcon = 'bi bi-person-vcard';
                        break;

                case 30:
                        $categoryIcon = 'bi bi-wechat';
                        break;

                case 33:
                        $categoryIcon = 'bi bi-patch-question';
                        break;

                case 34:
                        $categoryIcon = 'bi bi-prescription2';
                        break;

                case 35:
                        $categoryIcon = 'bi bi-pen-fill';
                        break;

                case 36:
                        $categoryIcon = 'bi bi-buildings';
                        break;

                case 37:
                        $categoryIcon = 'bi bi-motherboard';
                        break;

                case 38:
                        $categoryIcon = 'bi bi-ev-station';
                        break;

                case 39:
                        $categoryIcon = 'bi bi-wrench';
                        break;

                case 40:
                        $categoryIcon = 'bi bi-people-fill';
                        break;

                case 41:
                        $categoryIcon = 'bi bi-patch-question';
                        break;

                case 42:
                        $categoryIcon = 'bi bi-airplane';
                        break;
                }
    
    ?>

   <!-- CATEGORY + DESCRIPTION -->
    <div class="row">
        <div class="col-lg-12">
            <p ><i class="{{ $categoryIcon }} display-6"></i> <span class="display-6">{{ $datas->categoryVal }}</span>
            @if($datas->reqCondemn == 1)<span class="text-danger"> (Condemned)</span>@endif
            </p>
            <p style="font-size: 14px;" class="text-success ms-2 fw-bold">{{ $datas->agentAbbre }}</p>
            <p style="font-size: 12px;" class="ms-2">{{ $datas->reqDesc }}</p>
        </div>
    </div>


    <!-- REQUEST / ACTION / ACKNOWLEDGEMENT DATE -->
    <div class="row">
        <div class="col-lg-12">
            <ul class="lead ms-2" style="font-size:14px;">
                <li>Request Date: {{ $datas->reqDate }}</li>
                <li>Action Date Until: 
                    @if($datas->reqDuration != null) 
                        {{ $datas->reqDuration }}
                    @else
                        <span class="text-success">Indefinite</span>
                    @endif
                </li>
                <li>Acknowledgement Date: @if($datas->reqAcknowledge != null) {{ $datas->reqAcknowledge }} @else N/A @endif</li>
            </ul>

            <!-- ATTACHMENTS -->
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
                <button class="btn btn-secondary btn-sm ms-2 viewAttachment" id="{{ $datas->refID }}?{{ $datas->categoryVal }}?{{ Crypt::encrypt($datas->refID) }}"
                data-bs-toggle="modal" data-bs-target="#viewAttachmentModal">View Attachment</button>
            @endif

        </div>
   </div>

<!--  BUTTONS + LINES -->
    <div class="row">
        <!------------------------------------------------------------------ IF STATUS ACKNOWLEDGE SHOW ACKNOWLEDGE BUTTON --->
        @if($getStatus == 8)
        <div class="col-lg-2 p-1 ms-auto">
            <form action="/acknowledge_request" method="POST" id="clientAcknowledge_{{ preg_replace('/[^0-9]/', '', $datas->refID) }}-{{ $datas->categoryId }}">
                @csrf
                <input type="hidden" name="agentUnitID" value="{{ $datas->agentUnitID }}">
                <input type="hidden" name="requestDate" value="{{ $datas->reqDate }}">
                <input type="hidden" name="categoryID" value="{{ $datas->categoryId }}">
                <input type="hidden" name="requestBy" value="{{ $datas->requestBy }}">
                <input type="hidden" name="refID" value="{{ $datas->refID }}">
                <button class="btn btn-sm btn-success w-100 acknowledgeRequest" id="{{ $datas->refID }}?{{ $datas->categoryId }}">Acknowledge</button>
            </form>
        </div>

        <div class="col-lg-2 p-1">
            <button class="btn btn-sm btn-outline-secondary w-100 getUpdatesVal"
            data-bs-toggle="modal" data-bs-target="#updatesModal" id="{{ $datas->refID }}">Show Update</button>
        </div>
        <!------------------------------------------------------------------ IF STATUS COMPLETED SHOW UNDO BUTTON --->
        @elseif($getStatus == 6)
        <div class="col-lg-2 p-1 ms-auto">
            <form action="/undo_request_client" method="POST" id="clientUndo_{{ preg_replace('/[^0-9]/', '', $datas->refID) }}-{{ $datas->categoryId }}">
                @csrf
                <input type="hidden" name="agentUnitID" value="{{ $datas->agentUnitID }}">
                <input type="hidden" name="requestDate" value="{{ $datas->reqDate }}">
                <input type="hidden" name="categoryID" value="{{ $datas->categoryId }}">
                <input type="hidden" name="requestBy" value="{{ $datas->requestBy }}">
                <input type="hidden" name="refID" value="{{ $datas->refID }}">
                <button class="btn btn-sm btn-outline-danger w-100 undoRequestClient" id="{{ $datas->refID }}?{{ $datas->categoryId }}">Undo</button>
            </form>
        </div>

        <div class="col-lg-2 p-1">
            <button class="btn btn-sm btn-outline-secondary w-100 getUpdatesVal"
            data-bs-toggle="modal" data-bs-target="#updatesModal" id="{{ $datas->refID }}">Show Update</button>
        </div>

        @else
        <div class="col-lg-2 p-1 ms-auto">
            <button class="btn btn-sm btn-outline-secondary w-100 getUpdatesVal"
            data-bs-toggle="modal" data-bs-target="#updatesModal" id="{{ $datas->refID }}">Show Update</button>
        </div>
        @endif

        <div class="col-lg-2 p-1">
            <button class="btn  btn-sm btn-outline-secondary w-100 getActionTakenVal"  
            data-bs-toggle="modal" data-bs-target="#actionTakenModal" id="{{ $datas->refID }}">Show Actions</button>
        </div>

        @if($getStatus == 2)
        <div class="col-lg-1 p-1">
            <form action="{{ route('clientCancelRequest') }}" method="POST" id="clientCancelReq_{{ preg_replace('/[^0-9]/', '', $datas->refID) }}-{{ $datas->categoryId }}">
                @csrf
                <input type="hidden" name="getRefID" value="{{ $datas->refID }}">
                <input type="hidden" name="agentUnitID" value="{{ $datas->agentUnitID }}">
                <input type="hidden" name="requestDate" value="{{ $datas->reqDate }}">
                <input type="hidden" name="categoryID" value="{{ $datas->categoryId }}">
                <input type="hidden" name="requestBy" value="{{ $datas->requestBy }}">
                <button class="btn  btn-sm btn-outline-danger w-100 cancelRequest" id="{{ $datas->refID }}?{{ $datas->categoryId }}">Cancel</button>
            </form>
        </div>
        @endif
   </div>


   <div class="row">
    <div class="col-lg-12">
             <hr class="text-secondary mt-2 shadow-lg">
    </div>
   </div>



@endforeach
</div><!-- EOF CLIENT LIST -->

<!---------------------------------------------------------------------------------------------------->

@include('partials.cancel_request')

@include('client.modals.modal_view_attachment')

@include('partials.acknowledge_request')

@include('partials.undo_request_client')