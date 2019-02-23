$(document).ready(function(){
	$("#cookieConsent").click(function(){
        $("#cookieBanner").addClass("hidden");
		$("#cookiesAllowed").addClass("hidden");
		$("#no_cookiesAllowed").addClass("hidden");
		$("#blocker").addClass("hidden");
	});
	
	$("#no_cookieConsent").click(function(){
        $("#cookieBanner").addClass("hidden");
		$("#cookiesAllowed").addClass("hidden");
		$("#no_cookiesAllowed").addClass("hidden");
	});
});