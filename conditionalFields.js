$( document ).ready(function() { //wait until body loads

		//Inputs that determine what fields to show
		var inject_type = $('#intake_form #inject_type').parent();
		var diabetes_type = $('#intake_form input:radio[name=diabetesType]');
		var optionsRadios = $('#intake_form input:radio[name=optionsRadios]');
		var optionsNotificationsRadios = $('#intake_form input:radio[name=optionsNotificationsRadios]');
		var optionsPasswordRadios = $('#intake_form input:radio[name=optionsPasswordRadios]');
		
		//Wrappers for all fields
		var pills = $('#intake_form #pills').parent();
		var use_insulin = $('#intake_form #use_insulin');
		var which_fast_insulin = $('#intake_form #which_fast_insulin').parent();
		var which_slow_insulin = $('#intake_form #which_slow_insulin').parent();
		var pump_provider = $('#intake_form #pump_provider').parent();
		var size_gauge = $('#intake_form #size_gauge').parent();
		var size_length  = $('#intake_form #size_length').parent();
		var size_volume  = $('#intake_form #size_volume').parent();
		var passwordField = $('#intake_form #passwordField').parent();
		var phoneNumber = $('#intake_form #phoneNumber').parent();
		
		optionsRadios.change(function(){
			var value=this.value;
			if(value =='yes') {
				which_fast_insulin.removeClass('hidden');
				which_slow_insulin.removeClass('hidden');
				inject_type.removeClass('hidden');
			} 
			if (value =='no') {
				which_fast_insulin.addClass('hidden');
				which_slow_insulin.addClass('hidden');
				inject_type.addClass('hidden');
				pills.removeClass('hidden');
			}
		});

		diabetes_type.change(function(){
			var value=this.value;
			if(value =='2') {
				pills.removeClass('hidden');
				
			} 
			if (value =='1') {
				pills.addClass('hidden');
				
			}
		});

		inject_type.change(function(){ //when the inject_type changes
			var value=[];
			$('#intake_form #inject_type option:selected').each(function(i, selected){ 
              value[i] = $(selected).text(); 
              alert(value[i]);
              
              if (value[i] == 'pen' || value[i] == 'vial'){
              	alert("pen");
              	size_length.removeClass('hidden');
              	size_gauge.removeClass('hidden');
              } else {
              	size_length.removeClass('hidden');
              	size_gauge.removeClass('hidden');
              }

              if(value[i] == 'pump') {
              	alert("pump");
              	pump_provider.removeClass('hidden');
              } else {
              	pump_provider.addClass('hidden')
              }
          });
		});	

		optionsPasswordRadios.change(function(){
			var value=this.value;
			if(value =='yes') {
				passwordField.removeClass('hidden');
				phoneNumber.removeClass('hidden');
			} 
			if (value =='no') {
				passwordField.addClass('hidden');
				phoneNumber.removeClass('hidden');
			}
		});

		
});