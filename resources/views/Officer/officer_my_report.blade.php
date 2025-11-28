@include('partials.header')

@include('partials.sidebar_officer')

<main class="content  vh-100">
<div class="container-fluid">

@include('partials.officer_top_display')

<!--Current PAGE-->
<div class="row ">
    <div class="col-lg-12 ">
        <div class="lead fw-bold"><i class="bi bi-file-earmark-post"></i> My Report</div>
    </div>
</div>
<!--Current PAGE-->

<div class="border border-2 rounded p-2 border-end-0 border-start-0 border-success shadow-lg">
    @include('officer.officer_my_report_filter')
</div> <!--EOF BORDER-->

@if(isset($oldData['reqDateFrom']))
    @include('officer.officer_my_report_table')
    <div class="lead text-center fw-bold pb-4" style="font-size: 12px;">-END-</div>
@endif


</div> <!--EOF CONTAINER FLUID-->
</main>

@include('partials.footer')



