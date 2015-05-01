<?php
include('header.php');
include('userfns.php');
include('user_update.php');
?>
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
<div id="main" class="row">
	<div class="page-wrapper">
		<div class="content-wrapper">
			<div id="page-header" class="row-fluid">
				<div class="span12 hero-unit black">
					<?PHP 
						//$uname = 'bfry';
						$uname = $_SESSION['user'];//doesn't work for some reason
						echo "<h1>Welcome, $uname! [POSTER]</h1>";
					?>
					
				</div>
			</div>
			
			<div class="content-padded">
				<div class="row-fluid">
					<div class="span2">
						<div class="sidebar-nav">
							<ul id="welcome-menu" class="nav nav-list">
								<li id="menu1" class="active"><a href="#" onClick="return changeTab('Account','menu1');">Account Info</a></li>
								<li id="menu2"><a href="#" onClick="return changeTab('Posted','menu2');">Jobs I've Posted</a></li> 

								<!-- add more list items like the one above -->

							</ul>
						</div>
					</div>

					<div id="Account" class="span10 menuItem active">
						<h2>My Account Information:</h2>
						<?PHP 
						$uname = $_SESSION['user'];
						updateInfo($uname);
						?>
					</div>
					
					<div id="Posted" style="display: none;" class="span9 menuItem">
						<h2>Posted Jobs:</h2>
						<?PHP 
						$uname = $_SESSION['user'];
						myposts($uname);
						?>
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