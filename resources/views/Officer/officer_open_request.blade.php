@include('partials.header')

@include('partials.sidebar_officer')

<main class="content  vh-100">
<div class="container-fluid">

@include('partials.officer_top_display')

<!--Current PAGE-->
<div class="row">
    <div class="col-lg-12">
        <div class="lead fw-bold"><i class="bi bi-envelope-open"></i> Open</div>
    </div>
</div>
<!--Current PAGE-->

<div class="border border-2 rounded p-2 border-end-0 border-start-0 border-success shadow-lg">

@include('officer.officer_filter_open')

</div> <!--EOF BORDER-->

 @include('officer.officer_table_open')

</div> <!--EOF CONTAINER FLUID-->
</main>

@include('officer.modals.modal_update_category')

@include('officer.modals.modal_distribute_request')

@include('officer.modals.modal_cancel_request')

@include('partials.officer_take_request')

@include('client.modals.modal_view_attachment')

@include('partials.modal_seemore')

@include('partials.footer')

