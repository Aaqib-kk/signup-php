<?php
session_start();
//error_reporting(0);
include_once 'objects/user.php';
	 include_once 'objects/login.php';
	 include_once 'objects/user.php';
	 include_once 'objects/transaction.php';
	 include_once 'objects/commission.php';
	 include_once 'objects/sendMail.php';
	 include_once 'header.php'; 
	$login = new Login();
	$CountryDetails = $login->fetchCountryDetails();
/* if (! empty($_POST["forgot-password-btn"])) {
		
		$login = new Login();
		$forgotPasswordResponse = $login->forgotPassword();
} */
if (! empty($_POST["forgot-password-btn"])) {
		
		$login = new Login();
		$forgotPasswordResponse = $login->sendforgotPasswordOTP();
}
if (isset($_POST["verify-otp"])) {
	
		$login = new Login();
		$verfyOTPDetails = $login->verifyPasswordOTP();
		//var_dump($verfyOTPDetails);
		//die; 
		/* if ($verfyOTPDetails["message"] && $verfyOTPDetails["status"] == "success") {

			// $url = "my-account.php?status=".$verfyOTPDetails["status"]."&message=".$verfyOTPDetails["message"]."" ;
			$url = "reset-code.php?reset-code=".$verfyOTPDetails["status"]."&message=".$verfyOTPDetails["message"]."" ;
			header("Location: $url");

		} */
	}
	
?>
    <head>
    <title>Forgot Password | Kadi Game</title>
    </head>
