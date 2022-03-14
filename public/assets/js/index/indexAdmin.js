$(document).ready(function() {
	//
	$( ".btnClientChoice" ).click(function() {
		displaySpinner('show');
		var idc = $(this).attr('idc');
		document.formSelectClient.idc.value = idc;
		document.formSelectClient.submit();
	});
	//
	$().UItoTop({ easingType: 'easeOutQuart' });
});
