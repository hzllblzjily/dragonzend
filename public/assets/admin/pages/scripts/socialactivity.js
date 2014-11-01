function setBeginTime() {
	fakeBeginTime = document.getElementById("fakeBeginTime").value;

	tmp = parseInt(fakeBeginTime.substr(5,2))-1;
	t1=new Date(fakeBeginTime.substr(0,4),tmp,fakeBeginTime.substr(8,2),fakeBeginTime.substr(11,2),fakeBeginTime.substr(14,2)); //创建一个Date对象
	localTime = t1.getTime();
	//localOffset = t1.getTimezoneOffset()*60000; //获得当地时间偏移的毫秒数
	localOffset = 0;
	utc = localTime + localOffset;
	document.getElementById("f_beginTime").value = utc/1000;
}

function setEndTime() {
	fakeEndTime = document.getElementById("fakeEndTime").value;

	tmp = parseInt(fakeEndTime.substr(5,2))-1;
	t1=new Date(fakeEndTime.substr(0,4),tmp,fakeEndTime.substr(8,2),fakeEndTime.substr(11,2),fakeEndTime.substr(14,2)); //创建一个Date对象
	localTime = t1.getTime();
	//localOffset = t1.getTimezoneOffset()*60000; //获得当地时间偏移的毫秒数
	localOffset = 0;
	utc = localTime + localOffset;
	document.getElementById("f_endTime").value = utc/1000;
}

var SocialActivityUpdate = function () {

	var handleSocialActivityUpdate = function() {
            
		$('.socialactivity-update-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                title: {
	                    required: true
	                },
	                category_id: {
	                	required: true
	                },
	                fakeStartTime: {
	                	required: true
	                },
	                fakeEndTime: {
	                	required: true
	                },
	                location: {
	                	required: true
	                },
	                address: {
	                	required: true
	                },
	                sponsor: {
	                	required: true
	                },
	                description: {
	                	required: true
	                },
	                picture: {
	                	required: true
	                }
	            },

	            messages: {
	                title: {
	                    required: "请输入活动名称."
	                },
	                category_id: {
	                	required: "请选择活动类型."
	                },
	                fakeStartTime: {
	                	required: "请选择同城活动开始时间."
	                },
	                fakeEndTime: {
	                	required: "请选择同城活动结束时间."
	                },
	                location: {
	                	required: "请输入活动地点名称."
	                },
	                address: {
	                	required: "请输入活动地址."
	                },
	                sponsor: {
	                	required: "请输入主办方名称."
	                },
	                description: {
	                	required: "请简单介绍一下活动吧."
	                },
	                picture: {
	                	required: "请上传活动海报."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.socialactivity-update-form')).show();
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

	var handleSocialActivityEdit = function() {
            
		$('.socialactivity-edit-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                title: {
	                    required: true
	                },
	                category_id: {
	                	required: true
	                },
	                fakeStartTime: {
	                	required: true
	                },
	                fakeEndTime: {
	                	required: true
	                },
	                location: {
	                	required: true
	                },
	                address: {
	                	required: true
	                },
	                sponsor: {
	                	required: true
	                },
	                description: {
	                	required: true
	                }
	            },

	            messages: {
	                title: {
	                    required: "请输入活动名称."
	                },
	                category_id: {
	                	required: "请选择活动类型."
	                },
	                fakeStartTime: {
	                	required: "请选择同城活动开始时间."
	                },
	                fakeEndTime: {
	                	required: "请选择同城活动结束时间."
	                },
	                location: {
	                	required: "请输入活动地点名称."
	                },
	                address: {
	                	required: "请输入活动地址."
	                },
	                sponsor: {
	                	required: "请输入主办方名称."
	                },
	                description: {
	                	required: "请简单介绍一下活动吧."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.socialactivity-edit-form')).show();
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

	var handleSocialActivityCategoryUpdate = function() {
            
		$('.socialactivity-category-update-form').validate({
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
	                    required: "请输入活动类型名称."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.socialactivity-category-update-form')).show();
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

	        $('.socialactivity-category-update-form').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.socialactivity-category-update-form').validate().form()) {
	                    $('.socialactivity-category-update-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	};
    
    return {
        //main function to initiate the module
        init: function () {
        	
        	handleSocialActivityUpdate();
        	handleSocialActivityEdit();
        	handleSocialActivityCategoryUpdate();
	       
        }

    };

}();