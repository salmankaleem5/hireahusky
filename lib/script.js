$(document).ready(function(){
	$("input[name='isPoster']").change(function(){
		if( this.checked ){
			$("#signupPosterOptions").show();
		} else {
			$("#signupPosterOptions").hide();
		}
	});
});