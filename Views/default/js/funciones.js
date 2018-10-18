$().ready(function(){
	$("#sesion").validate({
		rules:{
			email:{
				required:true,
				email:true
			},
			passwd:{
				required:true,
				minlength:6 
			}
		},
		messages:{
			email:{
				required:"<center><td colspan='2'><font color='red'>Por favor, escriba su Email</font></td></center>",
			},
			passwd:{
				required:"<center><td colspan='2'><font color='red'>Por favor, escriba su password</font></td></center>",
			}
		}
	});
	$("#email").focus();	
});


$().ready(function(){
	$("#Registrar").validate({
		rules:{
			email:{
				required:true,
				email:true
			},
			pwd:{
				required:true,
				minlength:6 
			}
		},
		messages:{
			email:{
				required:"<center><td colspan='2'><font color='red'>Por favor, escriba su Email</font></td></center>",
			},
			pwd:{
				required:"<center><td colspan='2'><font color='red'>Por favor, escriba su password</font></td></center>",
			}
		}
	});
	$("#name").focus();
});