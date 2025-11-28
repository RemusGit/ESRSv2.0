@include('partials.header')

@include('partials.sidebar_officer')

<main class="content  vh-100">
<div class="container-fluid">

@include('partials.officer_top_display')

<!--Current PAGE-->
<div class="row ">
    <div class="col-lg-12 ">
        <div class="lead fw-bold"><i class="bi bi-file-text"></i> Log Report</div>
    </div>
</div>
<!--Current PAGE-->

<div class="border border-2 rounded p-2 border-end-0 border-start-0 border-success shadow-lg">
    @include('officer.officer_log_report_filter')
</div> <!--EOF BORDER-->

@if(isset($oldData['reqDateFrom']))

    @if(count($data) > 0)
    <div class="row mt-4">
        <div class="col-lg-12 pb-2">
            <a href="/officer_log_report_pdf/{{ $oldData['reqDateFrom'] }}/{{ $oldData['reqDateTo'] }}/{{ $oldData['reqStatus'] }}/{{ $oldData['reqAgent'] }}" 
            target="blank" class="btn btn-sm btn-secondary float-end"><i class="bi bi-printer"></i> Print Report</a>
        </div>
    </div>

    
    <table class="table table-striped table-hover">
        <thead class="bg-success text-white" style="font-size: 12px;">
            <tr>
                <th>#</th>
                <th>Reference No.</th>
                <th>Date Request</th>
                <th>Date Accomplised</th>
                <th>Category</th>
                <th>Request By</th>
                <th>Section #</th>
                <th>Action Officer</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>

        <?php $counter = 1; ?>
        @foreach($data as $datas)
            <tr style="font-size: 12px;">
                <td class="text-success fw-bold" style="font-size: 11px;">{{ $counter }}.</td>
                <td>{{ $datas->refID }}</td>
                <td>{{ $datas->requestDate }}</td>

                @if($datas->reqDone != '')
                    <td>{{ $datas->reqDone }}</td>
                @else
                    <td>-</td>
                @endif

                <td style="max-width: 200px;">{{ $datas->categoryVal }}</td>
                <td>{{ $datas->requestBy }}</td>
                <td style="max-width: 100px;">{{ $datas->sectionVal }}</td>
                <td>{{ $datas->actionOfficer }}</td>

                <td style="width: 90px; font-size: 10px;" class="adjustOnSmall">
                        @if($datas->statusVal == 'Acknowledge')
                            <p class="bg-warning text-dark px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @elseif($datas->statusVal == 'For Processing')
                            <p class="bg-primary text-white px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @elseif($datas->statusVal == 'In-Progress')
                            <p class="bg-info text-dark px-2 rounded-pill text-center" style="width: 100%;">{{ $datas->statusVal }}</p>
                        @elseif($datas->statusVal == 'Completed')
                            <p class="bg-success text-white px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @elseif($datas->statusVal == 'Cancelled')
                            <p class="bg-danger text-white px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @else($datas->statusVal == 'Open')
                            <p class="bg-secondary text-white px-2 rounded-pill text-center">{{ $datas->statusVal }}</p>
                        @endif
                </td>
            </tr>
            <?php $counter++; ?>
        @endforeach
    </table>
    

    <h6>Summary</h6>
    <table class="table table-striped table-condensed table-hover pt-2" style="max-width: 450px;">
        <thead class="bg-secondary text-white" style="font-size: 12px;">
            <tr style="font-size: 12px;">
                <th>#</th>
                <th>Category</th>
                <th>Taken</th>
            </tr>
        </thead>
    
    <?php $counter = 1; ?>
    <?php $totalTaken = 0; ?>
     @foreach($summary as $summaryData)
        <tr style="font-size: 12px;">
            <td class="text-success fw-bold" style="font-size: 11px;">{{ $counter }}.</td>
            <td>{{ $summaryData->categoryVal }}</td>
            <td>{{ $summaryData->requestTaken }}</td>
        </tr>
    <?php $counter++; ?>
    <?php $totalTaken = $totalTaken + (int)$summaryData->requestTaken; ?>
    @endforeach
    
    <tr class="bg-secondary">
        <th></th>
        <th class="fw-bold text-white">TOTAL :</th>
        <th class="text-white">{{ $totalTaken }}</th>
    </tr>
    </table>
    <div class="pb-4"></div>

    @else
    <div class="row mt-4">
        <div class="col-lg-12">
            <h3 class="text-center">- NO DATA -</h3>
        </div>
    </div>
    @endif

@endif

</div> <!--EOF CONTAINER FLUID-->
</main>

@include('partials.footer')



