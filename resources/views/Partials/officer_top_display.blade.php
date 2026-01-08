
  @include('partials.esrs_title')
  <div class="p-2 bd-highlight">
            <div class="dropdown">
            <span class="lead pe-2 userDisplayName fw-bold">{{ Auth::user()->account_fname }} {{ Auth::user()->account_lname  }} </span>
            <span style="font-size: 10px;">
            @if(Auth::user()->agentunit_id == 3)
                (Client)
            @else
                @if(Auth::user()->usertype_id == 1)
                  (Supervisor-{{session('section_abbre')}})
                @else
                  (Staff-{{session('section_abbre')}})
                @endif
            @endif
            </span>
            <a href="#" class="dropdown-toggle  text-success" data-bs-toggle="dropdown" style="text-decoration: none !important;">
              @if(session('profile_pic') == '')
                <img src="{{ asset('uploads/ESRS_profile/1.png') }}" alt="..." class="rounded-circle" style="max-width: 50px;">
              @else
                <img src="{{ asset('uploads/ESRS_profile/'.session('profile_pic')) }}" alt="..." class="rounded-circle" style="max-width: 50px;">
              @endif
            </a>
            <!--NOTIF-->
            <!--span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">12
            </span-->
            <!--NOTIF-->

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/client_dashboard"><i class="bi-toggles2"></i> Switch to Client</a></li>
                <li><a class="dropdown-item" href="/location_floor_settings"><i class="bi bi-geo-alt-fill"></i> Location/Floor Settings</a></li>
                <!--li><a class="dropdown-item text-danger" href="/under_development_page"><i class="bi bi-geo-alt-fill"></i> Location/Floor Settings</a></li-->
                
                <li><a class="dropdown-item" href="/request_duration_settings"><i class="bi bi-gear-fill"></i> Request Duration Settings</a></li>
                <!--li><a class="dropdown-item text-danger" href="/under_development_page"><i class="bi bi-gear-fill"></i> Request Duration Settings</a></li-->
              
                <li><hr class="dropdown-divider"></li>
                <li class=""><a class="dropdown-item text-success" href="#"
                data-bs-toggle="modal" data-bs-target="#modalProfilePic"><i class="bi bi-person-circle"></i> Change Avatar</a></li>
                <!--li class=""><a class="dropdown-item text-success" href="#" data-bs-toggle="modal" data-bs-target="#modalChat"><i class="bi bi-chat"></i> Chat</a></li-->

                <li><hr class="dropdown-divider"></li>
                <li class=""><a class="dropdown-item text-danger logoutConfirm" href="#"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
            </ul>
        </div>
  </div>
</div>

