<?php
if( isset($_POST['username']) && isset($_POST['password']) ){
/*
Login logic
 */
echo $_POST['username'].','.$_POST['password'];
}

include('header.php');
?>

<div id="main" class="row">
	<div id="login-box" class="col-md-6 col-md-offset-3">
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="Enter your username">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Enter your password">
			</div>
			<button type="submit" class="btn btn-default">Submit <a href="welcome"> </button>
		</form>
	</div>
</div>

<?php 
include('footer.php');
?>