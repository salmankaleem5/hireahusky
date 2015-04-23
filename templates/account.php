<?php
include('header.php');
?>

<div class="container">
<a href="<?php echo $this->data['baseUrl'].'/account/myresume/'.$this->data['user']; ?>" id="myResume">View my resume</a>

<a data-toggle="modal" data-target="#updateProfileModal">Update my profile</a>
<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfile" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update profile</h4>
			</div>
			<div class="modal-body">
				<form>
					<input type="text" placeholder="Sample">				
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-primary">Save</button>
			<!--<button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>-->
			</div>
		</div>
	</div>
</div>

</div>

<?php
include('footer.php');
?>