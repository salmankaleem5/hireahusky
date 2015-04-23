<?php
include('header.php');
include('userfns.php');
include('acctupdt.php');
?>

<html lang = "en">
	<head>
	
		<title>Welcome User!</title>
		<link rel="stylesheet" href="../css/welcome.css" type="text/css" />

		<!-- function to change between summary tabs -->
		<script type="text/javascript">
			$(document).ready(function(){
				displayHeader("../",3);
				displayFooter("../");
			});
			function changeTab(divID, menuID){
				$("#welcome-menu li").removeClass("active");
				$("#" + menuID).addClass("active");
				$(".menuItem.active").slideUp("fast", function(){
					$("#" + divID).slideDown("fast");
					$(this).removeClass("active");
					$("#" + divID).addClass("active");
				});
				return false;
			}
		</script>
		
		
	</head>
<div id="main" class="row">
	<div class="page-wrapper">
		<div class="content-wrapper">
			<div id="page-header" class="row-fluid">
				<div class="span12 hero-unit black">
					<h1>Welcome [insert user name here]</h1>
				</div>
			</div>
			
			<div class="content-padded">
				<div class="row-fluid">
					<div class="span2">
						<div class="sidebar-nav">
							<ul id="welcome-menu" class="nav nav-list">
								<li id="menu1" class="active"><a href="#" onClick="return changeTab('Account','menu1');">Account Info</a></li>
								<li id="menu2"><a href="#" onClick="return changeTab('Jobs','menu2');">Jobs</a></li>
								<li id="menu2"><a href="#" onClick="return changeTab('Resume','menu2');">Resume</a></li>

								<!-- add more list items like the one above -->

							</ul>
						</div>
					</div>

					<div id="Account" class="span10 menuItem active">
						<h2>My Account Information:</h2>
						<?PHP updateInfo();?>
					</div>
					
					
					<div id="Jobs" style="display: none;" class="span9 menuItem">
						<h2>Jobs I've Applied to:</h2>
						<?PHP myjobs();?>
					</div>
					
					<div id="Resume" style="display: none;" class="span9 menuItem">
						<h2>Uploaded Resumes:</h2>
						<?PHP myresume();?>
					</div>
					
					<!-- add more divs like the one above -->
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>