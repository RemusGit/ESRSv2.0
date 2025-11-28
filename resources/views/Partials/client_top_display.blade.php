  @include('partials.esrs_title')
  <div class="p-2 bd-highlight" >
            <div class="dropdown">
            <span class="lead pe-2 userDisplayName fw-bold">{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname }}</span>
            <span style="font-size: 10px;">
              @if(Auth::user()->usertype_id == 1)
                (Supervisor)
              @else
                (Staff)
              @endif
            </span>
            <a href="#" class="dropdown-toggle  text-success" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle" style="font-size: 40px; text-shadow: 2px 2px 2px rgba(6, 48, 23, 1);"></i></a>
            <ul class="dropdown-menu">

                @if(Auth::user()->usertype_id != 3)
                <li><a class="dropdown-item" href="/officer_dashboard"><i class="bi-toggles2"></i> Switch to Action Officer</a></li>
                
                <!--li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill"></i> Account Settings</a></li-->
                
                <li><hr class="dropdown-divider"></li>
                @endif
                <li class=""><a class="dropdown-item text-danger logoutConfirm" href="#"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                
            </ul>
        </div>
  </div>
</div>




