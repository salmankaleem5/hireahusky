<?php
include('header.php');
$flash = $this->data['flash'];
if( isset($flash['errorMsg']) ){
	echo $flash['errorMsg'];
}
?>

<div class="jumbotron">
  <h1>Hire a Husky</h1>

  <form id="welcomeSearch" action="/hireahusky/search" class="form-inline">
  	<div class="form-group" style="position: relative;
			margin-left: 0px; margin-right: 18px; margin-bottom: 0px; margin-top: 0px;
			padding: 1px;
			height: 100%;
			width: 400px;
			background-color: #EAE6D4;
			float: left;">
  		<input type="text" name="jobTitle" class="form-control" placeholder="Enter a job title">
  	</div>
  	<div class="form-group" style="position: relative;
			margin: 0;
			padding: 1px;
			height: 100%;
			width: 200px;
			background-color: #EAE6D4;
			float: left;">
  		<input type="text" name="jobLocation" class="form-control" placeholder="Enter a job location">
  	</div>
  	<button type="submit" class="btn btn-default">Search</button>
  </form>
</div>

<?php
include('footer.php');
?>