$( document ).ready(function() { //wait until body loads

		//Inputs that determine what fields to show
		var inject_type = $('#intake_form #inject_type');
		var diabetes_type = $('#intake_form input:radio[name=diabetesType]');
		var optionsUseInsulinRadios = $('#intake_form input:radio[name=optionsUseInsulinRadios]');
		var optionsNotificationsRadios = $('#intake_form input:radio[name=optionsNotificationsRadios]');
		var optionsPasswordRadios = $('#intake_form input:radio[name=optionsPasswordRadios]');
		
		//Wrappers for all fields
		var pills = $('#intake_form #pills').parent();
		var use_insulin = $('#intake_form #use_insulin');
		var which_fast_insulin = $('#intake_form #which_fast_insulin');
		var which_slow_insulin = $('#intake_form #which_slow_insulin');
		var pump_provider = $('#intake_form #pump_provider').parent();
		var size_gauge = $('#intake_form #size_gauge').parent();
		var size_length  = $('#intake_form #size_length').parent();
		var size_volume  = $('#intake_form #size_volume').parent();
		var passwordField = $('#intake_form #passwordField').parent();
		var phoneNumber = $('#intake_form #phoneNumber').parent();

		diabetes_type.change(function(){
			var value=this.value;
			if(value =='2') {
				pills.removeClass('hidden');
				pills.prop('required',true);
				use_insulin.removeClass('hidden');
				$('#optionsUseInsulinRadios2').click().attr("checked","checked");
			} 
			
			if (value =='1') {
				pills.addClass('hidden');
				pills.prop('required',false);
				use_insulin.addClass('hidden');
				$('#optionsUseInsulinRadios1').click().attr("checked","checked");
			}
		});
		
		optionsUseInsulinRadios.change(function(){
			var value=this.value;
			if(value =='yes') {
				which_fast_insulin.parent().removeClass('hidden');
				which_slow_insulin.parent().removeClass('hidden');
				which_fast_insulin.prop('required',true);
				which_slow_insulin.prop('required',true);
				pills.addClass('hidden');
				pills.prop('required',false);
				inject_type.parent().removeClass('hidden');
			} 
			if (value =='no') {
				which_fast_insulin.parent().addClass('hidden');
				which_slow_insulin.parent().addClass('hidden');
				which_fast_insulin.prop('required',false);
				which_slow_insulin.prop('required',false);
				inject_type.parent().addClass('hidden');
				pills.removeClass('hidden');
				pills.prop('required',true);
			}
		});

		inject_type.change(function(){ //when the inject_type changes
			var value=[];
			$('#intake_form #inject_type option:selected').each(function(i, selected){ 
				value[i] = $(selected).text(); 
				console.log("value: " + value.length);


				if(value.length == 3) {
					console.log("all");
					size_length.removeClass('hidden');
              		size_gauge.removeClass('hidden');
              		pump_provider.removeClass('hidden');
				} else if(value.length ==2) {
					console.log("2");
					if(value[i] == "Pump") {
						size_length.removeClass('hidden');
						size_gauge.removeClass('hidden');
						pump_provider.removeClass('hidden');
					} else {
						size_length.removeClass('hidden');
						size_gauge.removeClass('hidden');
						pump_provider.addClass('hidden');
					}
				} else {
					if(value[i] == "Pens/Tips") {
						console.log("Pens/Tips");
						size_length.removeClass('hidden');
						size_gauge.removeClass('hidden');
					} else if(value[i] == "Vials/Syringes") {
						console.log("Vials/Syringes part of pen");
						size_length.removeClass('hidden');
						size_gauge.removeClass('hidden');
					} else {
						console.log("Hide Pens/Tips and Vials/Syringes");
						size_length.addClass('hidden');
						size_gauge.addClass('hidden');
					}

					if(value[i] == "Vials/Syringes") {
						console.log("Vials/Syringes");
						size_length.removeClass('hidden');
						size_gauge.removeClass('hidden');
					} else if(value[i] == "Pens/Tips") {
						console.log("Pens/Tips part of Vials/Syringes");
						size_length.removeClass('hidden');
						size_gauge.removeClass('hidden');
					} else {
						console.log("Hide Pens/Tips and Vials/Syringes");
						size_length.addClass('hidden');
						size_gauge.addClass('hidden');
					}

					if(value[i] == 'Pump') {
						console.log("Pump");
						pump_provider.removeClass('hidden');
					} else {
						pump_provider.addClass('hidden');
					}
				}

			});
			
			
		});	

		optionsPasswordRadios.change(function(){
			var value=this.value;
			if(value=="true") {
				passwordField.removeClass('hidden');
				passwordField.prop('required',true);
				phoneNumber.removeClass('hidden');
			} 
			if(value=="false"){
				passwordField.addClass('hidden');
				phoneNumber.removeClass('hidden');
			}
		});

		
});