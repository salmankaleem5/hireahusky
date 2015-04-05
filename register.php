<?php 
include('header.php');
?>

<div id="main">
	<div id="register-box">
		<form action="" method="post">
			<label>Username:<input type="text" name="username" placeholder="Enter your username"></label>
			<label>Password:<input type="password" name="password" placeholder="Enter your password"></label>

			<div id="register-personal-info">
				<p id="name">
					<label>First name:<input type="text" name="fname"></label>
					<label>Last name:<input type="text" name="lname"></label>
				</p>
				<p id="address">
					<label>Street 1:<input type="text" name="street1"></label>
					<label>City:<input type="text" name="city"></label>
					<label>State:<select name="state">
						<option value="0">Select a state</option>
					</select></label>
					<label>Zipcode:<input type="text" name="zipcode"></label>
				</p>
				<p id="contact">
					<label>E-mail:<input type="address" name="email"></label>
					<label>Phone number:<input type="text" name="phone"></label>
					<label>Fax number:<input type="text" name="fax"></label>
					<label>Cellphone number:<input type="text" name="cellphone"></label>
					<label>Website:<input type="url" name="website"></label>
				</p>
			</div>

			<input type="submit" name="submit" value="Register">
		</form>
	</div>
</div>

<?php 
include('footer.php');
?>