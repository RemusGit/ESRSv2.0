@include('partials.header')

@include('partials.sidebar_officer')

<main class="content  vh-100">
<div class="container-fluid">

@include('partials.officer_top_display')

<!--Current PAGE-->
<div class="row">
    <div class="col-lg-12">
        <div class="lead fw-bold"><i class="bi bi-person-check"></i> Acknowledge</div>
    </div>
</div>
<!--Current PAGE-->

<div class="border border-2 rounded p-2 border-end-0 border-start-0 border-success">

@include('officer.officer_filter_acknowledge')

</div> <!--EOF BORDER-->

 @include('officer.officer_table_acknowledge')

 @include('partials.modal_seemore')


</div> <!--EOF CONTAINER FLUID-->
</main>

@include('partials.footer')

