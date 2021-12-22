<!-- jQuery -->
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script> 
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jqueryui/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/datetimepicker.min.js') }}"></script>
<script src="//cloud.tinymce.com/4.9/tinymce.min.js"></script>
<script src="{{ asset('assets/js/tinymce.init.js?ver=1.6') }}"></script>
 <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<footer>
    <div class="pull-right"></div>
    <div class="clearfix"></div>
</footer>
</div>
</div>
<script type="text/javascript">
	$('#arrival_airport').click(function(){
        if($(this).val() == 1){
        	$("._arrival_airport").show();
        	// $(".arrival_airport").prop('required',true);
        	$(".arrival_airport").prop('disabled',false);
        	// hide all others div
        	$("._arrival_hotel").hide();
        	// $(".arrival_hotel").prop('required',false);
        	$(".arrival_hotel").prop('disabled',true);
        	$("._arrival_car").hide();
        	// $(".arrival_car").prop('required',false);
        	$(".arrival_car").prop('disabled',true);
        	$("._arrival_others").hide();
        	// $(".arrival_others").prop('required',false);
        	$(".arrival_others").prop('disabled',true);
        	//
        }
    });

    $('#arrival_hotel').click(function(){
	    if($(this).val() == 2){
	    	$("._arrival_hotel").show();
	    	// $(".arrival_hotel").prop('required',true);
        	$(".arrival_hotel").prop('disabled',false);

	    	// hide all others div
	    	$("._arrival_airport").hide();
        	// $(".arrival_airport").prop('required',false);
        	$(".arrival_airport").prop('disabled',true);
	    	$("._arrival_car").hide();
        	// $(".arrival_car").prop('required',false);
        	$(".arrival_car").prop('disabled',true);
	    	$("._arrival_others").hide();
        	// $(".arrival_others").prop('required',false);
        	$(".arrival_others").prop('disabled',true);

	    	//
	    }
	});

	$('#arrival_car').click(function(){
	    if($(this).val() == 3){
	    	$("._arrival_car").show();
	    	// $(".arrival_car").prop('required',true);
        	$(".arrival_car").prop('disabled',false);
	    	// hide all others div
	    	$("._arrival_airport").hide();
        	// $(".arrival_airport").prop('required',false);
        	$(".arrival_airport").prop('disabled',true);
	    	$("._arrival_hotel").hide();
        	// $(".arrival_hotel").prop('required',false);
        	$(".arrival_hotel").prop('disabled',true);
	    	$("._arrival_others").hide();
        	// $(".arrival_others").prop('required',false);
        	$(".arrival_others").prop('disabled',true);

	    	//
	    }
	});

	$('#arrival_others').click(function(){
	    if($(this).val() == 4){
	    	$("._arrival_others").show();
	    	// $(".arrival_others").prop('required',true);
        	$(".arrival_others").prop('disabled',false);
	    	// hide all others div
	    	$("._arrival_airport").hide();
        	// $(".arrival_airport").prop('required',false);
        	$(".arrival_airport").prop('disabled',true);
	    	$("._arrival_hotel").hide();
        	// $(".arrival_hotel").prop('required',false);
        	$(".arrival_hotel").prop('disabled',true);
	    	$("._arrival_car").hide();
        	// $(".arrival_car").prop('required',false);
        	$(".arrival_car").prop('disabled',true);
	    	//
	    }
	});
	// code for departure
	 $('#departure_airport').click(function(){
        if($(this).val() == 1){
        	$("._departure_airport").show();
        	// $(".departure_airport").prop('required',true);
    		$(".departure_airport").prop('disabled',false);
        	// hide all others div
        	$("._departure_hotel").hide();
        	// $(".departure_hotel").prop('required',false);
    		$(".departure_hotel").prop('disabled',true);
        	$("._departure_car").hide();
        	// $(".departure_car").prop('required',false);
    		$(".departure_car").prop('disabled',true);
        	$("._departure_others").hide();
        	// $(".departure_others").prop('required',false);
    		$(".departure_others").prop('disabled',true);
        	//
        }
	});

	$('#departure_hotel').click(function(){
	    if($(this).val() == 2){
	    	$("._departure_hotel").show();
	    	// $(".departure_hotel").prop('required',true);
    		$(".departure_hotel").prop('disabled',false);
	    	// hide all others div
	    	$("._departure_airport").hide();
        	// $(".departure_airport").prop('required',false);
    		$(".departure_airport").prop('disabled',true);
	    	$("._departure_car").hide();
        	// $(".departure_car").prop('required',false);
    		$(".departure_car").prop('disabled',true);
	    	$("._departure_others").hide();
        	// $(".departure_others").prop('required',false);
    		$(".departure_others").prop('disabled',true);

	    	//
	    }
	}); 

	$('#departure_car').click(function(){
	    if($(this).val() == 3){
	    	$("._departure_car").show();
	    	// $(".departure_car").prop('required',true);
    		$(".departure_car").prop('disabled',false);
	    	// hide all others div
	    	$("._departure_airport").hide();
        	// $(".departure_airport").prop('required',false);
    		$(".departure_airport").prop('disabled',true);
	    	$("._departure_hotel").hide();
        	// $(".departure_hotel").prop('required',false);
    		$(".departure_hotel").prop('disabled',true);
	    	$("._departure_others").hide();
        	// $(".departure_others").prop('required',false);
    		$(".departure_others").prop('disabled',true);
	    	
	    	//
	    }
	});

	$('#departure_others').click(function(){
	    if($(this).val() == 4){
	    	$("._departure_others").show();
	    	// $(".departure_others").prop('required',true);
    		$(".departure_others").prop('disabled',false);
	    	// hide all others div
	    	$("._departure_airport").hide();
        	// $(".departure_airport").prop('required',false);
    		$(".departure_airport").prop('disabled',true);
	    	$("._departure_hotel").hide();
        	// $(".departure_hotel").prop('required',false);
    		$(".departure_hotel").prop('disabled',true);
	    	$("._departure_car").hide();
        	// $(".departure_car").prop('required',false);
    		$(".departure_car").prop('disabled',true);
	    	//
	    }
	});
	// end code for departure
	$(document).ready(function(){
	 <?php 
	 if(@$arrival['arr_service'] == 1 || @$arrival['arr_service'] == 'arr_airport'){ ?>
	 	$('#arrival_airport').trigger("click");
	<?php  	
	 }elseif(@$arrival['arr_service'] == 2 || @$arrival['arr_service'] == 'arr_hotel'){ ?>
	 	$('#arrival_hotel').trigger("click");
	 <?php 	
	 }elseif(@$arrival['arr_service'] == 3 || @$arrival['arr_service'] == 'arr_carhire'){ ?>
	 	$('#arrival_car').trigger("click");
	 <?php		 	
	 }elseif(@$arrival['arr_service'] == 4 || @$arrival['arr_service'] == 'arr_others'){ ?>
	 	$('#arrival_others').trigger("click");
	 <?php
	  }
	 ?>
	  <?php 
	  if(@$departure['dep_service'] == 1 || @$departure['dep_service'] == 'dep_airport'){ ?>
	  	$('#departure_airport').trigger("click");
	 <?php  	
	  }elseif(@$departure['dep_service'] == 2 || @$departure['dep_service'] == 'dep_hotel'){ ?>
	  	$('#departure_hotel').trigger("click");
	  <?php 	
	  }elseif(@$departure['dep_service'] == 3 || @$departure['dep_service'] == 'dep_Carhire'){ ?>
	  	$('#departure_car').trigger("click");
	  <?php		 	
	  }elseif(@$departure['dep_service'] == 4 || @$departure['dep_service'] == 'dep_others'){ ?>
	  	$('#departure_others').trigger("click");
	  <?php
	   }
	  ?>	 
	});
</script>
</body>
</html> 