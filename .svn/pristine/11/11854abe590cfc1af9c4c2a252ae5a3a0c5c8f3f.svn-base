var f_beginTime, f_endTime;
var option_count = 0;
var isPicture = 1;

function setIsPicture(number) {
	isPicture = number;
}

function setOptionCount(number) {
	option_count = number;
}

function changeDate() {
	resetTime();
};

function changeTime() {
	if (document.getElementById("fakeDate").value == "") {
		return;
	};
	resetTime();
};

function resetTime() {
	fakeBeginTime = document.getElementById("fakeBeginTime").value;
	fakeEndTime = document.getElementById("fakeEndTime").value;
	fakeDate = document.getElementById("fakeDate").value;

	tmp = parseInt(fakeDate.substr(5,2))-1;

	if (fakeBeginTime.substr(1,1) == ":") {
		t1 = new Date(fakeDate.substr(0,4),tmp,fakeDate.substr(8,2),fakeBeginTime.substr(0,1),fakeBeginTime.substr(2,2)); //创建一个Date对象
	} else t1 = new Date(fakeDate.substr(0,4),tmp,fakeDate.substr(8,2),fakeBeginTime.substr(0,2),fakeBeginTime.substr(3,2)); //创建一个Date对象;
	
	localTime = t1.getTime();
	//localOffset = t1.getTimezoneOffset()*60000; //获得当地时间偏移的毫秒数
	localOffset = 0;
	utc = localTime + localOffset;
	document.getElementById("f_beginTime").value = utc/1000;

	if (fakeEndTime.substr(1,1) == ":") {
		t2 = new Date(fakeDate.substr(0,4),tmp,fakeDate.substr(8,2),fakeEndTime.substr(0,1),fakeEndTime.substr(2,2)); //创建一个Date对象
	} else t2 = new Date(fakeDate.substr(0,4),tmp,fakeDate.substr(8,2),fakeEndTime.substr(0,2),fakeEndTime.substr(3,2)); //创建一个Date对象;
	
	localTime = t2.getTime();
	//localOffset = t2.getTimezoneOffset()*60000; //获得当地时间偏移的毫秒数
	utc = localTime + localOffset;
	document.getElementById("f_endTime").value = utc/1000;
};

function resetGrabTicketTime() {
	fakeStartTime = document.getElementById("fakeStartTime").value;
	
	if( fakeStartTime == "")
	{return; }
	tmp = parseInt(fakeStartTime.substr(5,2))-1;
	t3=new Date(fakeStartTime.substr(0,4),tmp,fakeStartTime.substr(8,2),fakeStartTime.substr(11,2),fakeStartTime.substr(14,2)); //创建一个Date对象
	localTime = t3.getTime();
	//localOffset = t1.getTimezoneOffset()*60000; //获得当地时间偏移的毫秒数
	localOffset = 0;
	utc = localTime + localOffset;
	document.getElementById("f_startTime").value = utc/1000;
};

function resetVoteTime() {
	fakeBeginTime = document.getElementById("fakeVoteStartTime").value;
	fakeEndTime = document.getElementById("fakeVoteEndTime").value;
	if( fakeBeginTime == "")
	{return; }

	tmp = parseInt(fakeBeginTime.substr(5,2))-1;
	t1=new Date(fakeBeginTime.substr(0,4),tmp,fakeBeginTime.substr(8,2),fakeBeginTime.substr(11,2),fakeBeginTime.substr(14,2)); //创建一个Date对象
	localTime = t1.getTime();
	//localOffset = t1.getTimezoneOffset()*60000; //获得当地时间偏移的毫秒数
	localOffset = 0;
	utc = localTime + localOffset;
	document.getElementById("voteBeginTime").value = utc/1000;

	tmp = parseInt(fakeEndTime.substr(5,2))-1;
	t2=new Date(fakeEndTime.substr(0,4),tmp,fakeEndTime.substr(8,2),fakeEndTime.substr(11,2),fakeEndTime.substr(14,2)); //创建一个Date对象
	localTime = t2.getTime();
	//localOffset = t2.getTimezoneOffset()*60000; //获得当地时间偏移的毫秒数
	utc = localTime + localOffset;
	document.getElementById("voteEndTime").value = utc/1000;
};

