<?php
include('header.php');
$flash = $this->data['flash'];
if( isset($flash['signup']) ){
	echo $flash['signup'];
}
?>

<div id="main" class="row">
	<div id="login-box" class="col-md-6 col-md-offset-3">
		<h2>Join today</h2>
		<form action="<?php echo $this->data['baseUrl'].'/signup'; ?>" method="POST">
			<div class="form-group">
				<input type="address" name="email" class="form-control" placeholder="Enter your email address">
			</div>
			<div class="form-group">
				<input type="text" name="fname" class="form-control" placeholder="Enter your first name">
			</div>
			<div class="form-group">
				<input type="text" name="lname" class="form-control" placeholder="Enter your last name">
			</div>
			<div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="Enter your username">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Enter your password">
			</div>
			<div class="checkbox">
				<label><input type="checkbox" name="isPoster" value="true">Check if you are a job poster</label>
			</div>
			<div id="signupPosterOptions" class="form-group" style="display:none">
				<p><input type="text" name="cname" class="form-control" placeholder="Enter your company name"></p>
				<p><input type="text" name="cposition" class="form-control" placeholder="Enter your company position"></p>
			</div>
			<p><input id="signup_button" type="submit" class="btn btn-primary btn-lg btn-block" value="Sign up"></p>
			<p>Forgot your password?</p>
		</form>
	</div>
</div>

<?php 
include('footer.php');
?>