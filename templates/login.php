<?php
include('header.php');
?>

<div id="main" class="row">
	<div id="login-box" class="col-md-6 col-md-offset-3">
		<h2>Sign in to get started</h2>
		<form action="<?php echo $this->data['baseUrl'].'/login' ?>" method="POST">
			<div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="Enter your username">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Enter your password">
			</div>
			<input type="hidden" name="login" value=""> <!--value will be 1 if logging in-->
			<p><input id="login_button" type="submit" class="btn btn-primary btn-lg btn-block" value="Sign in"></p>
			<p>Forgot your password? | Need to sign up?</p>
		</form>
	</div>
</div>

<?php 
include('footer.php');
?>