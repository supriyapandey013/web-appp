<!DOCTYPE html>
<?php
if($_POST['submit']==1){
    $db = getDatabase();
	$username=addslashes($_POST['username']);
	$sql="select id FROM users WHERE username='$username'";
	$res=$db->executeQuery($sql);
    $row1=$db->fetchArray($res); 
	IF($row1['id']>0){
		$password=$_POST['password'];
			$sql="select id FROM users WHERE username='$username' and password='$password'";
			$result=$db->executeQuery($sql);
			$row=$db->fetchArray($result);
		if($row['id']>0){   
			$_SESSION['ID']=$row['id'];
			?> <script> window.location.href='homepage'; </script> <?php
		}else{ 
			$xxx=1;
		} 
	}ELSE{ 
		$xxx=2;
	}		
}
?>
<html lang="en">

<?php	include($css_path); ?>

<body class="skin-default card-no-border bakkg">
    <section id="wrapper">
	 <?php	include($menu_path); ?>
	   <div class="new-wrappers-login-design">
           
        <div class="login-register" >
            

            <div class="login-box card" >
                   <div class="card-body">
                    <form class="form-horizontal form-material"  class="form-signin"   name="login-form" id="login-form" method="post">
                       
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="input-with-icon">
                                    <div class="img-logo">
                                      <i class="icon-user"></i>
                                    </div>
                                    <input class="form-control" type="text" required="" name="username" placeholder="Username"  id="username">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                 <div class="input-with-icon">
                                <div class="img-logo">
                                    <i class="icon-lock"></i>
                                </div>
                                <input class="form-control" type="password" required="" name="password" placeholder="Password" id="password"> </div>
                            </div>
                        </div>
       
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                             <input type="hidden" value="insert" name="action" id="action">
                                <input type="hidden" value="login" name="page">
                                <button class="logins-btn-new" type="submit" name="submit" id="submit" value="1"><span>LOGIN</span></button>
                            </div>

                         
                        </div>
                       
                    </form>
                   
                </div>
            </div>
        </div>
       </div>
    </section>
    
<?php	include($footer_path); ?>
    <?php	include($js_path); ?>

 <?php 
	include($js_path);
	?>
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
	    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script>


$.validator.addMethod("regx", function(value, element, regexpr) {          
return regexpr.test(value);
}, "Letters only");

(function($,W,D)
{

    var JQUERY4U = {};
 
    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#login-form").validate({
                rules: {
                    username: {
                                required: true,
                              },
                    password: {
                              required: true
                              } 
                },
                messages: {
                    username: {
                                  required:"<font color='red'>Please enter Username</font>",
                              },
                   password: {
                                  required: "<font color='red'>Please Enter password</font>"
                             } 
                },
                  submitHandler: function(form) {
					  form.submit();
				  }
            });
            
        }
    }
 
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
        

    });
 
})(jQuery, window, document);
</script>

    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
	
	
   <script>
        $('.dropify').dropify();
    </script> 
	<?php if($xxx==1){ ?>
			<script> 
			Swal.fire({
					 text:"Invalid Password",
					type: 'error',
					showConfirmButton: false,
					timer: 2500
			}).then((result) => {});
			</script>	
	<?php }elseif($xxx==2){ ?>
		<script> 
		Swal.fire({
                 text:"Invalid Username",
                type: 'error',
				showConfirmButton: false,
                timer: 2500
        }).then((result) => {});
		</script>	
	<?php } ?>
</body>
</html>