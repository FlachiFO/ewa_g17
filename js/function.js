$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			user_email: {
            required: true,
            user_name: true
            },
	   },
       messages:
	   {
            password:{
                      required: "please enter your password"
                     },
            user: "please enter your username",
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#login-form").serialize();
				
			$.ajax({
				
			type : 'POST',
			url  : './config/login_process.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
			},
			success :  function(response)
			   {						
					if(response=="ok"){
									
						$("#btn-login").html('<img class="load_img" src="./img/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
						setTimeout(' window.location.href = "./home.php"; ',4000);
					}
					else{
									
						$("#error").fadeIn(1000, function(){						
				$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
											$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
									});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});
     