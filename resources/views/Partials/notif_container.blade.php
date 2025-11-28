 <?php use Illuminate\Support\Facades\Request; ?>

<!--div class="row" style="position: absolute; bottom: 0px; right: 10px; max-width: 500px; overflow: auto; max-height: 100%;"-->
<div class="position-fixed bottom-0 end-0" style="max-width: 400px; overflow-y: auto; overflow-x:hidden; max-height: 100%; z-index: 2000;">
<div class="row">
    <div class="col-md-12" id="notifContainer" style="font-size: 13px;">
    </div>
</div>
</div>

<script>
/*
$(document).on('click', '.alert', function() {
    $(this).fadeOut();
});
*/
let currentURL = "{{ Request::path() }}";
let accountID = "{{ Auth::user()->account_empid }}";

let socket;
const RECONNECT_DELAY = 2000; // 2 seconds
const HEARTBEAT_INTERVAL = 30000; // 30 seconds
let appKey = "qefxx2lpwsoxttgzci9f";

    function connectReverb(){

        ///////////////////////////////////////////////// INITIALIZING WEB SOCKET
        socket = new WebSocket("ws://192.168.14.114:8080/app/"+appKey);

        /////////////////////////////////////////////////SOCKET ON OPEN
        socket.onopen = function() {
            console.log("Connected to Reverb");

            // Heartbeat to keep connection alive
            setInterval(() => {
                if(socket.readyState === WebSocket.OPEN){
                    socket.send(JSON.stringify({ event: "pusher:ping", data: {} })); // FOR RECONNECTING EVERY 30SEC
                    //console.log( "Pinging every 30sec" );
                }
            }, HEARTBEAT_INTERVAL);
        };

        ///////////////////////////////////////////////// SOCKET ON MESSAGE
        socket.onmessage = function(event){
            const msg = JSON.parse(event.data);

            //const data = JSON.parse(msg.data);
            let data;
            let socketId;
                try {
                    if (msg.data) {
                            data = JSON.parse(msg.data);
                            socketId = data.socket_id;
                        }
                    } catch (e) {
                        return;
                    }

            if (!msg.event) return;
            //console.log("Socket ID:", socketId);
            ///////////////////////////////////////////////// AJAX TO AUTHENTICATE USER FOR PRIVATE CHANNEL
            if (msg.event === "pusher:connection_established") {
                $.ajax({
                    url: "{{ url('/broadcasting/auth') }}",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    contentType: "application/json",
                    data: JSON.stringify({
                        channel_name: "private-user." + accountID,
                        socket_id: socketId
                    }),
                    success: function(authData) {
                        console.log("Auth OK", authData);
                        socket.send(JSON.stringify({
                            event: "pusher:subscribe",
                            data: {
                                auth: authData.auth,
                                channel: "private-user." + accountID
                            }
                        }));
                    },
                    error: function(xhr) {
                        console.error("Auth failed", xhr.status, xhr.responseText);
                    }
                });

            }

            ///////////////////////////////////////////////// FIRING NOTIFICATION
            
            if(msg.event === "UserNotification"){

                console.log(msg.event);

                const payload = JSON.parse(msg.data);
                let userTypeID = "{{ Auth::user()->usertype_id }}";
                //console.log(payload);
                $("#notifContainer").prepend(`<div class="alert alert-success 
                alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" 
                aria-label="Close"></button><p><i class="bi bi-info-circle-fill pe-2" style="font-size: 20px;"></i>${payload.msg}</p></div>`);

                if(
                    currentURL == 'officer_open_request' ||
                    currentURL == 'officer_inprogress_request' ||
                    currentURL == 'officer_acknowledge_request' ||
                    currentURL == 'officer_completed_request' ||
                    currentURL == 'officer_cancelled_request' 
                ){

                    let status;
                    let tableNameToUpdate;
                    if(currentURL == 'officer_open_request'){
                        status = 2;
                        tableNameToUpdate = '#officer_table_open_tbody';

                        $('#tHeadForAll').html(`<tr class="font11px"><th>#</th>
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
                            <th class="text-center">Actions</th></tr>`
                        );
                    }
                    if(currentURL == 'officer_inprogress_request'){
                        status = 5;
                        tableNameToUpdate = '#officer_table_inprogress_tbody';

                        $('#tHeadForAll').html(`<tr class="font11px"><th>#</th>
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
                            <th class="text-center">Actions</th></tr>`
                        );
                    }
                    if(currentURL == 'officer_acknowledge_request'){
                        status = 8;
                        tableNameToUpdate = '#officer_table_acknowledge_tbody';

                        $('#tHeadForAll').html(`<tr class="font11px"><th>#</th>
                            <th>Reference#</th>
                            <th>Request-Date</th>
                            <th>Until</th>
                            <th>Accomplished</th>
                            <th>Category</th>
                            <th>Request-By</th>
                            <th>Section</th>
                            <th>Description</th>
                            <th>Equip-Details</th>
                            <th>Action-Taken</th>
                            <th class="text-center">Actions</th></tr>`
                        );
                    }
                    if(currentURL == 'officer_completed_request'){
                        status = 6;
                        tableNameToUpdate = '#officer_table_completed_tbody';

                        $('#tHeadForAll').html(`<tr style="font-size: 11px;"><th>#</th>
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
                            <th class="text-center">Actions</th></tr>`
                        );
                    }
                    if(currentURL == 'officer_cancelled_request'){
                        status = 7;
                        tableNameToUpdate = '#officer_table_cancelled_tbody';

                        $('#tHeadForAll').html(`<tr class="font11px"><th>#</th>
                            <th>Reference#</th>
                            <th>Request-Date</th>
                            <th>Cancelled</th>
                            <th>Category</th>
                            <th>Request-By</th>
                            <th>Section</th>
                            <th>Description</th>
                            <th>Equip-Details</th>
                            <th>Action-Taken</th>
                            <th class="text-center">Actions</th></tr>`
                        );
                    }
                    console.log(tableNameToUpdate);
                    $.ajax({
                            url: "{{ route('ajaxOfficerRefreshTable') }}",
                            type: "POST",
                            data: {
                                getStatus: status,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                //console.log(res);
                                $(tableNameToUpdate).empty();

                                $.each(JSON.parse(res) , function(i , item){

                                    //LIMIT TO 10 RECORDS ONLY
                                    if(i >= 10){
                                        return false;
                                    }

                                    let shortDescription = item.reqDesc;
                                    let actionTakenVal = 'N/A';
                                    
                                    let equiDetails;
                                    if(item.eq1 == '' || 
                                    item.eq2 == '' || 
                                    item.eq3 == '' || 
                                    item.eq4 == '' ||
                                    item.eq1 == null || 
                                    item.eq2 == null || 
                                    item.eq3 == null || 
                                    item.eq4 == null){
                                        equiDetails = 'Not included';
                                    }
                                    else{
                                        equiDetails = item.eq1 +' '+ item.eq2+' '+ item.eq3 +' '+ item.eq4;
                                    }

                                    let csrf = '{{ csrf_token() }}';
                                    let row =
                                        `<tr style="font-size: 12px;">
                                            <td class="fw-bold text-success" style="font-size: 11px;">${i+1}.</td>
                                            <td>${item.refNo}</td>
                                            <td>${item.reqDate}</td>


                                            ${ currentURL == 'officer_cancelled_request' ?
                                                `<td>${item.cancelledDate}</td>`
                                            :
                                                `<td>${item.until == '' || item.until == null ? 'Indefinite' : item.until}</td>`
                                            }

                                            ${ currentURL == 'officer_acknowledge_request' ?
                                                `<td>${item.accomplishedDate}</td>`
                                            :
                                                ''
                                            }

                                            ${ currentURL == 'officer_completed_request' ?
                                                `<td>${item.acknowledgementDate}</td>`
                                            :
                                                ''
                                            }

                                            <td style="max-width: 120px;">${item.categoryVal}</td>
                                            <td>${item.requestBy}</td>
                                            <td>${item.sectionName}</td>

                                            ${ currentURL != 'officer_completed_request' && 
                                             currentURL != 'officer_acknowledge_request' &&
                                             currentURL != 'officer_cancelled_request' ?
                                                `<td>${item.locationVal}</td>
                                                <td>${item.bldgFloorVal}</td>`
                                            :
                                                ''
                                            }

                                            <td>
                                                ${
                                                    shortDescription.length >= 18 
                                                    ? 
                                                    `${shortDescription.substr(0,18)}...<br>
                                                    <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                                                    data-bs-toggle="modal" data-bs-target="#modalSeemore" 
                                                    id='Description,,${item.reqDesc},,${item.refNo}'>See more</span>`
                                                    :
                                                    shortDescription
                                                }
                                            </td>
                                            <td>
                                                ${
                                                equiDetails.length >= 18
                                                ?
                                                    `${equiDetails.substr(0,18)}...<br>
                                                    <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                                                    data-bs-toggle="modal" data-bs-target="#modalSeemore" 
                                                    id='Equipment Details,,${equiDetails},,${item.refNo}'>See more</span>`
                                                :
                                                   equiDetails
                                                }
                                            </td>


                                            ${  currentURL == 'officer_completed_request' ||
                                                currentURL == 'officer_acknowledge_request' ||
                                                currentURL == 'officer_inprogress_request' ||
                                                currentURL == 'officer_cancelled_request' 
                                            ?
                                                `${item.actionTaken == null || item.actionTaken == '' ? actionTakenVal = 'N/A' : actionTakenVal = item.actionTaken }
                                                
                                                <td style="max-width: 110px;">
                                                    ${actionTakenVal.length >= 18 ?
                                                        `${actionTakenVal.substr(0,18)}...<span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                                                        data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Action Taken,,${item.actionTaken},,${item.refNo}'>See more</span>`
                                                    : actionTakenVal}
                                                </td>`

                                            : ''
                                            }

                                            <td>
                                                <div class="btn-group dropstart" style="width: 100%;">
                                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle actionBtnForAutoHeight" 
                                                    data-bs-toggle="dropdown" aria-expanded="false">Actions</button>

                                                    <ul class="dropdown-menu" style="font-size: 14px;">

                                                    
                                                    ${ currentURL == 'officer_open_request' ?

                                                        `<li><a class="dropdown-item distributeRequestGetRefID" href="#" id="${item.refNo}"
                                                        data-bs-toggle="modal" data-bs-target="#distributeRequest"><i class="bi bi-arrow-left-right"></i> Distribute Request </a></li>

                                                            <form action="/assign_staff" method="POST" id="takeRequestForm_${ item.refNo.replace(/[^0-9]/g,'') }-${ item.categoryId }">                                                                          
                                                                @csrf
                                                                <input type="hidden" name="getCategoryID" value="${item.categoryId}">
                                                                <input type="hidden" name="getRefID" value="${item.refNo}">
                                                                <input type="hidden" name="getStaffID" value="{{ session('account_empid') }}">
                                                                <li>
                                                                    <a class="dropdown-item takeRequest" href="#" id="${item.refNo}?${item.categoryId}"><i class="bi bi-hand-thumbs-up-fill"></i> Take Request 
                                                                    </a>
                                                                </li>
                                                            </form>

                                                            <li>
                                                                <a class="dropdown-item officerCancelReqBtn" href="#" id="${item.refNo}"
                                                                data-bs-toggle="modal" data-bs-target="#officerCancelRequest"><i class="bi bi-x-square"></i> Cancel Request 
                                                                </a>
                                                            </li>`
                                                    : 

                                                    currentURL == 'officer_inprogress_request' ?

                                                        `<li><a class="dropdown-item officerAddActionBtn" href="#" id="${item.refNo}"
                                                            data-bs-toggle="modal" data-bs-target="#officerNewActionModal"><i class="bi bi-file-plus"></i> New Action </a></li>

                                                            <li><a class="dropdown-item updateCategoryClassBtn" href="#" 
                                                            id="${item.refNo},,${item.categoryVal},,${item.reqDesc},,${item.categoryId},,${item.reqDate}"
                                                            data-bs-toggle="modal" data-bs-target="#modalUpdateCategory"
                                                            ><i class="bi bi-arrow-up-right-square-fill"></i> Update Category </a></li>


                                                            <li><a class="dropdown-item officerCondemnRequestBtn" href="#" 
                                                            id="${item.refNo},,${item.eq1},,${item.eq2},,${item.eq3},,${item.eq4}"
                                                            data-bs-toggle="modal" data-bs-target="#officerCondemnModal"><i class="bi bi-bell-slash-fill"></i> Condemn </a></li>


                                                            <form action="/done_request" method="POST" id="doneRequestForm_${ item.refNo.replace(/[^0-9]/g,'') }-${item.categoryId}">
                                                            @csrf
                                                            <input type="hidden" name="categoryVal" value="${item.categoryVal}">
                                                            <input type="hidden" name="officerFullName" value="{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}">
                                                            <input type="hidden" name="refID" value="${item.refNo}">
                                                            <input type="hidden" name="agentStaffID" value="{{ session('account_empid') }}">
                                                                <li><a class="dropdown-item doneRequest" href="#" id="${item.refNo}?${item.categoryId}"><i class="bi bi-send-check-fill"></i> Done </a></li>
                                                            </form>

                                                            <li>
                                                                <form action="/reopen_request" method="POST" id="formReopen_${ item.refNo.replace(/[^0-9]/g,'') }-${item.categoryId}">
                                                                    @csrf
                                                                    <input type="hidden" name="categoryVal" value="${item.categoryVal}">
                                                                    <input type="hidden" name="getRefID" value="${item.refNo}">
                                                                    <input type="hidden" name="officerFullName" value="{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}">
                                                                    <a class="dropdown-item reopenRequest" 
                                                                    href="#" id="${item.refNo}?${item.categoryId}"><i class="bi bi-envelope-open"></i> Re-Open 
                                                                    </a>
                                                                </form>
                                                            </li>

                                                            <li>
                                                                <a class="dropdown-item officerCancelReqBtn" href="#" id="${item.refNo}"
                                                                data-bs-toggle="modal" data-bs-target="#officerCancelRequest"><i class="bi bi-x-square"></i> Cancel Request 
                                                                </a>
                                                            </li>`
                                                    :

                                                    currentURL == 'officer_acknowledge_request' ? 

                                                        `<li><a class="dropdown-item officerAddActionBtn" href="#" id="${item.refNo}"
                                                        data-bs-toggle="modal" data-bs-target="#officerNewActionModal"><i class="bi bi-file-plus"></i> New Action </a></li>

                                                        <li><a class="dropdown-item tagAgentButtonInTable" href="#"
                                                        id="${item.refNo},,${item.categoryVal}" data-bs-toggle="modal" data-bs-target="#tagAgentModal">
                                                        <i class="bi bi-person-fill-add"></i> Tag Agents </a></li>

                                                        <form action="/undo_request" method="POST" id="undoRequestForm_${ item.refNo.replace(/[^0-9]/g,'') }-${ item.categoryId }">
                                                            @csrf
                                                            <input type="hidden" name="categoryVal" value="${item.categoryVal}">
                                                            <input type="hidden" name="officerFullName" value="{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}">
                                                            <input type="hidden" name="refID" value="${item.refNo}">
                                                            <input type="hidden" name="agentStaffID" value="{{ session('account_empid') }}">
                                                            <li><a class="dropdown-item undoRequest" href="#" id="${item.refNo}?${ item.categoryId }"><i class="bi bi-arrow-counterclockwise"></i> Undo </a></li>
                                                        </form>`

                                                    :

                                                    currentURL == 'officer_completed_request' ? 

                                                        `<li><a class="dropdown-item officerAddActionBtn" href="#" id="${item.refNo}"
                                                            data-bs-toggle="modal" data-bs-target="#officerNewActionModal"><i class="bi bi-file-plus"></i> New Action </a></li>

                                                            <li><a class="dropdown-item tagAgentButtonInTable" href="#"
                                                            id="${item.refNo},,${item.categoryVal}" data-bs-toggle="modal" data-bs-target="#tagAgentModal">
                                                            <i class="bi bi-person-fill-add"></i> Tag Agents </a></li>

                                                            <form action="/undo_request" method="POST" id="undoRequestForm_${ item.refNo.replace(/[^0-9]/g,'') }-${ item.categoryId }">
                                                            @csrf
                                                            <input type="hidden" name="categoryVal" value="${item.categoryVal}">
                                                            <input type="hidden" name="officerFullName" value="{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}">
                                                            <input type="hidden" name="refID" value="${item.refNo}">
                                                            <input type="hidden" name="agentStaffID" value="{{ session('account_empid') }}">
                                                            <li><a class="dropdown-item undoRequest" href="#" id="${item.refNo}?${ item.categoryId }"><i class="bi bi-arrow-counterclockwise"></i> Undo </a></li>
                                                            </form>

                                                            ${item.condemn == 1 ? 
                                                                `<li><a class="dropdown-item" href="/condemn_form/${item.refNo}" target="blank"><i class="bi bi-file-x-fill"></i> Show Condemn Form</a></li>`
                                                            : ''}`
                                                     
                                                    :

                                                    currentURL == 'officer_cancelled_request' ? 

                                                        `<li><a class="dropdown-item officerAddActionBtn" href="#" id="${item.refNo}"
                                                        data-bs-toggle="modal" data-bs-target="#officerNewActionModal"><i class="bi bi-file-plus"></i> New Action </a></li>

                                                        <li><a class="dropdown-item tagAgentButtonInTable" href="#"
                                                        id="${item.refNo},,${item.categoryVal}" data-bs-toggle="modal" data-bs-target="#tagAgentModal">
                                                        <i class="bi bi-person-fill-add"></i> Tag Agents </a></li>`
                                                    : '' 
                                                    }

                                                            ${ 
                                                                (item.categoryVal == 'Biometrics Enrollment' ||
                                                                item.categoryVal == 'HOMIS Encoding Error' ||
                                                                item.categoryVal == 'Network Installation / Internet Connection / Cable Transfer' ||
                                                                item.categoryVal == 'Zoom Link' ||
                                                                item.categoryVal == 'Website Uploads' ||
                                                                item.categoryVal == 'System Enhancement / Modification / Homis / Other Installation' ||
                                                                item.categoryVal == 'VMC ID Card Preparation' ||
                                                                item.categoryVal == 'Travel Conduction') 
                                                                ?
                                                                `<li><a href="#" class="dropdown-item viewAttachment" id="${item.refNo}?${item.categoryVal}?${item.encryptedRefID}"
                                                                data-bs-toggle="modal" data-bs-target="#viewAttachmentModal"><i class="bi bi-paperclip"></i> View Attachment </a></li>`
                                                                :
                                                                ''
                                                            }      
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>`;
                                        $(tableNameToUpdate).append(row);
                                });
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });//EOF AJAX
                }//EOF CURRENT URL officer_open


                if(currentURL != 'client_dashboard'){

                    let getStatus;
                    if(currentURL == 'client_open_request'){
                        getStatus = 2;
                    }
                    if(currentURL == 'client_inprogress_request'){
                        getStatus = 5;
                    }
                    if(currentURL == 'client_acknowledge_request'){
                        getStatus = 8;
                    }
                    if(currentURL == 'client_completed_request'){
                        getStatus = 6;
                    }
                    if(currentURL == 'client_cancelled_request'){
                        getStatus = 7;
                    }

                    $.ajax({
                            url: "{{ route('ajaxClientList') }}",
                            type: "POST",
                            data: {
                                status: getStatus,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {

                                $('#clientList').empty();
                                //$('.clientList div').empty();

                                $.each(JSON.parse(res) , function(i , item){

                                    let csrf = '{{ csrf_token() }}';
                                   
                                    let row =
                                        `<div class="row mt-4">
                                                    <div class="col-lg-6">
                                                        <p class="lead">Reference#: <span class="lead text-success fw-bold">${item.refID}</span> </p>
                                                    </div>

                                                    <div class="col-lg-6 ms-auto text-end">
                                                        ${
                                                            item.actionOfficer != null
                                                            ? 
                                                            `<p>Action Officer: <span class="text-success">${item.actionOfficer}</span></p>`
                                                            :
                                                            `<p class="">Action Officer: <span class="text-danger">Waiting...</span></p>`
                                                        }
                                                    </div>
                                            </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <p><i class="${item.categoryIcon} display-6"></i> <span class="display-6">${item.categoryVal}</span>
                                                        ${
                                                            item.reqCondemn == 1 ? `<span class="text-danger"> (Condemned)</span>` : ''
                                                        }
                                                        </p>
                                                        <p style="font-size: 14px;" class="text-success ms-2 fw-bold">${item.agentAbbre}</p>
                                                        <p style="font-size: 12px;" class="ms-2">${item.reqDesc}</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <ul class="lead ms-2" style="font-size:14px;">
                                                            <li>Request Date: ${item.reqDate}</li>
                                                            <li>Action Date Until: 
                                                                ${
                                                                    item.reqDuration != null ? item.reqDuration : `<span class="text-success">Indefinite</span>`
                                                                }
                                                            </li>
                                                            <li>
                                                                Acknowledgement Date: ${ item.reqAcknowledge != null ? item.reqAcknowledge : 'N/A'}
                                                            </li>
                                                        </ul>

                                                        ${
                                                            (
                                                                item.categoryVal == 'Biometrics Enrollment' ||
                                                                item.categoryVal == 'HOMIS Encoding Error' ||
                                                                item.categoryVal == 'Network Installation / Internet Connection / Cable Transfer' ||
                                                                item.categoryVal == 'Zoom Link' ||
                                                                item.categoryVal == 'Website Uploads' ||
                                                                item.categoryVal == 'System Enhancement / Modification / Homis / Other Installation' ||
                                                                item.categoryVal == 'VMC ID Card Preparation' ||
                                                                item.categoryVal == 'Travel Conduction'
                                                            )
                                                            ?
                                                            `<button class="btn btn-secondary btn-sm ms-2 viewAttachment" 
                                                            id="${item.refID}?${item.categoryVal}?${item.encryptedRefID}"
                                                            data-bs-toggle="modal" data-bs-target="#viewAttachmentModal">View Attachment</button>`
                                                            :
                                                            ''
                                                        }

                                                    </div>
                                            </div>

                                                <div class="row">
                                                    ${item.statusVal == 'Acknowledge' 
                                                    ?
                                                        `<div class="col-lg-2 p-1 ms-auto">
                                                            <form action="/acknowledge_request" method="POST" id="clientAcknowledge_${item.refID.replace(/[^0-9]/g,'')}-${item.categoryId}">
                                                                @csrf
                                                                <input type="hidden" name="refID" value="${item.refID}">
                                                                    <input type="hidden" name="agentUnitID" value="${item.agentUnitID}">
                                                                    <input type="hidden" name="requestDate" value="${item.reqDate}">
                                                                    <input type="hidden" name="categoryID" value="${item.categoryId}">
                                                                    <input type="hidden" name="requestBy" value="${item.requestBy}">
                                                                <button class="btn btn-sm btn-success w-100 acknowledgeRequest" id="${item.refID}?${item.categoryId}">Acknowledge</button>
                                                            </form>
                                                        </div>

                                                        <div class="col-lg-2 p-1">
                                                            <button class="btn btn-sm btn-outline-secondary w-100 getUpdatesVal"
                                                            data-bs-toggle="modal" data-bs-target="#updatesModal" id="${item.refID}">Show Update</button>
                                                        </div>`
                                                    :
                                                    item.statusVal == 'Completed'
                                                    ?
                                                        `<div class="col-lg-2 p-1 ms-auto">
                                                            <form action="/undo_request_client" method="POST" id="clientUndo_${item.refID.replace(/[^0-9]/g,'')}-${item.categoryId}">
                                                                @csrf
                                                                <input type="hidden" name="refID" value="${item.refID}">
                                                                    <input type="hidden" name="agentUnitID" value="${item.agentUnitID}">
                                                                    <input type="hidden" name="requestDate" value="${item.reqDate}">
                                                                    <input type="hidden" name="categoryID" value="${item.categoryId}">
                                                                    <input type="hidden" name="requestBy" value="${item.requestBy}">
                                                                <button class="btn btn-sm btn-outline-danger w-100 undoRequestClient" id="${item.refID}?${item.categoryId}">Undo</button>
                                                            </form>
                                                        </div>

                                                        <div class="col-lg-2 p-1">
                                                            <button class="btn btn-sm btn-outline-secondary w-100 getUpdatesVal"
                                                            data-bs-toggle="modal" data-bs-target="#updatesModal" id="${item.refID}">Show Update</button>
                                                        </div>`
                                                    :
                                                    `<div class="col-lg-2 p-1 ms-auto">
                                                            <button class="btn btn-sm btn-outline-secondary w-100 getUpdatesVal"
                                                            data-bs-toggle="modal" data-bs-target="#updatesModal" id="${item.refID}">Show Update</button>
                                                        </div>`
                                                    }

                                                    <div class="col-lg-2 p-1">
                                                        <button class="btn  btn-sm btn-outline-secondary w-100 getActionTakenVal"  
                                                        data-bs-toggle="modal" data-bs-target="#actionTakenModal" id="${item.refID}">Show Actions</button>
                                                    </div>

                                                    ${ item.statusVal == 'Open' 
                                                    ?
                                                    `<div class="col-lg-1 p-1">
                                                        <form action="{{ route('clientCancelRequest') }}" method="POST" id="clientCancelReq_${item.refID.replace(/[^0-9]/g,'')}-${item.categoryId}">
                                                            @csrf
                                                            <input type="hidden" name="getRefID" value="${item.refID}">
                                                                <input type="hidden" name="agentUnitID" value="${item.agentUnitID}">
                                                                <input type="hidden" name="requestDate" value="${item.reqDate}">
                                                                <input type="hidden" name="categoryID" value="${item.categoryId}">
                                                                <input type="hidden" name="requestBy" value="${item.requestBy}">
                                                            <button class="btn  btn-sm btn-outline-danger w-100 cancelRequest" id="${item.refID}?${item.categoryId}">Cancel</button>
                                                        </form>
                                                    </div>`
                                                    :
                                                    ''
                                                    }
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                        <hr class="text-secondary mt-2 shadow-lg">
                                                </div>
                                            </div>
                                        </div><!-- EOF CLIENT LIST -->`;

                                $('#clientList').append(row);
                            });
                        }, 
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });//EOF AJAX

                }//EOF CURRENT URL client_open_request

            }

        };

        socket.onclose = function(){
            console.log("Disconnected. Reconnecting...");
            setTimeout(connectReverb, 5000);
        };
    }

    connectReverb(); //CALLING THE FUNCTION
</script>