<div class="d-flex bd-highlight">
    
  <?php $currentServer = URL::to('/'); ?>

  <div class="p-2 flex-grow-1 bd-highlight esrsTitle">
      <div class="display-4" style="text-shadow: 2px 2px 4px rgba(6, 48, 23, 1); font-family: Arial, sans-serif; font-size: 40px;">ESRS<span style="font-size: 9px;">v2</span>
      </div>
      <p class="fw-lighter" style="font-size: 9px;">Electronic Service Request System
            @if( $currentServer == 'http://127.0.0.1:8000' )
                  <span class="text-danger fst-italic" style="font-size: 9px;">(TEST)</span>
            @else
                  <span class="text-success fst-italic" style="font-size: 9px;">(LIVE)</span>
            @endif
      </p>
        
  </div>