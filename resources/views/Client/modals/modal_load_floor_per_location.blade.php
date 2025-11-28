<script>
  $(document).ready(function(){
  // LOAD LOCATION / BUILDING WHEN MODAL SHOW
  $('#createServiceRequestModal').on('show.bs.modal' , function(){
    console.log(this.id);
    $('#contactDetailsLocationBio').empty();
    $('#contactDetailsLocationHomis').empty();
    $('#contactDetailsLocationZoom').empty();
    $('#contactDetailsLocationOthersImiss').empty();
    $('#contactDetailsLocationWebUploads').empty();
    $('#contactDetailsLocationNetworkInstall').empty();
    $('#contactDetailsLocationRepairItEquipment').empty();
    $('#contactDetailsLocationSystemEnhance').empty();
    $('#contactDetailsLocationTechAssist').empty();
    $('#contactDetailsLocationTrainingOrient').empty();
    $('#contactDetailsLocationUserAccountMngt').empty();
    $('#contactDetailsLocationVmcIdCard').empty();
    $('#contactDetailsLocationRepairME').empty();
    $('#contactDetailsLocationRepairOE').empty();
    $('#contactDetailsLocationRepairAW').empty();
    $('#contactDetailsLocationRepairCW').empty();
    $('#contactDetailsLocationRepairEW').empty();
    $('#contactDetailsLocationRepairPW').empty();
    $('#contactDetailsLocationRepairTA').empty();
    $('#contactDetailsLocationOthersEfms').empty();
    $('#contactDetailsLocationEfmsTC').empty();
    

    $('#contactDetailsLocationBio').append('<option></option>');
    $('#contactDetailsLocationHomis').append('<option></option>');
    $('#contactDetailsLocationZoom').append('<option></option>');
    $('#contactDetailsLocationOthersImiss').append('<option></option>');
    $('#contactDetailsLocationWebUploads').append('<option></option>');
    $('#contactDetailsLocationNetworkInstall').append('<option></option>');
    $('#contactDetailsLocationRepairItEquipment').append('<option></option>');
    $('#contactDetailsLocationSystemEnhance').append('<option></option>');
    $('#contactDetailsLocationTechAssist').append('<option></option>');
    $('#contactDetailsLocationTrainingOrient').append('<option></option>');
    $('#contactDetailsLocationUserAccountMngt').append('<option></option>');
    $('#contactDetailsLocationVmcIdCard').append('<option></option>');
    $('#contactDetailsLocationRepairME').append('<option></option>');
    $('#contactDetailsLocationRepairOE').append('<option></option>');
    $('#contactDetailsLocationRepairAW').append('<option></option>');
    $('#contactDetailsLocationRepairCW').append('<option></option>');
    $('#contactDetailsLocationRepairEW').append('<option></option>');
    $('#contactDetailsLocationRepairPW').append('<option></option>');
    $('#contactDetailsLocationRepairTA').append('<option></option>');
    $('#contactDetailsLocationOthersEfms').append('<option></option>');
    $('#contactDetailsLocationEfmsTC').append('<option></option>');
    
    $('#contactDetailsFloorBio').empty();
    $('#contactDetailsFloorHomis').empty();
    $('#contactDetailsFloorZoom').empty();
    $('#contactDetailsFloorOthersImiss').empty();
    $('#contactDetailsFloorWebUploads').empty();
    $('#contactDetailsFloorNetworkInstall').empty();
    $('#contactDetailsFloorRepairItEquipment').empty();
    $('#contactDetailsFloorSystemEnhance').empty();
    $('#contactDetailsFloorTechAssist').empty();
    $('#contactDetailsFloorTrainingOrient').empty();
    $('#contactDetailsFloorUserAccountMngt').empty();
    $('#contactDetailsFloorVmcIdCard').empty();
    $('#contactDetailsFloorRepairME').empty();
    $('#contactDetailsFloorRepairOE').empty();
    $('#contactDetailsFloorRepairAW').empty();
    $('#contactDetailsFloorRepairCW').empty();
    $('#contactDetailsFloorRepairEW').empty();
    $('#contactDetailsFloorRepairPW').empty();
    $('#contactDetailsFloorRepairTA').empty();
    $('#contactDetailsFloorOthersEfms').empty();
    $('#contactDetailsFloorEfmsTC').empty();
    
    $('#contactDetailsFloorBio').append('<option></option>');
    $('#contactDetailsFloorHomis').append('<option></option>');
    $('#contactDetailsFloorZoom').append('<option></option>');
    $('#contactDetailsFloorOthersImiss').append('<option></option>');
    $('#contactDetailsFloorWebUploads').append('<option></option>');
    $('#contactDetailsFloorNetworkInstall').append('<option></option>');
    $('#contactDetailsFloorRepairItEquipment').append('<option></option>');
    $('#contactDetailsFloorSystemEnhance').append('<option></option>');
    $('#contactDetailsFloorTechAssist').append('<option></option>');
    $('#contactDetailsFloorTrainingOrient').append('<option></option>');
    $('#contactDetailsFloorUserAccountMngt').append('<option></option>');
    $('#contactDetailsFloorVmcIdCard').append('<option></option>');
    $('#contactDetailsFloorRepairME').append('<option></option>');
    $('#contactDetailsFloorRepairOE').append('<option></option>');
    $('#contactDetailsFloorRepairAW').append('<option></option>');
    $('#contactDetailsFloorRepairCW').append('<option></option>');
    $('#contactDetailsFloorRepairEW').append('<option></option>');
    $('#contactDetailsFloorRepairPW').append('<option></option>');
    $('#contactDetailsFloorRepairTA').append('<option></option>');
    $('#contactDetailsFloorOthersEfms').append('<option></option>');
    $('#contactDetailsFloorEfmsTC').append('<option></option>');

    // LOAD ALL LOCATION FROM location_tab
    $.ajax({
    url: "{{ route('loadLocation') }}", 
        type: 'GET', 
        success: function(res) {
        //console.log(res);
            $.each(JSON.parse(res) , function(i , val){

              $('#contactDetailsLocationBio').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationHomis').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationZoom').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationOthersImiss').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationWebUploads').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationNetworkInstall').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationRepairItEquipment').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationSystemEnhance').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationTechAssist').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationTrainingOrient').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationUserAccountMngt').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationVmcIdCard').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationRepairME').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationRepairOE').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationRepairAW').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationRepairCW').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationRepairEW').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationRepairPW').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationRepairTA').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationOthersEfms').append('<option value='+val.location_id+'>'+val.location_value+'</option>');
              $('#contactDetailsLocationEfmsTC').append('<option value='+val.location_id+'>'+val.location_value+'</option>');

            });
        },
        error: function(error) {
            console.error(error);
        }
    });//EOF AJAX

});// EOF MODAL ON LOAD

    $('.locationClassForAll').change(function(){

    $('#contactDetailsFloorBio').empty();
    $('#contactDetailsFloorHomis').empty();
    $('#contactDetailsFloorZoom').empty();
    $('#contactDetailsFloorOthersImiss').empty();
    $('#contactDetailsFloorWebUploads').empty();
    $('#contactDetailsFloorNetworkInstall').empty();
    $('#contactDetailsFloorRepairItEquipment').empty();
    $('#contactDetailsFloorSystemEnhance').empty();
    $('#contactDetailsFloorTechAssist').empty();
    $('#contactDetailsFloorTrainingOrient').empty();
    $('#contactDetailsFloorUserAccountMngt').empty();
    $('#contactDetailsFloorVmcIdCard').empty();
    $('#contactDetailsFloorRepairME').empty();
    $('#contactDetailsFloorRepairOE').empty();
    $('#contactDetailsFloorRepairAW').empty();
    $('#contactDetailsFloorRepairCW').empty();
    $('#contactDetailsFloorRepairEW').empty();
    $('#contactDetailsFloorRepairPW').empty();
    $('#contactDetailsFloorRepairTA').empty();
    $('#contactDetailsFloorOthersEfms').empty();
    $('#contactDetailsFloorEfmsTC').empty();
    
    $('#contactDetailsFloorBio').append('<option></option>');
    $('#contactDetailsFloorHomis').append('<option></option>');
    $('#contactDetailsFloorZoom').append('<option></option>');
    $('#contactDetailsFloorOthersImiss').append('<option></option>');
    $('#contactDetailsFloorWebUploads').append('<option></option>');
    $('#contactDetailsFloorNetworkInstall').append('<option></option>');
    $('#contactDetailsFloorRepairItEquipment').append('<option></option>');
    $('#contactDetailsFloorSystemEnhance').append('<option></option>');
    $('#contactDetailsFloorTechAssist').append('<option></option>');
    $('#contactDetailsFloorTrainingOrient').append('<option></option>');
    $('#contactDetailsFloorUserAccountMngt').append('<option></option>');
    $('#contactDetailsFloorVmcIdCard').append('<option></option>');
    $('#contactDetailsFloorRepairME').append('<option></option>');
    $('#contactDetailsFloorRepairOE').append('<option></option>');
    $('#contactDetailsFloorRepairAW').append('<option></option>');
    $('#contactDetailsFloorRepairCW').append('<option></option>');
    $('#contactDetailsFloorRepairEW').append('<option></option>');
    $('#contactDetailsFloorRepairPW').append('<option></option>');
    $('#contactDetailsFloorRepairTA').append('<option></option>');
    $('#contactDetailsFloorOthersEfms').append('<option></option>');
    $('#contactDetailsFloorEfmsTC').append('<option></option>');

    let getBuildingID = $(this).val();
          
    $.ajax({
      url: "/load_floor/"+getBuildingID, 
          type: 'GET', 
          success: function(res) {

            $.each(JSON.parse(res) , function(i , val){

            $('#contactDetailsFloorBio').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorHomis').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorZoom').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorOthersImiss').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorWebUploads').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorNetworkInstall').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorRepairItEquipment').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorSystemEnhance').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorTechAssist').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorTrainingOrient').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorUserAccountMngt').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorVmcIdCard').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorRepairME').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorRepairOE').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorRepairAW').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorRepairCW').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorRepairEW').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorRepairPW').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorRepairTA').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorOthersEfms').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            $('#contactDetailsFloorEfmsTC').append('<option value='+val.bldgfloor_id+'>'+val.bldgfloor_abbre+'</option>');
            });
          },
          error: function(error) {
              console.error(error);
          }
        });//EOF AJAX
    });// EOF ONCHANGE LOCATION
  });
</script>