<body>
    


    <!-- start header -->
		<?php include_once 'main-menu.php'; ?>
		
  	<!-- #header -->



      <!-- start main section -->
	 

      
      <section class=" login-page-bg">
       
		<!-- ********* -->
		<div class="login-card-space"></div>
		<!-- ********** --> 
 
	    
		

 
    
    <section class="change-password">
        <div class="container">
           
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 ">
					<!--Form with header passwordValidation();-->
					<form name="change-password" action="" method="post" onsubmit="return passwordValidation();" style="border: 1px solid white;border-radius: 20px;">
						<?php
							if (! empty($forgotPasswordResponse["status"])) {
								?>
								<?php
								if ($forgotPasswordResponse["status"] == "error") {
									?>
									<div class="server-response error-msg text-warning"><?php echo $forgotPasswordResponse["message"]; ?></div>
									<?php
								} else if ($forgotPasswordResponse["status"] == "success") {
									?>
									<div class="server-response success-msg text-white"><?php echo $forgotPasswordResponse["message"]; ?></div>
									<?php
								}
								?>
								<?php
							}
						?>
						<?php if ($forgotPasswordResponse["status"] == "success") {	?>
							<div class="card" style="background-color: #222222;border-radius: 20px;">
								<div class="card-header ">
									<div class="bg-change-pass text-white text-center py-2">
										<h3><i class="fa fa-lock"></i> Verify Confirmation Code</h3>
									</div>
								</div>
								<div class="card-body">
									<div class="form-group">
										<span class="required error" id="mobile-info"></span>
										<div class="input-group">  
											<input type="hidden" name="mobile" id="mobile" class="form-control" value="<?php echo $forgotPasswordResponse['mobile_no']; ?>" placeholder="Enter mobile" readonly>
										</div>
									</div>
									<div class="form-group ">
										<span class="required error" id="otp-info"></span>
										<div class="input-group ">
											<input type="text" name="otp" id="otp" class="form-control"   placeholder="Please enter confirmation code" required="" >
											<!---onchange="return otpValidate();"--->
										</div>
									</div>
									<div id="timerDiv">Resend Confirmation Code in <span id="timer"></span></div>
									<div class="should-be-text text-right" id="Resend" style="display:none;">		
										<a href="#" onclick="return resend_otp();">
											<i class="fa fa-repeat" aria-hidden="true"></i>
											Re-send confirmation code
										</a>
									</div>
									<div id="Message_error_msg" class="server-response error-msg text-danger text-right" style="display: none">Message not Sent successfully</div>
				   						<div id="Message_success_msg" class="server-response success-msg text-success text-right" style="display: none">Message Sent successfully</div>
								</div>
								<div class="text-center">
									<input type="submit" value="Verify" name="verify-otp" id="verify-otp" class="btn send-btn-bg btn-block rounded-0 py-2" >
								</div>
							</div>
						<?php } else if($verfyOTPDetails["status"]){ ?> 
								<?php
									if (! empty($verfyOTPDetails["status"])) {
										?>
										<?php
										if ($verfyOTPDetails["status"] == "error") {
											?>
											<div class="server-response error-msg text-warning"><?php echo $forgotPasswordResponse["message"]; ?></div>
											<?php
										} else if ($verfyOTPDetails["status"] == "success") {
											?>
											<div class="server-response success-msg text-white"><?php echo $verfyOTPDetails["message"]; ?></div>
											<?php
										}
										?>
										<?php
									}
								?>
								
								<div class="card">
								<div class="card-header ">
									<div class="bg-change-pass text-white text-center py-2">
										<h3><i class="fa fa-lock"></i> Verify Confirmation Code</h3>
									</div>
								</div>
								<div class="card-body">
									<div class="form-group">
										<span class="required error" id="mobile-info"></span>
										<div class="input-group">  
											<input type="hidden" name="mobile" id="mobile" class="form-control" value="<?php echo $verfyOTPDetails['mobile_no']; ?>" placeholder="Enter mobile" readonly>
										</div>
									</div>
									<div class="form-group ">
										<span class="required error" id="otp-info"></span>
										<div class="input-group ">
											<input type="text" name="otp" id="otp" class="form-control"   placeholder="Please enter confirmation code" required="" >
											<!---onchange="return otpValidate();"--->
										</div>
									</div>
									<div id="timerDiv">Resend Confirmation Code in <span id="timer"></span></div>
									<div class="should-be-text text-right" id="Resend" style="display:none;">		
										<a href="#" onclick="return resend_otp();">
											<i class="fa fa-repeat" aria-hidden="true"></i>
											Re-send confirmation code
										</a>
									</div>
									<div id="Message_error_msg" class="server-response error-msg text-danger text-right" style="display: none">Message not Sent successfully</div>
				   						<div id="Message_success_msg" class="server-response success-msg text-success text-right" style="display: none">Message Sent successfully</div>
								</div>
								<div class="text-center">
									<input type="submit" value="Verify" name="verify-otp" id="verify-otp" class="btn send-btn-bg btn-block rounded-0 py-2" >
								</div>
							</div>
						
						<?php } else { ?>
						<div class="card" style="background-color: #222222;border-radius: 20px;">
							<div class="card-header ">
								<div class="bg-change-pass text-white text-center py-2">
									<h3 style="font-size: 20px;font-weight: 700;"><i class="fa fa-lock"></i> Forgot Password</h3>
								</div>
							</div>
							<div class="card-body ">
								<!--Body-->
								<!--<div class="form-group">
										<span class="required error" id="mobile-info"></span>
										<input type="text" class="form-control"  name="mobile" id="mobile" onkeyup="this.value=this.value.replace(/\D/g,'')" maxlength="10" placeholder="Phone Number">
								</div>
								-->
								
								<div class="row form-group">
											
												<div class="col-sm-5" style="margin-bottom: 10px;">
													<select id="phone_code" name="phone_code" class="form-control" required style="border-radius: 10px;">																	
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
													<div class="form-group input-group">														
														<span class="required error" id="mobile-info"></span>
														<input type="text" class="form-control" name="mobile" id="mobile" onkeyup="this.value=this.value.replace(/\D/g,'')" maxlength="10" placeholder="Enter phone number" style="border-radius: 10px;">
														<!--<small class="should-be-text ">*Should be the same number you will use for mobile money</small>-->
													</div>
												</div>
											</div>
								
								
								
								<div class="text-center">
									<input type="submit" value="Send Reset Code" name="forgot-password-btn" id="forgot-password-btn" class="btn send-btn-bg py-2" style="color:#ffffff;font-size: 20px;font-weight: 700;border-radius: 10px;">
								</div>
							</div>
						</div>
						<?php } ?>
					</form>
					<!--Form with header-->
				</div>
            </div>
        </div>
    </section>



   <!-- start footer -->
		<?php include_once 'footer.php'; ?>
    <!-- end footer -->
    <script>

		
		let timerOn = true;

		function timer(remaining) {
		  var m = Math.floor(remaining / 60);
		  var s = remaining % 60;
		  
		  m = m < 10 ? '0' + m : m;
		  s = s < 10 ? '0' + s : s;
		  document.getElementById('timer').innerHTML = m + ':' + s;
		  remaining -= 1;
		  
		  if(remaining >= 0 && timerOn) {
			setTimeout(function() {
				timer(remaining);
			}, 1000);
			return;
		  }

		  if(!timerOn) {
			// Do validate stuff here
			return;
		  }
		  
		  // Do timeout stuff here
		  // alert('Timeout for otp');
		  
		  
		  $("#Resend").show();
		  $("#timer").hide();
		  $("#timerDiv").hide();
		  
		  
		}

		timer(60);

			 
			function mobileValidation() {

				var valid = true;
				$("#mobile").removeClass("error-field");
				var mobile = $("#mobile").val();
				$("#mobile-info").html("").hide();				
				if (mobile.trim() == "") {
					$("#mobile-info").html("required.").css("color", "#ee0000").show();
					$("#mobile").addClass("error-field");
					valid = false;
				}
				if (valid == false) {
					$('.error-field').first().focus();
					valid = false;
				}
				return valid;
			}
			function otpValidate() {

				var valid = true;
				var mobile = $("#mobile").val();
				$("#mobile-info").html("").hide();
				var otp = $("#otp").val();
				var cd = $("#cd").val();
				$("#otp-info").html("").hide();


				if (mobile.trim() == "") {
					$("#mobile-info").html("required.").css("color", "#ee0000").show();
					$("#mobile").addClass("error-field");
					valid = false;
				} else if (otp.trim() == "") {
					$("#otp-info").html("required.").css("color", "#ee0000").show();
					$("#otp").addClass("error-field");
					valid = false;
						} else {
						
						$.ajax({

							method: "POST",
							url:"ajax_function.php",
							data: {
								action: "mobileotpValidate",
								mobile: mobile,                  
								otp: otp,                 
								cd: cd                 
							},
							cache: false,
							success: function(data){

								// console.log("-------data-----"+data);
								if(data==1){
									
								document.getElementById("verify-otp").style.display = "block";
								return true;
								} else {

									$("#otp-info").html("Enter valid OTP").css("color", "#ee0000").show();
									$("#otp").addClass("error-field");
									$("#otp").val("");

								document.getElementById("verify-otp").style.display = "none";
									valid = false;

								}						
							}
						});
					}
				
			}
			function resend_otp() {
				
				
				$("#timerDiv").show();
				$("#timer").show();
				$("#Resend").hide();
				timer(60);

				var valid = true;
				var mobile = $("#mobile").val();
				// var cd = $("#cd").val();
				$("#mobile-info").html("").hide();


				if (mobile.trim() == "") {
					$("#mobile-info").html("required.").css("color", "#ee0000").show();
					$("#mobile").addClass("error-field");
					valid = false;

				} else {
						
						$.ajax({

							method: "POST",
							url:"ajax_function.php",
							data: {
								action: "forgot_resend_otp",
								mobile: mobile         
							},
							cache: false,
							success: function(data){
								// console.log("-------data-----"+data);
								if(data==1){									
								document.getElementById("Message_success_msg").style.display = "block";								
								} else {
								document.getElementById("Message_error_msg").style.display = "block";
									

								}						
							}
						});
					}
			}
		</script>
    <script>
	
	function passwordValidation() {
		
		var valid = true;

		$("#mobile").removeClass("error-field");
		
		var email = $("#mobile").val();
		
		
		 $("#mobile-info").html("").hide();
		
		
				
		if (email.trim() == "") {
			$("#mobile-info").html("required.").css("color", "#ee0000").show();
			$("#mobile").addClass("error-field");
			valid = false;
		}
		if (valid == false) {
			$('.error-field').first().focus();
			valid = false;
		}
		return valid;
	}
	function otpValidate() {

				var valid = true;
				var mobile = $("#mobile").val();
				$("#mobile-info").html("").hide();
				var otp = $("#otp").val();
				$("#otp-info").html("").hide();


				if (mobile.trim() == "") {
					$("#mobile-info").html("required.").css("color", "#ee0000").show();
					$("#mobile").addClass("error-field");
					valid = false;
				} else if (otp.trim() == "") {
					$("#otp-info").html("required.").css("color", "#ee0000").show();
					$("#otp").addClass("error-field");
					valid = false;
						} else {
						
						$.ajax({

							method: "POST",
							url:"ajax_function.php",
							data: {
								action: "mobileotpValidate",
								mobile: mobile,                  
								otp: otp                 
							},
							cache: false,
							success: function(data){

								console.log("-------data-----"+data);
								if(data==1){
									
									document.getElementById("verify-otp").style.display = "block";
									return true;
									
								} else {

									$("#otp-info").html("Enter valid OTP").css("color", "#ee0000").show();
									$("#otp").addClass("error-field");
									$("#otp").val("");

									document.getElementById("verify-otp").style.display = "none";
									valid = false;

								}						
							}
						});
					}
				
			}
	</script>
</body>
</html>