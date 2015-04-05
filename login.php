<?php
if( isset($_POST['username']) && isset($_POST['password']) ){
/*
Login logic
 */
echo $_POST['username'].','.$_POST['password'];
}

include('header.php');
?>

<div id="main">
	<div id="login-box">
		<form action="" method="post">
			<input type="text" name="username" placeholder="Enter your username">
			<input type="password" name="password" placeholder="Enter your password">
			<input type="submit" name="submit" value="Login">
		</form>
	</div>
</div>

<?php 
include('footer.php');
?>