var OrganizationUpdate = function () {

	var handleOrganizationEditInfo = function() {
            
		$('.organization-info-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                name: {
	                    required: true
	                },
	                type: {
	                	required: true
	                },
	                school_id: {
	                	required: true
	                },
	                c_admin_name: {
	                	required: true
	                },
	                c_admin_email: {
	                	required: true
	                },
	                description: {
	                	required: true
	                }
	            },

	            messages: {
	                name: {
	                    required: "请输入组织名称."
	                },
	                type: {
	                	required: "请输入组织类型."
	                },
	                school_id: {
	                	required: "请选择学校."
	                },
	                c_admin_name: {
	                	required: "请输入管理员姓名."
	                },
	                c_admin_email: {
	                	required: "请输入管理员联系邮箱."
	                },
	                description: {
	                	required: "请输入组织简介."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.organization-info-form')).show();
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
	};

	var handleOrganizationEditAdmin = function() {
            
		$('.organization-admin-form').validate({
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
	                	required: "请确认密码."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.organization-admin-form')).show();
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
	};
    
    return {
        //main function to initiate the module
        init: function () {
        	
        	handleOrganizationEditInfo();
        	handleOrganizationEditAdmin();
	       
        }

    };

}();