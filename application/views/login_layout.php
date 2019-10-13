<!DOCTYPE html>
<html lang="en">
<head>
	<title>লগইন</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png')?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/bootstrap/css/bootstrap.min.css')?>">
<!--===============================================================================================-->
	<link href="<?php echo base_url('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.css');?>" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/animate/animate.css')?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/css-hamburgers/hamburgers.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/animsition/css/animsition.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/select2/select2.min.css')?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/vendor/daterangepicker/daterangepicker.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/css/util.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login/css/main.css')?>">
<!--===============================================================================================-->
	<link href="<?php echo base_url('assets/login/slider/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
<!--===============================================================================================-->
    <link href="<?php echo base_url('assets/login/slider/css/full-slider.css')?>" rel="stylesheet">
<!--===============================================================================================-->
    <link href="<?php echo base_url('custom/css/custom.css')?>" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('custom/css/custom.css')?>">
	

</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<?php echo form_open('login/user_check', ['class'=>'login100-form validate-form', 'id'=>'loginForm', 'autocomplete'=>'off']);?>
					<span class="login100-form-title p-b-43">
						স্বাগতম
					</span>

					<div id="message"></div>
					
					<div class="wrap-input100 validate-input" data-validate = "ইউজার নেম প্রবেশ করান">
						<input class="input100" type="text" name="username" id="username" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="label-input100">ইউজার নেম</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="পাসওয়ার্ড প্রবেশ করান">
						<input class="input100" type="password" name="password" id="password" autocomplete="off">
						<span class="focus-input100"></span>
						<span class="label-input100">পাসওয়ার্ড</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div>
							<a href="<?php echo base_url('forgetpassword'); ?>" class="txt1">
								পাসওয়ার্ড ভুলে গেছেন ?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							প্রবেশ করুন
						</button>
					</div>
					

			<div class="footer text-center m-t-45">
				<div>
					<p>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2018
						<?php if(strtotime('2018') < strtotime(date('Y'))) echo ' - '.date('Y').' '; ?>
					</p>
					<p>All Rights Reserved</p>
				</div>
				<div>
					<p>Developed By : <b><a href="https://software.blinkpark.com" target="_blank">BlinkSoft</a></b></p>
				</div>
		  	</div>


				<?php echo form_close();?>

				<div class="login100-more">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				        <ol class="carousel-indicators">
				        	<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				        	<?php 
				        		$num = $this->model_login->img_num(); 
				        		for ($i=1; $i < $num; $i++) {
				        	?>
								<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"></li>
				          <?php } ?>
				        </ol>
				        <div class="carousel-inner" role="listbox">

				        	<?php
				        		$x = 0;
				        		$src = $this->model_login->img_src(); 
				        		foreach ($src as $key => $value) {
				        	?>
				          		<?php if($x == 0) {?>
						          	<div class="carousel-item active" style="background-image: url('<?php echo base_url($value['login_img_src']);?>')">
						          	</div>
					         	<?php } else { ?>
					          	<div class="carousel-item" style="background-image: url('<?php echo base_url($value['login_img_src']); ?>')">
					          	</div>
					          <?php } ?>
					        <?php $x++; 
					    		} 
					    	?>
				         
				        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				          <span class="sr-only">Previous</span>
				        </a>
				        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				          <span class="carousel-control-next-icon" aria-hidden="true"></span>
				          <span class="sr-only">Next</span>
				        </a>
				    </div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('assets/login/slider/vendor/jquery/jquery.min.js')?>"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('assets/login/slider/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/jquery/jquery-3.2.1.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/animsition/js/animsition.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/bootstrap/js/popper.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/select2/select2.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/daterangepicker/moment.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/daterangepicker/daterangepicker.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/vendor/countdowntime/countdowntime.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('assets/login/js/main.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url('custom/js/login.js')?>"></script>

</body>
</html>