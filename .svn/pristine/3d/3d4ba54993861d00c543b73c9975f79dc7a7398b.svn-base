var RegionUpdate = function () {

	var handleRegionUpdate = function() {
            
		$('.region-update-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                regionName: {
	                    required: true
	                }
	            },

	            messages: {
	                regionName: {
	                    required: "请输入区域名称."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.region-update-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-area'));
	            },

	            submitHandler: function (form) {
	                form.submit(); // form validation success, call ajax form submit
	            }
	        });

	        $('.region-update-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.region-update-form').validate().form()) {
	                    $('.region-update-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	};

    
    return {
        //main function to initiate the module
        init: function () {
        	
            handleRegionUpdate();   
	       
        }

    };

}();