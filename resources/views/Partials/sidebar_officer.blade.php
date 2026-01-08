
  <!-- Fixed Sidebar -->
  <nav class="sidebar">
    <ul class="nav flex-column p-2 nav-pills">
      <li class="nav-item">

        <div class="p-2 text-white mb-2 logo1">
            <img src="{{ asset('vmclogo.png') }}" style="height:50px;" />

            <span class="lead text-success hideOnSmallDevice">VMC ESRS</span>
        </div>

      </li>

    <li class="nav-item" >
        <a href="/officer_dashboard" class="nav-link d-flex align-items-center text-white lead">
          <!--i class="bi bi-info-circle"></i> <span class="ms-2">About</span-->
          <i class="bi bi-journal-richtext"
          data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="All Request"></i> <span class="hideOnSmallDevice ps-1"> All Request</span>
        </a>
    </li>


    <li class="nav-item" >
          <input type="hidden" value="" name="getStatus">
          <?php if(!isset($getStatus)) { $getStatus = 0; } ?>
          @if($getStatus == 2)
            <a href="/officer_open_request" class="nav-link d-flex align-items-center lead text-dark" style="background-color: #c3f0c2;"> <!--2 = OPEN -->
          @else
            <a href="/officer_open_request" class="nav-link d-flex align-items-center text-white lead"> <!--2 = OPEN -->
          @endif
          <i class="bi bi-envelope-open"
            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Open"></i> <span class="hideOnSmallDevice ps-1"> Open</span>
          </a>
      
    </li>


    <li class="nav-item" >

     @if($getStatus == 5)
          <a href="/officer_inprogress_request" class="nav-link d-flex align-items-center lead text-dark" style="background-color: #c3f0c2;"> <!-- 5 = IN-PROGRESS -->
         @else  
          <a href="/officer_inprogress_request" class="nav-link d-flex align-items-center text-white lead"> <!-- 5 = IN-PROGRESS -->
        @endif
          <i class="bi bi-clipboard-data"
          data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="InProgress"></i> <span class="hideOnSmallDevice ps-1"> InProgress</span>
        </a>
    </li>

    <li class="nav-item" >
        @if($getStatus == 8)
          <a href="/officer_acknowledge_request" class="nav-link d-flex align-items-center lead text-dark" style="background-color: #c3f0c2;"> <!-- 8 = ACKNOWLEDGE -->
        @else
          <a href="/officer_acknowledge_request" class="nav-link d-flex align-items-center text-white lead"> <!-- 8 = ACKNOWLEDGE -->
        @endif
          <i class="bi bi-person-check"
          data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Acknowledge"></i> <span class="hideOnSmallDevice ps-1"> Acknowledge</span>
        </a>
    </li>

    <li class="nav-item" >
        <!--a href="/officer_get_data/6" class="nav-link d-flex align-items-center text-white lead"--> <!-- 6 = COMPLETED -->
        @if($getStatus == 6)
          <a href="/officer_completed_request" class="nav-link d-flex align-items-center lead text-dark" style="background-color: #c3f0c2;">
        @else
          <a href="/officer_completed_request" class="nav-link d-flex align-items-center text-white lead">
        @endif
          <i class="bi bi-check-circle"
          data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Completed"></i> <span class="hideOnSmallDevice ps-1"> Completed</span>
        </a>
    </li>

    <li class="nav-item" >
        @if($getStatus == 7)
          <a href="/officer_cancelled_request" class="nav-link d-flex align-items-center lead text-dark" style="background-color: #c3f0c2;"> <!-- 7 = CANCELLED -->
        @else
          <a href="/officer_cancelled_request" class="nav-link d-flex align-items-center text-white lead"> <!-- 7 = CANCELLED -->
        @endif
          <i class="bi bi-trash"
          data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Cancelled"></i> <span class="hideOnSmallDevice ps-1"> Cancelled</span>
        </a>
    </li>


      <li class="nav-item">
        <a href="#" class="nav-link d-flex align-items-center text-white lead"
        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          <!--i class="bi bi-gear"></i> <span class="ms-2">Services</span-->
          <i class="bi bi-file-bar-graph-fill"
          data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Reports"></i> <span class="hideOnSmallDevice ps-1"
           >Reports</span><i class="bi bi-caret-down-fill"></i>
        </a>

            <div id="flush-collapseOne" class="accordion-collapse collapse ms-4 p-2" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">

                <div class="accordion-body subMenu"><a class="nav-link text-white" href="/officer_my_report"><i class="bi bi-file-earmark-post"
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="My Report"></i> <span class="hideOnSmallDevice">My Report</span></a></div>

                <!--div class="accordion-body subMenu"><a class="nav-link text-white" href="#"><i class="bi bi-file-earmark-post"
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="My Report"></i> <span class="hideOnSmallDevice">My Report</span></a></div-->
                
                <div class="accordion-body subMenu"><a class="nav-link text-white" href="/officer_log_report"><i class="bi bi-file-text"
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Log Report"></i> <span class="hideOnSmallDevice">Log Report</span></a></div>

                <!--div class="accordion-body subMenu"><a class="nav-link text-white" href="#"><i class="bi bi-file-text"
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Log Report"></i> <span class="hideOnSmallDevice">Log Report</span></a></div-->

            </div>
      </li>

      <!--li class="nav-item" >
          <a href="#" class="nav-link d-flex align-items-center text-white lead">
            <i class="bi bi-person-fill-gear"
            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Manage User Accounts"></i> <span class="hideOnSmallDevice ps-1"> Manage User Accounts</span>
          </a>
      </li-->
    </ul>

      <!--div class="position-fixed bottom-0 pb-2 hideOnSmallDevice" style="margin-left: 50px;">
        <a href="#" class="nav-link d-flex align-items-center text-white lead adminText" style="font-size: 10px;">
          <i class="bi bi-stars"></i>Admin/Officer<i class="bi bi-stars"></i>
        </a>
      </div-->

  </nav>



