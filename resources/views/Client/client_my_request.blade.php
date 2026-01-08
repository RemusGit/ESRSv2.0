@include('partials.header')

@include('partials.sidebar_client')

<main class="content  vh-100">
<div class="container-fluid pe-4">


@include('partials.client_top_display')

<!--Current PAGE-->
<div class="row">
    <div class="col-lg-12">
        <!--div class="lead fw-bold"><i class="bi bi-envelope-open"></i> Open</div-->
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb lead fw-bold">
            <li class="breadcrumb-item"><i class="bi bi-file-bar-graph-fill"></i> My Request</li>
            
            @if($getStatus == 2)
                <li class="breadcrumb-item active text-secondary" aria-current="page"><i class="bi bi-envelope-open"></i> Open</li>
            @elseif($getStatus == 5)
                <li class="breadcrumb-item active text-info" aria-current="page"><i class="bi bi-clipboard-data"></i> In-Progress</li>
            @elseif($getStatus == 8)
                <li class="breadcrumb-item active text-primary" aria-current="page"><i class="bi bi-person-check"></i> Acknowledge</li>
            @elseif($getStatus == 6)
                <li class="breadcrumb-item active text-success" aria-current="page"><i class="bi bi-check-circle"></i> Completed</li>
            @elseif($getStatus == 7)
                <li class="breadcrumb-item active text-danger" aria-current="page"><i class="bi bi-trash"></i> Cancelled</li>
            @endif

        </ol>
        </nav>
    </div>
</div>
<!--Current PAGE-->

<div class="border border-2 rounded p-2 border-end-0 border-start-0 border-success shadow">

@include('client.client_filter_my_request')

</div> <!--EOF BORDER-->

@include('client.client_list_my_request')

</div> <!--EOF CONTAINER FLUID-->
</main>

@include('client.modals.modal_view_attachment')

@include('partials.modal_seemore')

@include('client.modals.modal_action_taken')

@include('client.modals.modal_show_update')

@include('partials.footer')

