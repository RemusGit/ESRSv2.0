@include('partials.header')

@include('partials.sidebar_client')

<main class="content">
<div class="container-fluid">


@include('partials.client_top_display')

<div class="border border-start-0 border-end-0 border-2 border-success rounded p-2 shadow">
<!--Current PAGE-->
<div class="row">
    <div class="col-lg-12 ">
        <div class="lead fw-bold">Create
        <span class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Select service below">Service Request <i class="bi bi-clipboard-plus-fill"></i></span></div>
    </div>
</div>
<!--Current PAGE-->
</div> <!--EOF BORDER -->
    <!-- IMISS REQUESTS/DROPDOWN -->
    @include('client.imiss_request')

    <!-- EFMS REQUESTS/DROPDOWN -->
    @include('client.efms_request')

    @include('client.js.all_request_js')


</div> <!--EOF CONTAINER FLUID-->
</main>

@include('client.modals.create_service_request_modal')

@include('client.modals.all_request_modal')

@include('partials.footer')