function add_voter() {
	if (isPicture == 1) {
		var insertContent = insertPictureBlock();
		var myelement = document.createElement("div");
		myelement.innerHTML = insertContent;
		document.getElementById('voter_container').appendChild(myelement);
	}else if (isPicture == 0) {
		var insertContent = insertVideoBlock();
		var myelement = document.createElement("div");
		myelement.innerHTML = insertContent;
		document.getElementById('voter_container').appendChild(myelement);
	};
	
};

function insertPictureBlock() {
	option_count ++;
	document.getElementById('option_count').value = option_count;
	return '<div class="well"><div class="form-group"><button class="btn btn-default" onclick="deleteBlock(this)">删除</button><label class="control-label col-md-4">候选人名称</label><div class="col-md-6"><input type="hidden" name = "option_id' + option_count +'" value="0"><input type="text" name = "option_name' + option_count 
			+'" id="voter_name" class="form-control" placeholder="" ></div></div><div class="form-group"><label class="control-label col-md-4">简单描述</label><div class="col-md-6"><textarea name = "option_description' + option_count
			+'" id="voter_description" class="form-control" rows="3"></textarea></div></div><div class="form-group" name="img-container"><label class="col-md-4 control-label">配图</label><div class="col-md-6"><div class="fileinput fileinput-new input-area" data-provides="fileinput"><div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/></div><div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div><div><span class="btn default btn-file"><span class="fileinput-new">选择上传 </span><span class="fileinput-exists">更换图片 </span><input type="file" name="option_picture' + option_count 
			+'" id="voter_picture"></span></div></div><div class="clearfix margin-top-10"><span class="label label-warning">提示 </span>建议5:3的比例，支持jpg或png格式</div></div></div><div class="form-group" name="video-link-container" style="display:none"><label class="control-label col-md-4">视频链接网址</label><div class="col-md-6"><input type="text" name = "video_url' + option_count
			+'" class="form-control" placeholder="" ></div></div></div>';
};

function insertVideoBlock() {
	option_count ++;
	document.getElementById('option_count').value = option_count;
	return '<div class="well"><div class="form-group"><button class="btn btn-default" onclick="deleteBlock(this)">删除</button><label class="control-label col-md-4">候选人名称</label><div class="col-md-6"><input type="hidden" name = "option_id' + option_count +'" value="0"><input type="text" name = "option_name' + option_count 
			+'" id="voter_name" class="form-control" placeholder="" ></div></div><div class="form-group"><label class="control-label col-md-4">简单描述</label><div class="col-md-6"><textarea name = "option_description' + option_count
			+'" id="voter_description" class="form-control" rows="3"></textarea></div></div><div class="form-group" name="img-container" style="display:none"><label class="col-md-4 control-label">配图</label><div class="col-md-6"><div class="fileinput fileinput-new input-area" data-provides="fileinput"><div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/></div><div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div><div><span class="btn default btn-file"><span class="fileinput-new">选择上传 </span><span class="fileinput-exists">更换图片 </span><input type="file" name="option_picture' + option_count 
			+'" id="voter_picture"></span></div></div><div class="clearfix margin-top-10"><span class="label label-warning">提示 </span>建议5:3的比例，支持jpg或png格式</div></div></div><div class="form-group" name="video-link-container"><label class="control-label col-md-4">视频链接网址</label><div class="col-md-6"><input type="text" name = "video_url' + option_count
			+'" class="form-control" placeholder="" ></div></div></div>';
};

function deleteBlock(element) {
	element.parentNode.parentNode.parentNode.removeChild(element.parentNode.parentNode);
};

function changeOptionStyle() {
	var index = document.getElementById('option_style_selecter').selectedIndex;
	var text = document.getElementById('option_style_selecter').options[index].text;
	var img_array = document.getElementsByName("img-container");
	var video_array = document.getElementsByName("video-link-container");
	if (text == "图片+文字") {
		isPicture = 1;
		for (var i = img_array.length - 1; i >= 0; i--) {
			img_array[i].style.display = "block";
			video_array[i].style.display = "none";
		}
	} else if (text == "视频+文字") {
		isPicture = 0;
		for (var i = img_array.length - 1; i >= 0; i--) {
			img_array[i].style.display = "none";
			video_array[i].style.display = "block";
		}
	}
};

