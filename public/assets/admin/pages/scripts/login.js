var Login = function () {

	var handleLogin = function() {

		
		
		$('.change_password_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
            	oldpassword: {
                    required: true
                },
                newpassword: {
                	required: true
                },
                rpassword: {
                    equalTo: "#newpassword"
                }
                
                
            },
		
            messages: {
            	password: {
            		required: "请填写新密码."
            	}
            },
            
            invalidHandler: function (event, validator) { //display error alert on form submit   

            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                form.submit();
            }
            
            
            
		 });
		
		$('.reset-passwd-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                password: {
                    required: true
                },
                rpassword: {
                    equalTo: "#password"
                },
            },
		
            messages: {
            	password: {
            		required: "请填写新密码."
            	}
            },
            
            invalidHandler: function (event, validator) { //display error alert on form submit   

            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                form.submit();
            }
		 });
            
            
		$('.login-form').validate({
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
	                remember: {
	                    required: false
	                }
	            },

	            messages: {
	                username: {
	                    required: "请填写用户名."
	                },
	                password: {
	                    required: "请填写邮箱."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.login-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit(); // form validation success, call ajax form submit
	            }
	        });

	        $('.login-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.login-form').validate().form()) {
	                    $('.login-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	}

	var handleForgetPassword = function () {
		$('.forget-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                }
	            },

	            messages: {
	                email: {
	                    required: "Email is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

	        $('.forget-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.forget-form').validate().form()) {
	                    $('.forget-form').submit();
	                }
	                return false;
	            }
	        });

	        jQuery('#forget-password').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.forget-form').show();
	        });

	        jQuery('#back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.forget-form').hide();
	        });

	}

	var handleRegister = function () {

        function format(state) {
        	return state.text;
            if (state.id) return state.text; // optgroup
            return "<img class='flag' src='../../assets/global/img/flags/" + "ug.png'/>&nbsp;&nbsp;" + state.text;
        }


		$("#select2_sample4").select2({
			placeholder: '<i class="fa fa-edit"></i>&nbsp;组织类型',
            allowClear: true,
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function (m) {
                return m;
            }
        });


			$('#select2_sample4').change(function () {
                $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });

			$("#select2_sample5").select2({
			  	placeholder: '<i class="fa fa-edit"></i>&nbsp;所属学校',
	            allowClear: true,
	            formatResult: format,
	            formatSelection: format,
	            escapeMarkup: function (m) {
	                return m;
	            }
	        });


				$('#select2_sample5').change(function () {
	                $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
	            });
				

			$("#select2_orgtype").select2({
			  	placeholder: '<i class="fa fa-bars"></i>&nbsp;组织类型',
	            allowClear: true,
	            formatResult: format,
	            formatSelection: format,
	            escapeMarkup: function (m) {
	                return m;
	            }
	        });


				$('#select2_orgtype').change(function () {
	                $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
	            });
				

			$("#select2_school").select2({
			  	placeholder: '<i class="fa fa-map-marker"></i>&nbsp;所属学校',
	            allowClear: true,
	            formatResult: format,
	            formatSelection: format,
	            escapeMarkup: function (m) {
	                return m;
	            }
	        });


				$('#select2_orgtype').change(function () {
	                $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
	            });


         $('.register-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                
	            	username: {
	                    required: true,
	                    email: true
	                },
	                password: {
	                    required: true
	            
	                },
	                rpassword: {
	                    equalTo: "#register_password"
	                },
	                organname: {
	                    required: true
	            
	                },
	                category: {
	                    required: true
	            
	                },
	                organintroduce: {
	                    required: true
	            
	                },
	                adminname: {
	                    required: true
	            
	                },
	                adminemail: {
	                    required: true
	            
	                },
	                schools: {
	                    required: true
	            
	                },
	                image: {
	                    required: true
	            
	                },

	                tnc: {
	                    required: true
	                }
	            },

	            messages: { // custom messages for radio buttons and checkboxes
	                tnc: {
	                    required: "请先同意协议"
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
	                    error.insertAfter($('#register_tnc_error'));
	                } else if (element.closest('.input-icon').size() === 1) {
	                    error.insertAfter(element.closest('.input-icon'));
	                } else {
	                	error.insertAfter(element);
	                }
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

			$('.register-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.register-form').validate().form()) {
	                    $('.register-form').submit();
	                }
	                return false;
	            }
	        });

	        jQuery('#register-btn').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.register-form').show();
	        });

	        jQuery('#register-back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.register-form').hide();
	        });
	}
    
    return {
        //main function to initiate the module
        init: function () {
        	
            handleLogin();
            handleForgetPassword();
            handleRegister();        
	       
        }

    };

}();