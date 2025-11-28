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

 @include('partials.modal_seemore')

</div> <!--EOF CONTAINER FLUID-->
</main>

@include('partials.footer')

