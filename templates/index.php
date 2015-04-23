<?php
include('header.php');
$flash = $this->data['flash'];
if( isset($flash['errorMsg']) ){
	echo $flash['errorMsg'];
}
?>

<div class="jumbotron">
  <h1>Hire a Husky</h1>
  <div id="search-box">
  	<input type="text" id="welcome_search_box" class="form-control" placeholder="Search to get started">
  </div>
  <br>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
</div>

<?php
include('footer.php');
?>