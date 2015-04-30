<?php
include('header.php'); 
$reportUrl = $this->data['baseUrl'].'/account/admin_reports';
?>

<div class="row">

<?php
if( ($reportData = $this->data['reportData']) == null ){
	?>
	<p><a href="<?php echo $reportUrl.'?reportType=summary' ?>">Summary of seekers</a></p>
	<form>
		<div class="form-group">
			<p>Seekers with last name:</p>
			<input type="text" name="lname" placeholder="Enter a last name">
			<button class="seeker" id="input[name='lname']">Go</button>
		</div>
		<div class="form-group">
			<p>Jobs in company:</p>
			<input type="text" name="cname" placeholder="Enter a company name">
			<button class="company" id="input[name='cname']">Go</button>
		</div>
	
		<div class="form-group">
			<p>Jobs posted in date range:</p>
			<input type="text" name="start" placeholder="Enter a start date">
			<input type="text" name="end" placeholder="Enter an end date">
			<button class="date" id="input[name='start'],input[name='end']">Go</button>
		</div>
	
		<div class="form-group">
			<p>Jobs with salary and job title:</p>
			<input type="text" name="salary" placeholder="Enter a salary">
			<input type="text" name="jobtitle" placeholder="Enter a job title">
			<button class="jobSal" id="input[name='salary'],input[name='jobtitle']">Go</button>
		</div>
	
		<div class="form-group">
			<p>List job seekers associated with job id:</p>
			<input type="text" name="jobid" placeholder="Enter a job id">
			<button class="jobSeekers" id="input[name='jobid']">Go</button>
		</div>

		<div class="form-group">
			<p>Payments between date range:</p>
			<input type="text" name="pstart" placeholder="Enter a start date">
			<input type="text" name="pend" placeholder="Enter an end date">
			<button class="payment" id="input[name='pstart'],input[name='pend']">Go</button>
		</div>
	
		<div class="form-group">
			<p>Seekers with bachelor's degrees from:</p>
			<input type="text" name="university" placeholder="Enter a university name">
			<button class="uniSeekers" id="input[name='university']">Go</button>
		</div>
	
		<div class="form-group">
			<p>Find all jobs requiring at least one of the following skills:</p>
			<input type="text" name="skills" placeholder="Enter skills, comma separated">
			<button class="jobWithSkills" id="input[name='skills']">Go</button>
		</div>
	
		<div class="form-group">
			<p>Seekers with all of the following skills:</p>
			<input type="text" name="skills" placeholder="Enter skills, comma separated">
			<button class="seekersWithSkills" id="input[name='skills']">Go</button>
		</div>
	</form>
	<?php
} else {
	$out = "<table class='table'>";
	$out .= "<thead><tr>";
	$fields = array_keys($reportData[0]);
	foreach( $fields as $k=>$field ){
		$out .= "<th>".$field."</th>";
	}
	$out .= "</tr></thead>";
	$out .= "<tbody>";
	foreach( $reportData as $row => $result ){
		$out .= "<tr>";
		foreach( $result as $k=>$v ){
			$out .= "<td>".$v."</td>";
		}
		$out .= "</tr>";
	}
	$out .= "</tbody>";
	$out .= "</table>";

	echo $out;
}
?>

</div>

<?php include('footer.php'); ?>