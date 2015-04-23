<?php
include('header.php');
$flash = $this->data['flash'];
if( isset($flash['errorMsg']) ){
	echo $flash['errorMsg'];
}
?>

<div class="container">
<?php
echo $uname;
?>
</div>

<?php
include('footer.php');
?>