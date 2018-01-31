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

		<div class="login_wrapper text-center">
			<!-- <div class="animate form login_form"> -->
			<!-- <section class="login_content"> -->
				<div class="page-header">
					<h1>สร้างบัญชีผู้ใช้</h1>
				</div>
				<?= form_open() ?>
					<div class="form-group">
						<!-- <label for="username">Name</label> -->
						<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
						<!-- <p class="help-block">At least 4 characters, letters or numbers only</p> -->
					</div>

					<div class="form-group">
						<!-- <label for="username">Surname</label> -->
						<input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" required>
						<!-- <p class="help-block">At least 4 characters, letters or numbers only</p> -->
					</div>

					<div class="form-group">
						<!-- <label for="username">Username</label> -->
						<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
						<p class="help-block">At least 4 characters, letters or numbers only</p>
					</div>
					<div class="form-group">
						<!-- <label for="email">Email</label> -->
						<input type="email" class="form-control" id="email" name="email" placeholder="Email">
						<p class="help-block">A valid email address</p>
					</div>
					<div class="form-group">
						<!-- <label for="password">Password</label> -->
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						<p class="help-block">At least 6 characters</p>
					</div>
					<div class="form-group">
						<!-- <label for="password_confirm">Confirm password</label> -->
						<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm password" required>
						<!-- <p class="help-block">Must match your password</p> -->
					</div>
					<div class="form-group">
						<div class="radio-inline">
							<label>
								<input type="radio" class="flat" name="role[]" id="role" value="Administrator" > Administrator
								<input type="radio" class="flat" name="role[]" id="role" value="Committee" > Committee
								<input type="radio" class="flat" name="role[]" id="role" value="NOC" > NOC
							</label>
						</div>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-default" value="Register">
					</div>
				</form>
				<!-- </section> -->
			</div>
		</div>


	</div><!-- .row -->
</div><!-- .container -->