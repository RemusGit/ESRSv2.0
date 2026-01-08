  <!-- Fixed Sidebar -->
  <nav class="sidebar">
    <ul class="nav flex-column p-2 nav-pills">
      <li class="nav-item">

        <div class="p-2 text-light mb-2 logo1">
            <img src="{{ asset('vmclogo.png') }}" style="height:50px;" />

            <span class="lead text-success hideOnSmallDevice">VMC ESRS</span>
        </div>

      </li>

      <li class="nav-item" >
        
        <a href="/client_dashboard" class="nav-link d-flex align-items-center text-light lead">
          <!--i class="bi bi-info-circle"></i> <span class="ms-2">About</span-->
          <i class="bi bi-clipboard-plus-fill"
          data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Create Request"></i> <span class="hideOnSmallDevice ps-1">Create Request</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link d-flex align-items-center text-light lead"
        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          <!--i class="bi bi-gear"></i> <span class="ms-2">Services</span-->
          <i class="bi bi-file-bar-graph-fill"
          data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="My Request"></i> <span class="hideOnSmallDevice ps-1">My Request</span><i class="bi bi-caret-down-fill"></i>
        </a>

            <div id="flush-collapseOne" class="accordion-collapse show collapse ms-4 p-2" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <?php if(!isset($getStatus)) { $getStatus = 0; } ?>
                <div class="accordion-body subMenu">
                  @if($getStatus == 2)
                    <!--a class="nav-link text-light bg-success text-white" href="/client_open_request"-->
                    <a class="nav-link text-light text-dark" style="background-color: #c3f0c2;" href="/client_open_request">
                      
                  @else
                   <a class="nav-link text-light" href="/client_open_request">
                  @endif
                    <i class="bi bi-envelope-open"
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Open"></i> <span class="hideOnSmallDevice">Open</span></a></div>
                
                <div class="accordion-body subMenu">
                  @if($getStatus == 5)
                      <a class="nav-link text-light text-dark" style="background-color: #c3f0c2;" href="/client_inprogress_request">
                  @else
                      <a class="nav-link text-light" href="/client_inprogress_request">
                  @endif
                    
                  <i class="bi bi-clipboard-data"
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="InProgress"></i> <span class="hideOnSmallDevice">InProgress</span></a></div>
               
                <div class="accordion-body subMenu">
                  @if($getStatus == 8)
                    <a class="nav-link text-light text-dark" style="background-color: #c3f0c2;" href="client_acknowledge_request">
                  @else
                    <a class="nav-link text-light" href="client_acknowledge_request">
                  @endif

                    <i class="bi bi-person-check"
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Acknowledge"></i> <span class="hideOnSmallDevice">Acknowledge</span></a></div>
               
                <div class="accordion-body subMenu">
                  @if($getStatus == 6)
                      <a class="nav-link text-light text-dark" style="background-color: #c3f0c2;" href="client_completed_request">
                    @else
                      <a class="nav-link text-light" href="client_completed_request">
                    @endif
                    <i class="bi bi-check-circle"
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Completed"></i> <span class="hideOnSmallDevice">Completed</span></a></div>
                
                <div class="accordion-body subMenu">
                  @if($getStatus == 7)
                    <a class="nav-link text-light text-dark" style="background-color: #c3f0c2;" href="client_cancelled_request">
                  @else
                    <a class="nav-link text-light" href="client_cancelled_request">
                  @endif  
                    <i class="bi bi-trash"
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Cancelled"></i> <span class="hideOnSmallDevice">Cancelled</span></a></div>
            
            
            </div>
      </li>

      <!--li class="nav-item">
        <a href="#" class="nav-link d-flex align-items-center text-light lead">
          <i class="bi bi-file-text-fill"
          data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="IMISS Citizen Charter"></i> <span class="hideOnSmallDevice ps-1">IMISS Citizen Charter</span>
        </a>
      </li-->
    </ul>

  </nav>