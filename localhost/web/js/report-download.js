$(document).ready(function(){ 
    $('#student-profile-grid').on('click', 'a.btn-report-download', function(e){
		e.preventDefault();

		if( $(this).attr('data-url') != ''){
			let link = $("<a id='link' />");
			link.attr('href', $(this).attr('href'));
			$('body').append(link);
			link = $("#link");
			link[0].click();
			link.remove();
		}	
	});

})