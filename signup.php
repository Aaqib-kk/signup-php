<?php session_start();
include_once 'objects/login.php';
$login = new Login();
$CountryDetails = $login->fetchCountryDetails();	
if(isset($_COOKIE["username"])){
	$login = new Login();
    // echo "Auction Item is a  " . $_COOKIE["username"];
	$loginResult = $login->login_COOKIE($_COOKIE["username"]);	
	// print_r($loginResult);
	if(!empty($loginResult["username"]) && $loginResult['status']='success'){		
		header("Location: home.php");
	} else {
		
		$cookie_name = "username";
        $cookie_value ="";
        setcookie($cookie_name, $cookie_value, time()+0);
        
        session_start();
        unset($_SESSION["cust_logged_in"]);
	}
}
if(!empty($_POST["login-btn"])) {
	 
	include_once 'objects/login.php';
	$login = new Login();
	$loginResult = $login->login();	
	if(!empty($_SESSION["cust_logged_in"]) && $loginResult['status']='success'){		
		header("Location: home.php");
	}	
}
if(isset($_POST["signup-btn"])) {
	include_once 'objects/user.php';
	$user = new User();
	$registrationResponse = $user->create();
	/*!empty($registrationResponse) && $registrationResponse['status']=='success' && */
	
	/*if($registrationResponse['optstatus']=='success' ){

		header("Location: verify-mobile-otp.php?mobile_no=".$registrationResponse['mobile_no']."");
	}*/
	
}

$referral_id ='';

if(isset($_GET['referral_id'])){

	 //echo"---referral_id--11---".$_GET['referral_id']."<br>";
	if (isset($_COOKIE['referral_id'])) {

		// echo"---referral_id--22---".$_COOKIE['referral_id']."<br>";

		$referral_id = $_COOKIE['referral_id'];

	} else {

		//echo"---referral_id--33---".$_GET["referral_id"]."<br>";

		$refcode=$_GET["referral_id"];
	    // set cookie, local $uname already set
		$_COOKIE["referral_id"]=$refcode;
	   //	echo"---referral_id--33-1--".$_COOKIE["referral_id"]."<br>";
    	//setcookie( 'referral_id', $refcode, time() +2592000, '/', 'http://localhost/pokergame/index.php' );
		setcookie('referral_id', $refcode, time()+30*24*60*60);
	}

	$referral_id =$_COOKIE["referral_id"];

	//echo"---referral_id--44---".$referral_id."<br>";

} else if(isset($_COOKIE['referral_id'])){ 

	$referral_id =$_COOKIE["referral_id"];
    //echo"---referral_id--55---".$referral_id."<br>";

}else{

	$referral_id =''; 
  // echo"---referral_id--66---".$referral_id."<br>";
}
 //echo"---referral_id---77--".$referral_id."<br>";
 //die;
include_once 'header.php';
?>
    <head>
    <title>Tucheze Kadi</title>
    </head>
