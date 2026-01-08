@include('partials.header')

@include('partials.sidebar_officer')

<main class="content  vh-100">
<div class="container-fluid">

@include('partials.officer_top_display')

<hr class="bg-success" style="height: 2px;">

    <p>Category Table 2 - List</p>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed table-hover table-striped">
                <thead class="bg-success text-white" style="font-size: 12px;">
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Main Category</th>
                    <th class="text-center">Agent Unit ID</th>
                    <th class="text-center">Repair ID</th>
                    <th>Icon</th>
                     <th class="text-center">Category ID</th>
                </tr>
                </thead>
                <?php $counter = 1; ?>
                @foreach($data2 as $datas)
                    <tr style="font-size: 12px;">
                        <td class="text-success" style="font-size: 12px;">{{ $counter }}.</td>
                        <td>{{ $datas->category_value }}</td>
                        <td>
                            @if($datas->main_category != '')
                                {{ $datas->main_category }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="text-center">{{ $datas->agentunit_id }}</td>
                        <td class="text-center">{{ $datas->repairtype_id }}</td>
                        <td>{{ $datas->category_icon }}</td>
                        <td class="text-center">{{ $datas->category_id }}</td>
                    </tr>
                <?php $counter++; ?>
                @endforeach
                
            </table>
        </div>
    </div><!-- EOF ROW -->
    <p class="text-center"> - END - </p>

</div> <!--EOF CONTAINER FLUID-->
</main>

@include('partials.footer')


