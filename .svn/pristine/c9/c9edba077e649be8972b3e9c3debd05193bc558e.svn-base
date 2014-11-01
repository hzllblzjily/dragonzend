var SchoolAdminUpdate = function () {

	var handleSchoolAdminAdd = function() {
            
		$('.schoolAdmin-add-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                username: {
	                    required: true
	                },
	                name: {
	                	required: true
	                },
	                password: {
	                	required: true
	                },
	                rpassword: {
	                	required: true
	                }
	            },

	            messages: {
	                username: {
	                    required: "请输入登录邮箱."
	                },
	                name: {
	                	required: "请输入管理员姓名."
	                },
	                password: {
	                	required: "请输入密码."
	                },
	                rpassword: {
	                	equalTo: "两次密码不一致."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.schoolAdmin-add-form')).show();
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

	        $('.schoolAdmin-add-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.schoolAdmin-add-form').validate().form()) {
	                    $('.schoolAdmin-add-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	}

	var handleSchoolAdminEditBasic = function() {
            
		$('.schoolAdmin-editBasic-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                username: {
	                    required: true
	                },
	                password: {
	                	required: true
	                },
	                rpassword: {
	                	required: true
	                }
	            },

	            messages: {
	                username: {
	                    required: "请输入登录邮箱."
	                },
	                password: {
	                	required: "请输入密码."
	                },
	                rpassword: {
	                	equalTo: "两次密码不一致."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.schoolAdmin-editBasic-form')).show();
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

	        $('.schoolAdmin-editBasic-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.schoolAdmin-editBasic-form').validate().form()) {
	                    $('.schoolAdmin-editBasic-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	}

	var handleSchoolAdminEditMore = function() {
            
		$('.schoolAdmin-editMore-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                name: {
	                	required: true
	                }
	            },

	            messages: {
	                name: {
	                	required: "请输入管理员姓名."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.schoolAdmin-editMore-form')).show();
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

	        $('.schoolAdmin-editMore-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.schoolAdmin-editMore-form').validate().form()) {
	                    $('.schoolAdmin-editMore-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	}
    
    return {
        //main function to initiate the module
        init: function () {
        	
            handleSchoolAdminAdd();   
            handleSchoolAdminEditBasic();
            handleSchoolAdminEditMore();
	       
        }

    };

}();