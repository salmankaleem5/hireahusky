<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>HireAHusky</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
	<div class="container">
		<div class="row">
			<div class="navbar-header"><a class="navbar-brand" href="<?php echo $this->data['baseUrl']; ?>">Hire a Husky</a></div>

		    <div class="collapse navbar-collapse">
		      <ul class="nav navbar-nav">
		      	<li><a href="<?php echo $this->data['baseUrl'].'/account'; ?>">My Account</a></li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		      <?php
		      	if( isset($this->data['user']) && !is_null($this->data['user']) ){
		      		$navUserSessionUrl = $this->data['baseUrl'].'/logout';
		      		$text = "Logout";
		      	} else {
		      		$navUserSessionUrl = $this->data['baseUrl'].'/login';
		      		$text = "Login";
		      	}
		      ?>
		        <li><a href="<?php echo $navUserSessionUrl; ?>"><?php echo $text; ?></a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
	    </div>
	</div>
</nav>
<div class="container" role="main">