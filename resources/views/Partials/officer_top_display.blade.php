
  @include('partials.esrs_title')
  <div class="p-2 bd-highlight">
            <div class="dropdown">
            <span class="lead pe-2 userDisplayName fw-bold">{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname  }} </span>
            <span style="font-size: 10px;">
              @if(Auth::user()->usertype_id == 1)
                (Supervisor)
              @else
                (Staff)
              @endif
            </span>
            <a href="#" class="dropdown-toggle  text-success" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-workspace" style="font-size: 40px; text-shadow: 2px 2px 2px rgba(6, 48, 23, 1);"></i></a>
            
            <!--NOTIF-->
            <!--span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">12
            </span-->
            <!--NOTIF-->

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/client_dashboard"><i class="bi-toggles2"></i> Switch to Client</a></li>
                <!--li><a class="dropdown-item" href="/location_floor_settings"><i class="bi bi-geo-alt-fill"></i> Location/Floor Settings</a></li-->
                <li><a class="dropdown-item text-decoration-line-through" href="#"><i class="bi bi-geo-alt-fill"></i> Location/Floor Settings</a></li>
                
                <!--li><a class="dropdown-item" href="/request_duration_settings"><i class="bi bi-gear-fill"></i> Request Duration Settings</a></li-->
                <li><a class="dropdown-item text-decoration-line-through" href="#"><i class="bi bi-gear-fill"></i> Request Duration Settings</a></li>
                
                <li><hr class="dropdown-divider"></li>
                <li class=""><a class="dropdown-item text-danger logoutConfirm" href="#"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                
            </ul>
        </div>
  </div>
</div>

