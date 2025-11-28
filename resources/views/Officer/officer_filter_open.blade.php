
<div class="row mt-2">

    <div class="col-lg-4">
        <form action="/officer_open_request" method="POST">
            @csrf
            <!--input type="hidden" name="getStatus" value="2"-->
            <div class="input-group mb-3">
                <span class="input-group-text">Search</span>
                <input type="search" class="form-control form-control-sm" placeholder="Reference No." name="refNo" 
                required value="{{ old('refNo', $oldData['refNo'] ?? '') }}">
                <button type="submit" class="btn btn-success"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>



    <div class="col-lg-3 ms-auto">
    <form action="/officer_open_request" method="POST">
    @csrf
        <!--input type="hidden" name="getStatus" value="2"-->
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
        <button class="btn btn-success  w-100 btn-sm mt-1">Filter <i class="bi bi-filter"></i></button>
    </div>

</div>


</form>




