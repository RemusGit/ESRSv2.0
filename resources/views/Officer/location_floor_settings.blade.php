@include('partials.header')

@include('partials.sidebar_officer')

<main class="content  vh-100">
<div class="container-fluid">

@include('partials.officer_top_display')

<!--Current PAGE-->
<div class="row ">
    <div class="col-lg-12 ">
        <div class="lead fw-bold"><i class="bi bi-geo-alt-fill"></i> Location/Floor Settings</div>
    </div>
</div>
<!--Current PAGE-->

<hr class="bg-success" style="height: 2px;">

@include('officer.location_floor_table')
    

</div> <!--EOF CONTAINER FLUID-->
</main>

@include('officer.modals.modal_add_location')

@include('officer.modals.modal_edit_location')

@include('partials.footer')






