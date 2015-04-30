<?php
include('header.php'); 
$reportUrl = $this->data['baseUrl'].'/account/admin_reports';
?>

<div class="row">

<p><a href="<?php echo $reportUrl.'?reportType=summary'; ?>">Summary of all seekers</a></p>

</div>

<?php include('footer.php'); ?>