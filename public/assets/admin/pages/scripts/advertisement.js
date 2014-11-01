function changeType() {
	if ($('#select_type option:selected').val() == "外部链接") {
		document.getElementById('activity_type').className = "form-group hidden";
		document.getElementById('activity_id').className = "form-group hidden";
		document.getElementById('url').className = "form-group";
	}else if ($('#select_type option:selected').val() == "置顶活动") {
		document.getElementById('activity_type').className = "form-group";
		document.getElementById('activity_id').className = "form-group";
		document.getElementById('url').className = "form-group hidden";
	};
}

var AdvertisementUpdate = function () {

	var handleAdvertisementUpdate = function() {
            
		$('.advertisement-update-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            
            	rules: {
	                title: {
	                    required: true
	                },
	                url: {
	                	required: true,
	                	url: true
	                },
	                picture: {
	                	required: true
	                }
	            },

	            messages: {
	                title: {
	                    required: "请输入标题名称."
	                },
	                url: {
	                	required: "请输入网址链接.",
	                	url: "请输入正确的网址."
	                },
	                picture: {
	                	required: "请选择上传图片."
	                }
	            },
	            

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.advertisement-update-form')).show();
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

	        $('.advertisement-update-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.advertisement-update-form').validate().form()) {
	                    $('.advertisement-update-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	}
	
	var handleAdvertisementEdit = function() {
        
		$('.advertisement-edit-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            
            	rules: {
	                title: {
	                    required: true
	                },
	                url: {
	                	required: true,
	                	url: true
	                }
	            },

	            messages: {
	                title: {
	                    required: "请输入标题名称."
	                },
	                url: {
	                	required: "请输入网址链接.",
	                	url: "请输入正确的网址."
	                }
	            },
	            

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.advertisement-edit-form')).show();
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

	        $('.advertisement-edit-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.advertisement-edit-form').validate().form()) {
	                    $('.advertisement-edit-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	}
    
    return {
        //main function to initiate the module
        init: function () {
        	
            handleAdvertisementUpdate(); 
            handleAdvertisementEdit();
	       
        }

    };

}();