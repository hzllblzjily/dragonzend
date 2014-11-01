var ActivityCategoryUpdate = function () {

	var handleActivityCategoryAdd = function() {
            
		$('.category-add-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                categoryname: {
	                    required: true
	                },
	                color: {
	                	required: true
	                },
	                picture: {
	                	required:true
	                }
	            },

	            messages: {
	                categoryname: {
	                    required: "请输入活动分类."
	                },
	                color: {
	                	required: "请选择分类颜色."
	                },
	                picture: {
	                	required: "请上传分类图标"
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.category-add-form')).show();
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

	        $('.category-add-form').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.category-add-form').validate().form()) {
	                    $('.category-add-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	};

	var handleActivityCategoryEdit = function() {
            
		$('.category-edit-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                categoryname: {
	                    required: true
	                },
	                color: {
	                	required: true
	                }
	            },

	            messages: {
	                categoryname: {
	                    required: "请输入活动分类."
	                },
	                color: {
	                	required: "请选择分类颜色."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.category-edit-form')).show();
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

	        $('.category-edit-form').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.category-edit-form').validate().form()) {
	                    $('.category-edit-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	};
    
    return {
        //main function to initiate the module
        init: function () {
        	
        	handleActivityCategoryAdd();
        	handleActivityCategoryEdit();
	       
        }

    };

}();