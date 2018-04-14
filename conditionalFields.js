$( document ).ready(function() { //wait until body loads

		//Inputs that determine what fields to show
		var inject_type = $('#intake_form #inject_type').parent();
		var optionsRadios = $('#intake_form input:radio[name=optionsRadios]');
		var diabetes_type = $('#intake_form input:radio[name=diabetesType]');
		
		//Wrappers for all fields
		var pills = $('#intake_form #pills').parent();
		var use_insulin = $('#intake_form #use_insulin');
		var which_insulin = $('#intake_form #which_insulin').parent();
		var pump_provider = $('#intake_form #pump_provider').parent();
		var size_gauge = $('#intake_form #size_gauge').parent();
		var size_length  = $('#intake_form #size_length').parent();
		var size_volume  = $('#intake_form #size_volume').parent();
		//var all=bad.add(ok).add(great).add(testimonial_parent).add(thanks_anyway); //shortcut for all wrapper elements
		
		optionsRadios.change(function(){
			var value=this.value;
			if(value =='yes') {
				which_insulin.removeClass('hidden');
				inject_type.removeClass('hidden');
			} 
			if (value =='no') {
				which_insulin.addClass('hidden');
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
			var value = $('#intake_form #inject_type').val();

			if (value == 'vial') {
				size_volume.removeClass('hidden');
			} else {
				size_volume.addClass('hidden');
			}

			if (value == 'pen' || value == 'vial'){
				size_length.removeClass('hidden');
				size_gauge.removeClass('hidden');
			}

			if (value != 'pen' && value != 'vial') {
				size_length.addClass('hidden');
				size_gauge.addClass('hidden');
			}

			if(value == 'pump') {
				pump_provider.removeClass('hidden');
			} else {
				pump_provider.addClass('hidden')
			}

		});	

		
});