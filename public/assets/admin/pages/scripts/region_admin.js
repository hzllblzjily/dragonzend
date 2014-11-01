var RegionAdminUpdate = function () {


	var handleRegionAdminAdd = function() {

		$('.regionAdmin-add-form').validate({
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
                	equalTo: "#password"
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
                	equalTo: "两次输入密码不相等."
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
	}

	var handleRegionAdminEditBasic = function() {
			
		$('.regionAdmin-editBasic-form').validate({
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
                $('.alert-danger', $('.region-editBasic-form')).show();
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

        $('.region-editBasic-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.region-editBasic-form').validate().form()) {
                    $('.region-editBasic-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
	}

	var handleRegionAdminEditMore = function() {
			
		$('.regionAdmin-editMore-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input

        	rules: {
                name: {
                	required: true
                },
                password: {
                	required: true
                },
                rpassword: {
                	equalTo: "#password"
                }
            },

            messages: {
                name: {
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
                $('.alert-danger', $('.region-editMore-form')).show();
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

        $('.region-editMore-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.region-editMore-form').validate().form()) {
                    $('.region-editMore-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
	}

    
    return {
        //main function to initiate the module
        init: function () {
        	
            handleRegionAdminAdd();   
            handleRegionAdminEditBasic();
            handleRegionAdminEditMore();
	       
        }

    };

}();


function checkEmailExist() {
	var dataInfo = null;
	username = document.getElementById("username");
	id = document.getElementById("id"); //如果是edit
	if(id == null){
		dataInfo = "email="+username.value;
	}else{
		dataInfo = "email="+username.value+"&id="+id.value;
	}
	var result;
	if (document.getElementById("username").value != "") {
		jQuery.ajax({
		    type : "GET",  
		    contentType : "application/json",  
		    url : "/adminsbk/checkemailexist",
		    data : dataInfo,
		    success : function(data){
		    	//alert("success");
		    	result = data.value;
		    	if (result == 0 && ! $(".login-email-container").closest(".form-group").hasClass('has-error')) {
		    		$(".login-email-container").closest(".form-group").addClass('has-error');
	                $(".login-email-container").append("<span id=\"help\" class=\"help-block\">该邮箱已被注册.</span>");
		    	}else {
		    		if(result != 0){
		    			$(".login-email-container").closest(".form-group").removeClass('has-error');
		                $("#help").remove();
		    		}
		    	};
		    },  
		    error : function(){
		    	//alert("服务器正忙");
		    }
	    });
	}


}