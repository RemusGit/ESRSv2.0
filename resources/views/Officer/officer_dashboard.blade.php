@include('partials.header')

@include('partials.sidebar_officer')

<main class="content vh-100">
<div class="container-fluid">

@include('partials.officer_top_display')

<!--Current PAGE-->
<div class="row">
    <div class="col-lg-6">
        <div class="lead fw-bold"><i class="bi bi-journal-richtext"></i> All Request</div>
    </div>

    <div class="col-lg-6 ms-auto">
        <!--button class="btn btn-sm btn-outline-secondary mb-1">Toggle Filter</button-->
        <div class="form-check form-switch float-end fw-bold" style="font-size: 12px;">
        <input class="form-check-input" type="checkbox" role="switch" id="toggleFilterSwitch"  style="cursor: pointer;">
        <label class="form-check-label text-success" for="toggleFilterSwitch" style="cursor: pointer;">Toggle Filter/Search</label>
        </div>
    </div>
</div>
<!--Current PAGE-->

<div class="border border-2 rounded p-2 border-end-0 border-start-0 border-success shadow-lg">

@include('officer.officer_filter_dashboard')

</div> <!--EOF BORDER-->

@include('officer.officer_table_dashboard')

</div> <!--EOF CONTAINER FLUID-->
</main>
@include('officer.modals.modal_action_taken_officer')
@include('client.modals.modal_view_attachment')
@include('partials.modal_seemore')

@include('partials.footer')



