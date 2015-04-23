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
  	<div class="form-group">
  		<input type="text" name="jobTitle" class="form-control" placeholder="Enter a job title">
  	</div>
  	<div class="form-group">
  		<input type="text" name="jobLocation" class="form-control" placeholder="Enter a job location">
  	</div>
  	<button type="submit" class="btn btn-default">Search</button>
  </form>
</div>

<?php
include('footer.php');
?>