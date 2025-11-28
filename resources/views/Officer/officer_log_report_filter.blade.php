<form action="{{ route('officerLogReport') }}" method="POST">
@csrf
    <div class="row justify-content-center pt-2">

        <div class="col-xl-4 col-lg-6">
            <div class="input-group mb-3">
                <span class="input-group-text">Agent <i class="bi bi-people-fill ps-1"></i></span>
                <select class="form-select form-control-sm" name="reqAgent">
                    <option value="All Agents">All</option>
                    @foreach($agents as $agent)
                    <?php $agentFullName = $agent->account_fname.' '.$agent->account_mname.' '.$agent->account_lname.' '.$agent->account_suffix; ?>
                    <option value="{{ $agent->account_empid }}" @selected(old('reqAgent', $oldData['reqAgent'] ?? '') == $agent->account_empid)>{{ $agentFullName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xl-3  col-lg-6">
            <div class="input-group mb-3">
                <span class="input-group-text">Status <i class="bi bi-bar-chart ps-1"></i></span>
                <select class="form-select form-control-sm" name="reqStatus">
                    <option value="All Accomplished">All Accomplished</option>
                    <option value="In-Progress" @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'In-Progress')>In-Progress</option>
                    <option value="Acknowledge" @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'Acknowledge')>Acknowledge</option>
                    <option value="Completed"   @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'Completed')>Completed</option>
                    <option value="Cancelled"   @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'Cancelled')>Cancelled</option>
                    <option value="Condemned"   @selected(old('reqStatus', $oldData['reqStatus'] ?? '') == 'Condemned')>Condemned</option>
                </select>
            </div>
        </div>

        <div class="col-xl-2  col-lg-6">
             <!--input type="hidden" name="getStatus" value="2"-->
            <div class="input-group mb-3">
                <span class="input-group-text">From</span>
                <input type="date" class="form-control form-control-sm" name="reqDateFrom"
                value="{{ old('reqDateFrom', $oldData['reqDateFrom'] ?? '') }}" required>
            </div>
        </div>

        <div class="col-xl-2  col-lg-6">
            <div class="input-group mb-3">
                <span class="input-group-text">To</i></span>
                <input type="date" class="form-control form-control-sm" name="reqDateTo"
                value="{{ old('reqDateTo', $oldData['reqDateTo'] ?? '') }}" required>
            </div>
        </div>

        <div class="col-xl-1">
            <button class="btn btn-sm btn-success w-100"><i class="bi bi-filter"></i> Filter</button>
        </div>

    </div><!---EOF ROW-->
    </form>