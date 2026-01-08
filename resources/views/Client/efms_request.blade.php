    <!--EFMS SERVICE REQUEST-->
    <div class="accordion-item my-4 shadow">

        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#efms" aria-expanded="false" aria-controls="collapseOne">
            <p class=""><span class="fw-bold">EFMS</span> - Engineering & Facilities Management Section <i class="bi bi-caret-down-fill"></i></p>
            </button>
        </h2>

        <div id="efms" class="accordion-collapse collapse" data-bs-parent="#accMain">

            <div class="accordion-body">
                    
                <div class="accordion accordion-flush" id="efmsMainCategory"> <!--ACCORDION PARENT EFMS --->
                <?php $currentMainCategory = ""; ?>

                <?php $rowCounter = 1; ?>
                @foreach($efmsData as $d)
                    
                        @if($currentMainCategory != $d->main_category)

                            <?php $rowCounter = 1; ?>
                            @if($currentMainCategory != '')
                                </div><!-- EOF ACCORDION ITEM --->   
                            @endif

                            <?php $currentMainCategory = $d->main_category; ?>

                            <div class="accordion-item" style="font-size: 10px;">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_{{ str_replace(' ' , '' , $d->main_category) }}" aria-expanded="false" aria-controls="flush-collapseOne">
                                        • {{ $d->main_category }} <i class="bi bi-caret-down-fill"></i>
                                    </button>
                                </h2>

                                @if($rowCounter==1)
                                    <div class="row text-center mainIcon">
                                @endif

                                @if( $rowCounter==5 )
                                    <?php $rowCounter = 1; ?>
                                    </div><!--EOF ROW-->

                                    <div class="row text-center mainIcon">
                                        <div class="col-md-3 col-sm-6">
                                            <div id="flush-collapseOne_{{ str_replace(' ' , '' , $d->main_category) }}" class="accordion-collapse collapse" data-bs-parent="#efmsMainCategory">
                                                <div class="accordion-body">
                                                    <a href="#" class="text-dark all_request_class" id="EFMS,,{{ $d->main_category }},,{{ $d->category_value }},,{{ $d->repairtype_time }},,{{ $d->category_id }}"
                                                    data-bs-toggle="modal" data-bs-target="#createServiceRequestModal">
                                                        <i class="{{ $d->category_icon }}"></i>
                                                        <p>{{ $d->category_value }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                @else
                                    <div class="col-md-3 col-sm-6">
                                        <div id="flush-collapseOne_{{ str_replace(' ' , '' , $d->main_category) }}" class="accordion-collapse collapse" data-bs-parent="#efmsMainCategory">
                                            <div class="accordion-body">
                                                <a href="#" class="text-dark all_request_class" id="EFMS,,{{ $d->main_category }},,{{ $d->category_value }},,{{ $d->repairtype_time }},,{{ $d->category_id }}"
                                                data-bs-toggle="modal" data-bs-target="#createServiceRequestModal">
                                                    <i class="{{ $d->category_icon }}"></i>
                                                    <p>{{ $d->category_value }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
 
                        @else
                                @if($rowCounter==1)
                                    <div class="row text-center mainIcon">
                                @endif

                                @if( $rowCounter==5 )
                                    <?php $rowCounter = 1; ?>
                                    </div><!--EOF ROW-->

                                        <div class="row text-center mainIcon">
                                        <div class="col-md-3 col-sm-6">
                                            <div id="flush-collapseOne_{{ str_replace(' ' , '' , $d->main_category) }}" class="accordion-collapse collapse" data-bs-parent="#efmsMainCategory">
                                                <div class="accordion-body">
                                                    <a href="#" class="text-dark all_request_class" id="EFMS,,{{ $d->main_category }},,{{ $d->category_value }},,{{ $d->repairtype_time }},,{{ $d->category_id }}"
                                                    data-bs-toggle="modal" data-bs-target="#createServiceRequestModal">
                                                        <i class="{{ $d->category_icon }}"></i>
                                                        <p>{{ $d->category_value }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                @else
                                    <div class="col-md-3 col-sm-6">
                                        <div id="flush-collapseOne_{{ str_replace(' ' , '' , $d->main_category) }}" class="accordion-collapse collapse" data-bs-parent="#efmsMainCategory">
                                            <div class="accordion-body">
                                                <a href="#" class="text-dark all_request_class"
                                                        id="EFMS,,{{ $d->main_category }},,{{ $d->category_value }},,{{ $d->repairtype_time }},,{{ $d->category_id }}"
                                                        data-bs-toggle="modal" data-bs-target="#createServiceRequestModal">
                                                        <i class="{{ $d->category_icon }}"></i>
                                                    <p>{{ $d->category_value }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                        @endif

                <?php $rowCounter++; ?>
                @endforeach
                        </div><!--EOF ROW-->
                    </div><!-- EOF ACCORDION ITEM --->  
                </div><!-- EOF ACCORDION PARENT EFMS --->
 
            </div>
        </div>
    </div> <!--EOF EFMS SERVICE REQUEST-->
</div>
<!--EOF ACCORDION PARENT FOR IMISS AND EFMS-->


</div>
</div>