var ActivityUpdate = function () {

	var handleActivityBasicUpdate = function() {
            
		$('.activity-basic-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                title: {
	                    required: true
	                },
	                speaker: {
	                	required: true
	                },
	                fakeDate: {
	                	required: true
	                },
	                fakeBeginTime: {
	                	required: true
	                },
	                fakeEndTime: {
	                	required: true
	                },
	                location: {
	                	required: true
	                },
	                content: {
	                	required: true
	                },
	                image: {
	                	required: true
	                }
	            },

	            messages: {
	                title: {
	                    required: "请输入活动名称."
	                },
	                speaker: {
	                	required: "请输入地点主讲人nok号."
	                },
	                fakeDate: {
	                	required: "请选择活动日期."
	                },
	                fakeBeginTime: {
	                	required: "请选择活动开始时间."
	                },
	                fakeEndTime: {
	                	required: "请选择活动结束时间."
	                },
	                location: {
	                	required: "请输入活动地点."
	                },
	                content: {
	                	required: "请简单介绍一下活动吧."
	                },
	                image: {
	                	required: "请上传图片"
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.activity-basic-form')).show();
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

	var handleActivityBasicEditUpdate = function() {
            
		$('.activity-basic-edit-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                title: {
	                    required: true
	                },
	                speaker: {
	                	required: true
	                },
	                fakeDate: {
	                	required: true
	                },
	                fakeBeginTime: {
	                	required: true
	                },
	                fakeEndTime: {
	                	required: true
	                },
	                location: {
	                	required: true
	                },
	                content: {
	                	required: true
	                }
	            },

	            messages: {
	                title: {
	                    required: "请输入活动名称."
	                },
	                speaker: {
	                	required: "请输入地点主讲人nok号."
	                },
	                fakeDate: {
	                	required: "请选择活动日期."
	                },
	                fakeBeginTime: {
	                	required: "请选择活动开始时间."
	                },
	                fakeEndTime: {
	                	required: "请选择活动结束时间."
	                },
	                location: {
	                	required: "请输入活动地点."
	                },
	                content: {
	                	required: "请简单介绍一下活动吧."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.activity-basic-edit-form')).show();
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

	var handleActivitySponsorUpdate = function() {
            
		$('.activity-sponsor-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                sponsor_name: {
	                    required: true
	                },
	                sponsor_url: {
	                	required: true,
	                	url: true
	                }
	            },

	            messages: {
	                sponsor_name: {
	                    required: "请输入赞助商名称."
	                },
	                sponsor_url: {
	                	required: "请输入赞助商网址.",
	                	url: "请输入正确的网址."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.activity-sponsor-form')).show();
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

	        $('.activity-sponsor-form').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.activity-sponsor-form').validate().form()) {
	                    $('.activity-sponsor-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	};

	var handleActivityGrabTicketUpdate = function() {
            
		$('.activity-grab-ticket-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                startTime: {
	                    required: true
	                },
	                number: {
	                	required: true,
	                	digits: true
	                }
	            },

	            messages: {
	                startTime: {
	                    required: "请选择抢票开始时间."
	                },
	                number: {
	                	required: "请输入提供的总票数.",
	                	url: "请输入正确的数量."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.activity-grab-ticket-form')).show();
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

	        $('.activity-grab-ticket-form').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.activity-grab-ticket-form').validate().form()) {
	                    $('.activity-grab-ticket-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	};

	var handleActivityVoteUpdate = function() {
            
		$('.activity-vote-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                beginTime: {
	                    required: true
	                },
	                endTime: {
	                	required: true
	                }
	            },

	            messages: {
	                beginTime: {
	                    required: "请选择投票开始时间."
	                },
	                endTime: {
	                	required: "请选择投票结束时间."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.activity-vote-form')).show();
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
        	
        	handleActivityBasicUpdate();
        	handleActivityBasicEditUpdate();
        	handleActivitySponsorUpdate();
        	handleActivityGrabTicketUpdate();
        	handleActivityVoteUpdate();
	       
        }

    };

}();

function postToWeibo(text,activityId) {
	var xx = new Object();
   	xx.title = text;
   	xx.activity_id = activityId;
   	jInfo = JSON.stringify(xx);

	jQuery.ajax({
        type : "POST",  
        contentType : "application/json",  
        url : "/adminsbk/shareweibo",
        beforeSend: function(request) {
            //request.setRequestHeader("Auth-Token", "37636f37cd7779459eea00699bfc0a12");
        },
        data : jInfo,
        success : function(data){
        	$('#modal_weibo').modal('hide');
        	$('#modal_weibo_success').modal('show');
        },  
        error : function(data){
        	if(data.responseText[0].errCode == "30188") {
        		alert("您的微薄授权已过期，请在右上角的下拉菜单中重新绑定微薄账号");
        		weibounbind();
        	}
        }
    });

}