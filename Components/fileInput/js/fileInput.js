$(document).ready(function(){
	$('#fileInput').change(function () {
		if(this.files.length>0) {
			$('label').text(this.files[0].name.substr(0,15)+"...");
		}
	});
});