$(function(){
	$("#service-form").validate({
		rules:{
			title:{
				required:true,
				rangelength:[2,20]
			},
			price:{
				required:true,
				rangelength:[2,5]
			},
			desctiprion:{
				required:true
			},
			feature_image:{
				required:true,

			}

		}
	});
	$("#confirm-book-form").validate({
		rules:{
			fname:{
				required:true,
				rangelength:[3,20]
			},
			lname:{
				required:true,
				rangelength:[3,20]
			},
			email:{
				required:true
			},
			contact_number:{
				required:true
			},
			country:{
				required:true
			},
			zip:{
				required:true
			},
			message:{
				required:true
			}
		},
		messages:{
			fname:"Please enter your first name",
			lname:"Please enter your last name",
		},
		submitHandler:function(form){
			if (confirm('Are you sure you want to book. you will book a new room')) {
				form.submit();
			}
		}
	});
	
});