<body>


	<!-- start header -->

	<header id="header" class="header-home login-header-mob" >
		<div class="container">    

		

			</div>
		</header>
		<!-- #header -->



		<section class="login-page-bg">

			<div class="login-page-space">

			</div>

			<div class="container">
				<div class="row " style="margin-bottom:-30px;">
					<?php
					if(!empty($_GET['resetmessage'])){?>
					
					
					
						<div class="col-sm-6 error-msg text-white text-center"><?php echo $_GET['resetmessage'];?>
						</div>
					
						
					<?php } ?>
				</div>
				<div class="row " style="margin-top: 5%; margin-bottom: 5%;">

					<div class="col-sm-6" style="padding-right: 25px;"> 
						

						<div class="logo-bg"> 
							<div class="text-center">
								<img src="./images/k-logo.png" class="img-fluid logo-poker" alt="">
							</div>
							<p class="img-fluid text-center"></p>
							<h6 class="logo-text text-center">Cheza kadi online</h6>
								<!--<p  class="img-fluid  text-line" > </p>-->
						</div>
					</div>
					<?php if(!isset($_SESSION["cust_logged_in"]["username"])){ ?> 
						<div class="col-sm-6 mt-3" style="padding-right: 25px;">
							 <div class="card tab-card register-bg">
							  
								 <!--<div class="card-header tab-card-header">
									  <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="btn register-btn" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Login</a>
										</li>
										<li class="nav-item ml-5">
											<a class="btn register-btn" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Registration</a>
										</li>
										
									  </ul>
								</div>
								
								<?php
								if (! empty($registrationResponse["status"])) {
									?>
									<?php
									if ($registrationResponse["status"] == "error") {
										?>
										<div class="server-response error-msg text-danger"><?php echo $registrationResponse["message"]; ?></div>
										<?php
									} else if ($registrationResponse["status"] == "success") {
										?>
										<div class="server-response success-msg text-success"><?php echo $registrationResponse["message"]; ?></div>
										<?php
									}
									?>
									<?php
								}
								?>
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show" id="one" role="tabpanel" aria-labelledby="one-tab">					
											
												<form name="login" action="" method="post" onsubmit="return loginValidation()"> 			  
													<?php
													if(!empty($loginResult)){?>
														<div class="error-msg text-danger"><?php echo $loginResult["message"];?></div>
													<?php } ?>




													<div class="form-group boxinput">
														<span class="required error" id="login-username-info"></span>
														<input type="text" class="form-control box-user" name="login-username" id="login-username" placeholder="username or phone number">
													</div>
													<div class="form-group boxinput">

														<span class="required error" id="login-password-info"></span>
														<input type="password" class="form-control box-user" name="login-password" id="login-password" placeholder="password">
														<a href="forgot-password.php"><small class="forgot-password ">forgot password ?</small></a>
													</div>
													<div class=" text-center" >
														<input class="login-bg" type="submit" name="login-btn" id="login-btn" value="Login">
													</div>
										
												</form>
											
												
									</div>
									<div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
										<form name="sign-up" action="" method="post" onsubmit="return signupValidation()">			  
											

											<div class="form-group">
												<span class="required error" id="sign-up-username-info"></span>
												<input type="test" class="form-control box-user" name="sign-up-username" id="sign-up-username" placeholder="Username">
											</div>
											<div class="form-group">
												<span class="required error" id="mobile-info"></span>
												<input type="text" class="form-control box-user"  name="mobile" id="mobile" onkeyup="this.value=this.value.replace(/\D/g,'')" maxlength="10" placeholder="Phone Number">
												<small class="should-be-text ">*Should be the same number you will use for mobile money</small>
											</div>
											<div class="form-group">
												<span class="required error" id="signup-password-info"></span>
												<input type="password" class="form-control box-user" name="signup-password" id="signup-password" placeholder="Password">
											</div>
											<?php if($referral_id != "" && $referral_id > 0 && $referral_id != NULL) { ?>
												<div class="form-group">
													<span class="required error" id="signup-referral_id-info"></span>
													<input type="text" class="form-control box-user" value="<?php echo $referral_id;?>" readonly name="signup-referral-id" id="signup-referral-id" placeholder="Referral">
												</div>
											<?php } ?>
											<div class=" text-center" >
												<input class="btn register-btn" type="submit" name="signup-btn" id="signup-btn" value="REGISTER FOR FREE">
												
											</div>
										</form>              
								  </div>

								</div>-->
								
								
								<div class="row">
									<div class="col-sm-12 text-center">
										<button onclick="RegisFun()" class="btn btn-primary1" style=" color: #fff; background-color:#f94707; font-weight: 700; border-radius: 10px;">Register</button> &nbsp;&nbsp;&nbsp;&nbsp;
										<button onclick="LoginFun()" class="btn btn-primary1" style=" color: black; background-color:#A3A3A3; font-weight: 700; border-radius: 10px;">Login</button>
									</div>
									
								</div>
								<br>
								<?php
								if(!empty($loginResult)){?>
									<div class="error-msg text-danger"><?php echo $loginResult["message"];?></div>
								<?php } ?>
								<?php
								if (! empty($registrationResponse["status"])) {
									?>
									<?php
									if ($registrationResponse["status"] == "error") {
										?>
										<div class="server-response error-msg text-danger"><?php echo $registrationResponse["message"]; ?></div>
										<?php
									} else if ($registrationResponse["status"] == "success") {
										?>
										<div class="server-response success-msg text-success"><?php echo $registrationResponse["message"]; ?></div>
										<?php
									}
									?>
									<?php
								}
								?>
								<div id="loginWindow">
									
										<form name="login" action="" method="post" onsubmit="return loginValidation()"> 			  
											<?php
											if(!empty($loginResult)){?>
												<div class="error-msg text-danger"><?php echo $loginResult["message"];?></div>
											<?php } ?>




											<div class="form-group">
												<span class="required error" id="login-username-info"></span>
												<input type="text" class="form-control box-user" name="login-username" id="login-username" placeholder="username or phone number">
											</div>
											<div class="form-group">

												<span class="required error" id="login-password-info"></span>
												<input type="password" class="form-control box-user" name="login-password" id="login-password" placeholder="password">
												<a href="forgot-password.php"><small class="forgot-password ">forgot password ?</small></a>
											</div>
											<div class=" text-center" >
												<input class="btn btn-primary1" type="submit" name="login-btn" id="login-btn" value="Login" style="width: 100px; color: #fff; background-color: rgb(249 71 7); border-color: rgb(249 71 7); font-weight: 700;border-radius: 12px;">
											</div>
								
										</form>
								</div>
								<div id="registerWindow" style="display:none">
									
										<form name="sign-up" action="" method="post" onsubmit="return signupValidation()">			  
											

											<div class="form-group">
												<span class="required error" id="sign-up-username-info"></span>
												<input type="test" class="form-control box-user" name="sign-up-username" id="sign-up-username" placeholder="Username" style="text-transform:lowercase">
											</div>
											
											
											
											
											
											<div class="row form-group">
											
												<div class="col-sm-5">
													<select id="phone_code" name="phone_code" class="form-control box-user" required>																	
														<?php if($CountryDetails) {
															foreach($CountryDetails as $country) {
																
																if($country['phone_code']=='254'){
																	?>
																	<option value="<?php echo $country['phone_code']; ?>" style="color:#000" selected><?php echo ' (+'.$country['phone_code'].') '.$country['country_name']; ?></option>
																	
																	<?php 
																} else {
																	?>
																	<option value="<?php echo $country['phone_code']; ?>" style="color:#000"><?php echo ' (+'.$country['phone_code'].') '.$country['country_name']; ?></option>
																	
																	<?php 
																}
																	
																	
															}
														} ?>
													</select>
												</div>
												<div class="col-sm-7">	
													<div class="form-group">														
														<span class="required error" id="mobile-info"></span>
														<input type="text" class="form-control box-user"  name="mobile" id="mobile" onkeyup="this.value=this.value.replace(/\D/g,'')" maxlength="12" placeholder="Phone Number">
														
													
													</div>
													
												</div>
											</div>
											
											<div class="form-group">
												<span class="required error" id="signup-password-info"></span>
												<input type="password" class="form-control box-user" name="signup-password" id="signup-password" placeholder="Password">
											</div>
											<?php if($referral_id != "" && $referral_id > 0 && $referral_id != NULL) { ?>
												<div class="form-group">
													<span class="required error" id="signup-referral_id-info"></span>
													<input type="text" class="form-control box-user" value="<?php echo $referral_id;?>" readonly name="signup-referral-id" id="signup-referral-id" placeholder="Referral">
												</div>
											<?php } ?>
											<div class=" text-center" >
												<input class="btn btn-primary1" type="submit" name="signup-btn" id="signup-btn" value="Finish Registration" style="width: 230px; color: #fff; background-color: rgb(249 71 7); border-color: rgb(249 71 7); font-weight: 700;border-radius: 12px;font-size: 20px;">
												
											</div>
										</form>
								</div>
								
							  </div> 
						</div>
						<script>
							document.getElementById("loginWindow").style.display='none';
							document.getElementById("registerWindow").style.display='none';
							function LoginFun() {
								
								var x = document.getElementById("loginWindow");
								  if (x.style.display === "none") {
									x.style.display = "block";
								  } else {
									x.style.display = "none";
								  }
								  
								  var x = document.getElementById("registerWindow");
								  x.style.display = "none";
								  
								// document.getElementById("loginWindow").style.display='block';
							   var element = document.getElementById("loginWindow");
							   // element.classList.toggle("mystyle");
							}
							function RegisFun() {
								
								var x = document.getElementById("registerWindow");
								  if (x.style.display === "none") {
									x.style.display = "block";
								  } else {
									x.style.display = "none";
								  }
								  
								  var x = document.getElementById("loginWindow");
								  x.style.display = "none";
								  
								// document.getElementById("loginWindow").style.display='block';
							   var element = document.getElementById("registerWindow");
							   // element.classList.toggle("mystyle");
							}
						</script>
					<?php } else {  ?> 
						<div class="col-sm-6">
							<div class="logo-bg"> 
								<div class="text-center">
									<a href="my-account.php" class="btn btn-primary" style="width: 125px;">My Account</a>
								</div>
							</div>
						</div>
					
					<?php }?> 	

					<div class="col-sm-1">

					</div>

				</div>
				
			


