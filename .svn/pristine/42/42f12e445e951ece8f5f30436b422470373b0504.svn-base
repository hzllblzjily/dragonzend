var SchoolUpdate = function () {

	var handleSchoolAdd = function() {
            
		$('.school-add-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                schoolChineseName: {
	                    required: true
	                },
	                schoolEnglishName: {
	                	required: true
	                },
	                schoolMotto: {
	                	required: true
	                },
	                bgColor: {
	                	required: true
	                },
	                region_id: {
	                	required: true
	                },
	                schoolIcon: {
	                	required: true
	                },
	                schoolBg: {
	                	required: true
	                }
	            },

	            messages: {
	                schoolChineseName: {
	                    required: "请输入学校的中文名称."
	                },
	                schoolEnglishName: {
	                	required: "请输入学校的英文名称."
	                },
	                schoolMotto: {
	                	required: "请输入校训."
	                },
	                bgColor: {
	                	required: "请输入学校的背景颜色."
	                },
	                region_id: {
	                	required: "请选择该学校属于的区域."
	                },
	                schoolIcon: {
	                	required: "请上传学校Icon."
	                },
	                schoolBg: {
	                	required: "请上传学校的背景图片."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.school-add-form')).show();
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

	        $('.school-add-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.school-add-form').validate().form()) {
	                    $('.school-add-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	};
	
	var handleSchoolEdit = function() {
        
		$('.school-edit-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                schoolChineseName: {
	                    required: true
	                },
	                schoolEnglishName: {
	                	required: true
	                },
	                schoolMotto: {
	                	required: true
	                },
	                bgColor: {
	                	required: true
	                },
	                region_id: {
	                	required: true
	                }
	            },

	            messages: {
	                schoolChineseName: {
	                    required: "请输入学校的中文名称."
	                },
	                schoolEnglishName: {
	                	required: "请输入学校的英文名称."
	                },
	                schoolMotto: {
	                	required: "请输入校训."
	                },
	                bgColor: {
	                	required: "请输入学校的背景颜色."
	                },
	                region_id: {
	                	required: "请选择该学校属于的区域."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.school-edit-form')).show();
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

	        $('.school-edit-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.school-edit-form').validate().form()) {
	                    $('.school-edit-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	};
    
    return {
        //main function to initiate the module
        init: function () {
        	
        	handleSchoolAdd();
            handleSchoolEdit();
	       
        }

    };

}();