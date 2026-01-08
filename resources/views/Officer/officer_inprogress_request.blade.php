@include('partials.header')

@include('partials.sidebar_officer')

<main class="content  vh-100">
<div class="container-fluid">

@include('partials.officer_top_display')

<!--Current PAGE-->
<div class="row">
    <div class="col-lg-12">
        <div class="lead fw-bold"><i class="bi bi-clipboard-data"></i> In-Progress</div>
    </div>
</div>
<!--Current PAGE-->

<div class="border border-2 rounded p-2 border-end-0 border-start-0 border-success">

@include('officer.officer_filter_inprogress')

</div> <!--EOF BORDER-->

 @include('officer.officer_table_inprogress')

</div> <!--EOF CONTAINER FLUID-->
</main>

@include('officer.modals.modal_action_taken_officer')

@include('officer.modals.modal_cancel_request')

@include('client.modals.modal_view_attachment')

@include('officer.modals.modal_new_action')

@if(Auth::user()->agentunit_id == 1)
    @include('officer.modals.modal_service_report')
@else
    @include('officer.modals.modal_condemn_request')
@endif

@include('officer.modals.modal_update_category')

@include('partials.modal_seemore')

@include('partials.footer')