<!--<style>
.profile img {
    width: 68px;
    height: 68px;
    border-radius: 50%
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
</style>-->
			
	


			</div>
			        <!-- start footer -->
		<?php include_once 'footer-index.php'; ?>
		<!-- end footer -->
		</section>





<div class="overlay"></div>

<!-- bs4 js link -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
<script src="./js/main-index.js" ></script>

<style>
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
         background: rgba(255 255 255 / 10%) url("images/loader1.gif") center no-repeat;
    }
    body{
        text-align: center;
    }
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;   
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }
</style>

<!--<script src="./js/main.js"></script>-->
<script>
$('#mobile').keyup(function(e){
      if($(this).val().match(/^0/)){
          $(this).val('');
          return false;
      }
});
$('#mobile').keyup(function(e){
      if($(this).val().match(/^254/)){
          $(this).val('');
          return false;
      }
});

$("input#sign-up-username").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});
$("input#login-username").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});

	$("#login-div-info").html("").hide();
	function loginValidation() {
		var valid = true;
		$("#login-username").removeClass("error-field");
		$("#password").removeClass("error-field");

		var UserName = $("#login-username").val();
		var Password = $('#login-password').val();

		$("#login-username-info").html("").hide();

		if (UserName.trim() == "") {
			$("#login-username-info").html("required.").css("color", "#ee0000").show();
			$("#login-username").addClass("error-field");
			valid = false;
		}
		if (Password.trim() == "") {
			$("#login-password-info").html("required.").css("color", "#ee0000").show();
			$("#login-password").addClass("error-field");
			valid = false;
		}
		if (valid == false) {
			$('.error-field').first().focus();
			valid = false;
		}
		return valid;
	}

	function signupValidation() {
		var valid = true;

		$("#sign-up-username").removeClass("error-field");
		$("#mobile").removeClass("error-field");
		$("#password").removeClass("error-field");

		var UserName = $("#sign-up-username").val();
		var mobile = $("#mobile").val();
		
		var Password = $('#signup-password').val();

		$("#sign-up-username-info").html("").hide();
		if (UserName.trim() == "") {
			$("#sign-up-username-info").html("required.").css("color", "#ee0000").show();
			$("#sign-up-username").addClass("error-field");
			valid = false;
		}
		if (mobile.trim() == "") {
			$("#mobile-info").html("required.").css("color", "#ee0000").show();
			$("#mobile").addClass("error-field");
			valid = false;
		}
		if (Password.trim() == "") {
			$("#signup-password-info").html("required.").css("color", "#ee0000").show();
			$("#signup-password").addClass("error-field");
			valid = false;
		}
		if (valid == false) {
			$('.error-field').first().focus();
			valid = false;
		}
		if (valid == true) {
			$("body").addClass("loading"); 
		}
		return valid;
	}
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-6XDXBD082F"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', 'G-6XDXBD082F');
        </script>
        
        
        
        
</body>
</html>