<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
	body {
		color: #73879C;
		background: #FFF;
		font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
		font-size: 13px;
		font-weight: 400;
		line-height: 1.471;
	}
</style>

<body class="login">    
	<div class="container">
		<div class="row">
			<?php if (validation_errors()) : ?>
				<div class="col-md-12">
					<div class="alert alert-danger" role="alert">
						<?= validation_errors() ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if (isset($error)) : ?>
				<div class="col-md-12">
					<div class="alert alert-danger" role="alert">
						<?= $error ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="login_wrapper">
				<div class="animate form login_form">
				<section class="login_content">
					<?php echo form_open('user/login'); ?>
					<h1>ระบบตรวจออนไลน์</h1>
					<div>
						<input id="username" name="username" type="text" class="form-control" placeholder="Username" required="" />
					</div>
					<div>
						<input id="password" name="password"  type="password" class="form-control" placeholder="Password" required="" />
					</div>
					<div>
						<!-- <a class="btn btn-default submit" >Log in</a> -->
						<button class="btn btn-primary" type="submit" id="login">Log in</button>
						<!-- <a class="reset_pass" href="#">Lost your password?</a> -->
					</div>

					<div class="clearfix"></div>

					<div class="separator">

						<!-- <a href="#signup" class="to_register"> Create Account </a> -->

						<div class="clearfix"></div>
						<br />

						<div>
						<!-- <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1> -->
						<p>© Office of Higher Education Commission</p>
						</div>
					</div>
					<?php echo form_close(); ?>
				</section>
				</div>
			</div>
		</div><!-- .row -->
	</div><!-- .container -->
</body>