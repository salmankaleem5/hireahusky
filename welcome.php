<?php
include('header.php');
?>

<html lang = "en">
	<head>
	
	
		<title>Welcome User!</title>

		<!-- function to change between summary tabs -->
		<script type="text/javascript">
			$(document).ready(function(){
				displayHeader("../",3);
				displayFooter("../");
			});
			
			function changeTab(divID, menuID){
				$("#pacman-menu li").removeClass("active");
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

		<div class="row-fluid">

			<div id="Account" class="span10 menuItem active">
				<h2>My Account Information:</h2>
			</div>
			
			<div id="Jobs" style="display: none;" class="span9 menuItem">
				<h2>Jobs I've Applied to:</h2>
			</div>
		</div>

</div>

<?php
include('footer.php');
?>