
<div class="row mt-2">

    <div class="col-lg-4">
    @if($getStatus == 2)
        <form action="/client_open_request" method="POST"> <!--OPEN-->
    @endif
    @if($getStatus == 5)
        <form action="/client_inprogress_request" method="POST">  <!--INPROGRESS-->
    @endif
     @if($getStatus == 8)
        <form action="/client_acknowledge_request" method="POST">  <!--ACKNOWLEDGE-->
    @endif
    @if($getStatus == 6)
        <form action="/client_completed_request" method="POST">  <!--COMPLETED-->
    @endif
        @if($getStatus == 7)
        <form action="/client_cancelled_request" method="POST">  <!--CANCELLED-->
    @endif

            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text">Search</span>
                <input type="search" class="form-control form-control-sm" placeholder="Reference No." name="refNo" 
                required value="{{ old('refNo', $oldData['refNo'] ?? '') }}">
                <button type="submit" class="btn btn-success"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>

    <div class="col-lg-3 ms-auto">

    @if($getStatus == 2)
        <form action="/client_open_request" method="POST"> <!--OPEN-->
    @endif
    @if($getStatus == 5)
        <form action="/client_inprogress_request" method="POST">  <!--INPROGRESS-->
    @endif
     @if($getStatus == 8)
        <form action="/client_acknowledge_request" method="POST">  <!--ACKNOWLEDGE-->
    @endif
    @if($getStatus == 6)
        <form action="/client_completed_request" method="POST">  <!--COMPLETED-->
    @endif
        @if($getStatus == 7)
        <form action="/client_cancelled_request" method="POST">  <!--CANCELLED-->
    @endif

    @csrf
        <div class="input-group mb-3">
            <span class="input-group-text">From</span>
            <input type="date" class="form-control form-control-sm" name="reqDateFrom"
            value="{{ old('reqDateFrom', $oldData['reqDateFrom'] ?? '') }}">
        </div>
    </div>

    <div class="col-lg-3">
        <div class="input-group mb-3">
            <span class="input-group-text">To</i></span>
            <input type="date" class="form-control form-control-sm" name="reqDateTo"
            value="{{ old('reqDateTo', $oldData['reqDateTo'] ?? '') }}">
        </div>
    </div>

        
    <div class="col-lg-2">
        <button type="submit" class="btn btn-success  w-100 btn-sm mt-1">Filter <i class="bi bi-filter"></i></button>
        </form>
    </div>

</div>







