<form action="{{ route('officerMyReport') }}" method="POST">
@csrf
    <div class="row justify-content-center pt-2">

        <div class="col-lg-3">
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

        <div class="col-lg-3">
            <div class="input-group mb-3">
                <span class="input-group-text">From</span>
                <input type="date" class="form-control form-control-sm" name="reqDateFrom"
                value="{{ old('reqDateFrom', $oldData['reqDateFrom'] ?? '') }}" required>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="input-group mb-3">
                <span class="input-group-text">To</i></span>
                <input type="date" class="form-control form-control-sm" name="reqDateTo"
                value="{{ old('reqDateTo', $oldData['reqDateTo'] ?? '') }}" required>
            </div>
        </div>

        <div class="col-lg-2">
            <button class="btn btn-success w-100" type="submit"><i class="bi bi-filter"></i> Filter</button>
        </div>

    </div><!---EOF ROW-->
    </form>