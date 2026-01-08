   <?php use Illuminate\Support\Str ?>
   <?php use Carbon\Carbon; ?>
   
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
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="table-group-divider" id="officer_table_open_tbody">

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

                    if($datas->until != ''){

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
                <tr style="font-size: 12px;">
                    <td class="fw-bold text-success" style="font-size: 11px;">{{ $counter }}.</td>
                    <?php $counter++; ?>
                    <td style="color: {{$txtColor}};">{{ $datas->refNo }}</td>
                    <td style="color: {{$txtColor}};">{{ $datas->reqDate }}</td>
                    <td style="color: {{$txtColor}};">             
                        @if($datas->until != '')
                            {{ $datas->until }}
                        @else
                            Indefinite
                        @endif</td>
                    <td style="max-width: 120px; color: {{$txtColor}};">{{ $datas->categoryVal }}</td>
                    <td style="color: {{$txtColor}};">{{ $datas->requestBy }}</td>
                    <td style="max-width: 150px; color: {{$txtColor}};">{{ $datas->sectionName }}</td>
                    <td style="color: {{$txtColor}};">{{ $datas->locationVal }}</td>
                    <td style="color: {{$txtColor}};">{{ $datas->bldgFloorVal }}</td>

                    <td style="max-width: 110px; color: {{$txtColor}};">
                        {{ Str::limit($datas->reqDesc , 18 , '...') }}
                        <?php  $countDescription = mb_strlen( $datas->reqDesc ); ?>
                        @if ($countDescription >= 18)
                            <span class="cursorPointer text-success text-decoration-underline seeMoreClass"
                            data-bs-toggle="modal" data-bs-target="#modalSeemore" id='Description,,{{ str_replace(",," , ".." , $datas->reqDesc) }},,{{ $datas->refNo }}'>See more</span>
                        @endif
                    </td>

                    <td style="color: {{$txtColor}};">
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

                    <td class="">

                        <div class="btn-group dropstart" style="width: 100%;">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle actionBtnForAutoHeight" 
                            data-bs-toggle="dropdown" aria-expanded="false">Actions</button>

                            <ul class="dropdown-menu" style="font-size: 14px;">

                                @if(Auth::user()->usertype_id == 1)
                                <li><a class="dropdown-item distributeRequestGetRefID" href="#" id="{{ $datas->refNo }},,{{ $datas->categoryVal }}"
                                data-bs-toggle="modal" data-bs-target="#distributeRequest"><i class="bi bi-arrow-left-right"></i> Distribute Request </a></li>
                                @endif

                                <form action="/assign_staff" method="POST" id="takeRequestForm_{{ preg_replace('/[^0-9]/', '', $datas->refNo) }}-{{ $datas->categoryId }}">
                                    @csrf
                                    <input type="hidden" name="getTakenByName" value="{{ Auth::user()->account_fname }} {{Auth::user()->account_lname}}">
                                    <input type="hidden" name="getCategoryVal" value="{{ $datas->categoryVal }}">
                                    <input type="hidden" name="getRefID" value="{{ $datas->refNo }}">
                                    <input type="hidden" name="getStaffID" value="{{ session('account_empid') }}">
                                    <li>
                                        <a class="dropdown-item takeRequest" href="#" id="{{ $datas->refNo }}?{{ $datas->categoryId }}"><i class="bi bi-hand-thumbs-up-fill"></i> Take Request 
                                        </a>
                                    </li>
                                </form>

                                <li>
                                    <a class="dropdown-item officerCancelReqBtn" href="#" id="{{ $datas->refNo }},,{{ $datas->categoryVal }}"
                                    data-bs-toggle="modal" data-bs-target="#officerCancelRequest"><i class="bi bi-x-square"></i> Cancel Request 
                                    </a>
                                </li>

                                <li><a class="dropdown-item updateCategoryClassBtn" href="#" 
                                id="{{ $datas->refNo }},,{{ $datas->categoryVal }},,{{ $datas->reqDesc }},,{{ $datas->categoryId }},,{{ $datas->reqDate }}"
                                data-bs-toggle="modal" data-bs-target="#modalUpdateCategory"
                                ><i class="bi bi-arrow-up-right-square-fill"></i> Update Category </a></li>

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

    <nav class="">
            {{ $data->links()  }}
    </nav>

</div> <!--EOF TABLE RESPONSIVE -->

