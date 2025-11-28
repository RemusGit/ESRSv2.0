
    <div class="row mt-4">
        <div class="col-lg-12">
            <h6>{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <label class="lead" style="font-size: 12px;"><b>{{ session('section_name') }} ({{ session('section_abbre') }})</b></label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <label for="">Overview for <b>{{ date('M. d, Y' , strtotime($oldData['reqDateFrom'])) }} - {{ date('M. d, Y' , strtotime($oldData['reqDateTo'])) }}</b></label>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <label class="fw-bold">Task Performed <span class="text-success" style="font-size: 14px;">({{ $oldData['reqStatus'] }})</span></label>
        </div>

        <div class="col-lg-6 pb-2">
            <a href="/officer_my_report_pdf/{{ $oldData['reqDateFrom'] }}/{{ $oldData['reqDateTo'] }}/{{ $oldData['reqStatus'] }}" 
            target="blank" class="btn btn-sm btn-secondary float-end"><i class="bi bi-printer"></i> Print Report</a>
        </div>
    </div>

    <table class="table table-striped table-hover shadow">
        <thead class="bg-success text-white" style="font-size: 14px;">
            <tr>
                <th>#</th>
                <th>Categories</th>
                <th class="text-end">Request Taken</th>
                <th class="text-end">Overall</th>
                <th class="text-end">Percentage</th>
            </tr>
        </thead>
            <?php $counter = 1;?>
            @foreach($data as $datas)
            <tr style="font-size: 16px;">
                <td class="text-success fw-bold"  style="max-width: 5px; font-size: 14px;">{{ $counter }}.</td>
                <td>{{ $datas->categoryVal }}.</td>
                <td class="text-end">{{ $datas->requestTaken }}</td>
                <td class="text-end">{{ $datas->overAll }}</td>
                @if((int)$datas->overAll)
                    <?php $percentage = ( 100 / (int)$datas->overAll * (int)$datas->requestTaken ); ?>
                    <?php $percentage = round($percentage) ?>
                    @if($percentage >= 50)
                        <td class="text-end fw-bold text-success">{{ (int)$percentage }}%</td>
                    @else
                        <td class="text-end fw-bold text-danger">{{ (int)$percentage }}%</td>
                    @endif
                @else
                    <?php $percentage = 0; ?>
                    <td class="text-end fw-bold text-danger">{{ (int)$percentage }}%</td>
                @endif
            </tr>
            <?php $counter++;?>
            @endforeach
    </table>