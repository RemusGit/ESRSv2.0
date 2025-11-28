@include('partials.header');

<section class="mt-lg-5">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form>
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h1 fw-bold mb-0">Register Account</span>
                  </div>
                    
                    <!-- Firstname / Middlename -->
                    <div class="row d-flex">
                        <div class="col-lg-6 d-flex align-items-center ">
                            <div class="form-outline mb-4 form-floating">
                                <input type="text" id="floatingInput" class="form-control form-control-lg" placeholder="First Name" />
                                <label class="form-label" for="floatingInput">First Name</label>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex align-items-center ">
                            <div class="form-outline mb-4 form-floating">
                                <input type="text" id="floatingInput" class="form-control form-control-lg" placeholder="Middle Name" />
                                <label class="form-label" for="floatingInput">Middle Name</label>
                            </div>
                        </div>
                    </div>
                    <!-- Firstname / Middlename -->

                    <!-- Lastname / Suffix -->
                    <div class="row d-flex">
                        <div class="col-lg-6 d-flex align-items-center ">
                            <div class="form-outline mb-4 form-floating">
                                <input type="text" id="floatingInput" class="form-control form-control-lg" placeholder="Last Name" />
                                <label class="form-label" for="floatingInput">Last Name</label>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center ">
                            <div class="form-outline mb-4 form-floating  w-100">
                                <select name="" id="" class="form-control form-control-lg">
                                    <option value=""></option>
                                    <option value="SR">Sr.</option>
                                    <option value="JR">Jr.</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                    <option value="VII">VII</option>
                                    <option value="VIII">VIII</option>
                                    <option value="IX">IX</option>
                                    <option value="X">X</option>
                                </select>
                                <label class="form-label" for="floatingInput">Suffix</label>
                            </div>
                        </div>
                    </div>
                    <!-- Lastname / Suffix -->


                    <!-- Contact / Email -->
                   <div class="row d-flex">
                        <div class="col-lg-6 d-flex align-items-center ">
                            <div class="form-outline mb-4 form-floating">
                                <input type="text" id="floatingInput" class="form-control form-control-lg" placeholder="Contact No." />
                                <label class="form-label" for="floatingInput">Contact No.</label>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex align-items-center ">
                            <div class="form-outline mb-4 form-floating">
                                <input type="email" id="floatingInput" class="form-control form-control-lg" placeholder="Email Address" />
                                <label class="form-label" for="floatingInput">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <!-- Contact / Email -->


                     <!-- Employee ID -->
                    <div class="row d-flex">
                        <div class="col-lg-6 d-flex align-items-center ">
                            <div class="form-outline mb-4 form-floating">
                                <input type="text" id="floatingInput" class="form-control form-control-lg" placeholder="Employee ID" />
                                <label class="form-label" for="floatingInput">Employee ID</label>
                            </div>
                        </div>
                    </div>
                    <!-- Employee ID -->


                    <!-- Password CofirmPassword -->
                    <div class="row d-flex">
                        <div class="col-lg-6 d-flex align-items-center ">
                            <div class="form-outline mb-4 form-floating">
                                <input type="password" id="floatingInput" class="form-control form-control-lg" placeholder="Password" />
                                <label class="form-label" for="floatingInput">Password</label>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex align-items-center ">
                            <div class="form-outline mb-4 form-floating">
                                <input type="password" id="floatingInput" class="form-control form-control-lg" placeholder="Confirm Password"/>
                                <label class="form-label" for="floatingInput">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                    <!-- Password CofirmPassword -->




                  <div class="pt-1 mb-4">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg btn-block" type="button">Register</button>
                  </div>

                  <!--a class="small text-muted" href="#!">Forgot password?</a-->
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="/"
                      style="color: #393f81;">Login</a></p>
                </form>

              </div>
            </div>

            <div class="col-md-6 col-lg-5 d-none d-md-block pt-5">
              <img src="{{ asset('images/vmclogo.png') }}"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@include('partials.footer');