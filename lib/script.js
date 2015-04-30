$(document).ready(function(){
	if( window.location.pathname == '/hireahusky/signup' ){
		$("input[name='isPoster']").change(function(){
			if( this.checked ){
				$("#signupPosterOptions").show();
			} else {
				$("#signupPosterOptions").hide();
			}
		});
	}

	if( window.location.pathname == '/hireahusky/account/admin_reports' ){
		var reportUrl = "http://localhost/hireahusky/account/admin_reports";
		$('button').click(function(event){
			event.preventDefault();

			var reportType = $(this).attr('class');
			var inputs = this.id;

			var inputsArray = inputs.split(',');
			if( inputsArray.length > 1 ){
				var fieldName1 = $(inputsArray[0])[0].name;
				var fieldName2 = $(inputsArray[1])[0].name;
				
				var fieldValue1 = $(inputsArray[0]).val();
				var fieldValue2 = $(inputsArray[1]).val();

				var url = reportUrl+"?reportType="+reportType+"&"+fieldName1+"="+fieldValue1+"&"+fieldName2+"="+fieldValue2+"";
			} else {
				var fieldValue = $(this.id).val();
				var fieldName = $(this.id)[0].name;

				var url = reportUrl+"?reportType="+reportType+"&"+fieldName+"="+fieldValue+"";
			}
			window.location.href = url;
		});
	}
});