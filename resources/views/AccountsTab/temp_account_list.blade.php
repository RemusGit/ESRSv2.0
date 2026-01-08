@include('partials.header');
    
<div class="container">

    <div class="d-flex justify-content-center align-items-center vh-100">
        <h5 class="p-2">Temp Login</h5>
        <div class="row">

                   
                    <div class="col-lg-8">
                    <form action="{{ route('authUser') }}" method="POST">
                        @csrf
                        <div class="form-outline mb-2 form-floating  w-100">
                            <div class="form-outline mb-2 form-floating">
                                <input type="text" class="form-control form-control-lg" placeholder="Current ID Number" name="account_empid" id="account_empid" required />
                                <label class="form-label" for="account_empid"><i class="bi bi-asterisk text-danger" style="font-size: 9px;"></i> Employee ID</label>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-success btn-lg w-100">Login</button>
                        </form>
                    </div>

        </div>
    </div>
</div>

@include('partials.footer');