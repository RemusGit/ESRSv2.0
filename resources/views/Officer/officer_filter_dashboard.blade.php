
<div class="row mt-2">

    <div class="col-lg-4">
        <form action="{{ route('filter_request') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text">Search</span>
                <input type="search" class="form-control form-control-sm" placeholder="Reference#, Description, Request By.. " name="searchAll" required
                value="{{ old('searchAll', $oldData['searchAll'] ?? '') }}">
                <button type="submit" class="btn btn-success"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>


    <div class="col-lg-4">
            <form action="{{ route('filter_request') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text">A. Officer</span>
                    <select class="form-select form-control-sm" name="reqActionOfficer">

                        <option value="">All</option>
                            @foreach($populateActionOfficer as $data)
                                <option value="{{ $data->account_empid }}" 
                                @selected(old('reqActionOfficer', $oldData['reqActionOfficer'] ?? '') == $data->account_empid)>
                                {{ $data->account_fname }} {{ $data->account_lname }} {{ $data->account_suffix }}</option>
                            @endforeach

                    </select>
            </div>

    </div>


    <div class="col-lg-2 ms-auto">

        <div class="input-group mb-3">
            <span class="input-group-text">From</span>
            <input type="date" class="form-control form-control-sm" name="reqDateFrom"
            value="{{ old('reqDateFrom', $oldData['reqDateFrom'] ?? '') }}">
        </div>
    </div>

    <div class="col-lg-2">
        <div class="input-group mb-3">
            <span class="input-group-text">To</i></span>
            <input type="date" class="form-control form-control-sm" name="reqDateTo"
            value="{{ old('reqDateTo', $oldData['reqDateTo'] ?? '') }}">
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-5">
        <div class="input-group mb-3">
            <span class="input-group-text">Category</span>
                <select class="form-select form-control-sm" name="reqCategory" id="selectCategory">

                    <option value="">All</option>
                    
                        @foreach($populateCategory as $data)
                            <option value="{{ $data->category_id }}" 
                            @selected(old('reqCategory', $oldData['reqCategory'] ?? '') == $data->category_id)>
                            @if($data->main_category != '')({{$data->main_category}}) @endif
                            {{ $data->category_value }}</option>
                        @endforeach

                </select>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3">
        <div class="input-group mb-3">
            <span class="input-group-text">Status</span>
            <select class="form-select form-control-sm" name="reqStatus">

                <option value="">All</option>
                <option value="Open"        @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'Open')>Open</option>
                <option value="In-Progress" @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'In-Progress')>In-Progress</option>
                <option value="Acknowledge" @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'Acknowledge')>Acknowledge</option>
                <option value="Completed"   @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'Completed')>Completed</option>
                <option value="Cancelled"   @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'Cancelled')>Cancelled</option>
            </select>
        </div>
    </div>

    <div class="col-xl-2 col-lg-3 col-md-3 ms-auto">
        <button class="btn btn-success  w-100 btn-sm mt-2">Filter <i class="bi bi-filter"></i></button>
    </div>

</form>


    <div class="row" id="searchForVmcCard" style="display: none;">
        <div class="col-lg-6">
            <form action="{{ route('filter_request') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text">Custom Search</span>
                    <input type="hidden" id="customCategoryVal" name="customCategoryVal">
                    <input type="search" class="form-control form-control-sm" placeholder="Search Employee First or Last Name" name="searchEmpName" required
                    value="{{ old('searchAll', $oldData['searchEmpName'] ?? '') }}">
                    <button type="submit" class="btn btn-secondary"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <!--div class="col-xl-1 col-lg-6 col-md-3 ms-auto">
        <button class="btn btn-outline-secondary  w-100 btn-sm mt-2" id="clearFormButton">Clear <i class="bi bi-brush"></i></button>
    </div-->

</div>

<script>
    $(document).ready(function(){

        $('#selectCategory').on("change click" , function(){
            let getCategoryID = $(this).val();

            $('#customCategoryVal').val(getCategoryID);
            //console.log(getCategory);
            if(getCategoryID == 13 || getCategoryID == 12){
                $('#searchForVmcCard').show();
            }
            else{
                $('#searchForVmcCard').hide();
            }
        });

    });
</script>