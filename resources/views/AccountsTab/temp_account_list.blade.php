@include('partials.header');
    
<div class="container">

    <div class="d-flex justify-content-center align-items-center vh-100">
        <h5 class="p-2">Temp Login </h5>
        <div class="row">

                   
                    <div class="col-lg-9">
                    <form action="{{ route('authUser') }}" method="POST">
                        @csrf
                        <select name="account_empid" class="form-control" required>
                            <option value=""></option>
                            
                            @foreach($users as $user)

                            <?php $userType = 'Staff' ?>
                            <?php $agentUnitID = 'Client Only' ?>
                            @if($user->usertype_id == 1)
                                <?php $userType = 'Supervisor' ?>
                            @endif

                            @if($user->agentunit_id == 1)
                                <?php $agentUnitID = 'EFMS' ?>
                            @elseif($user->agentunit_id == 2)
                                <?php $agentUnitID = 'IMISS' ?>
                            @endif

                            <option value="{{ $user->account_empid }}">{{ $user->account_fname }} {{ $user->account_lname }} ({{ $userType }}) - {{ $agentUnitID }}</option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-success btn-block w-100" type="button">Login</button>
                        </form>
                    </div>
                

        </div>
    </div>
</div>

@include('partials.footer');