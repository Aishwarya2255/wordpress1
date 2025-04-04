var ct = 3;
$(document).on( 'click', '#ajax-load', function( event ) {
		$('#loader').show();
	ct = ct+3;
	var $authId = $('#auth_id').text();
	event.preventDefault();
	$.ajax({
		url: ajaxpagination.ajaxurl,
		type: 'post',
		data: {
			action: 'bilalhssn_ac',
			query_vars: ajaxpagination.query_vars,
			'ct': ct,
			'yayaya_id': $authId,
		},
		success: function( html ) {
			$('#loader').fadeOut('slow');
			$('#ajax-load').before(html);
		}
	})
})

var ct = 3;
$(document).on( 'click', '#ajax-load_jobs', function( event ) {
		$('#loader').show();
	ct = ct+3;
	var $authId = $('#auth_id_jobs').text();
	event.preventDefault();
	$.ajax({
		url: ajaxpagination.ajaxurl,
		type: 'post',
		data: {
			action: 'bilalhssn_ac_jobs',
			query_vars: ajaxpagination.query_vars,
			'ct': ct,
			'yayaya_id': $authId,
		},
		success: function( html ) {
			$('#loader').fadeOut('slow');
			$('#ajax-load_jobs').before(html);
		}
	})
})
var ctt= 3;
$(document).on( 'click', '#ajax-load-tax', function( event ) {
	$('#loader').show();

	ctt = ctt+9;
	//ct = ct+3;
	var $tax_bilal = $('#tax_bilal').text();
	event.preventDefault();
	$.ajax({
		url: ajaxpagination.ajaxurl,
		type: 'post',
		data: {
			action: 'bilal_ac',
			query_vars: ajaxpagination.query_vars,
			'ct': ctt,
			'yayaya_id': $tax_bilal,
		},
		success: function( html ) {
			$('#loader').fadeOut('slow');
			$('#ajax-load-tax').before(html);
		}
	})
})

$(document).on('click', '.sidebar-filter ul li', function(event){
	$('#loader').show();
	//var type = $(this).text();
	var taxonomy = $(this).parent('ul').attr('class');

	if($(this).hasClass('alert-danger')){
		if(taxonomy=='types'){
		var type_data = ""
		console.log(taxonomy)
		} 
		if(taxonomy=='qualifications'){
		var loca_data = ""
		console.log(taxonomy)
		}

		if(taxonomy=='job-cat'){
		var cat_data = ""
		console.log(taxonomy)
		}
		$(this).removeClass('alert-danger')
	} else {
	$(this).addClass('alert-danger')
	$('.alert-danger').css('cursor','pointer')

	
		if(taxonomy=='types'){
			var type_data = $(this).text();
		} 
		if(taxonomy=='qualifications'){
			var loca_data = $(this).text();
		}
		if(taxonomy=='job-cat'){
			var cat_data = $(this).text();
		}
	
	}
	//$('.sidebar-filter').after("<div style='display:none;' id='tax1'>"+taxonomy+"</div><div style='display:none;' id='taxV1'>"+tax_value+"</div>")
	
	

	event.preventDefault();
	$.ajax({
		url: ajaxpagination.ajaxurl,
		type: 'post',
		data: {
			action: 'filter_jobs',
			query_vars: ajaxpagination.query_vars,
			'type_data': type_data,
			'loca_data': loca_data,
			'cat_data': cat_data,
		},
		success: function(html){
			$('#loader').fadeOut('slow');
			$('.blog-list').html(html);
		}
	})

})

$(document).on('change', '.radioBH', function(event){
	event.preventDefault();
	//console.log($('input[name="job_category"]:checked').val())
	$('input[name="category"]').removeAttr('checked');
	$('input[name="qualifications"]').removeAttr('checked');
	$('input[name="locations"]').removeAttr('checked');

	if ($('input[name="category"]').is(":checked")) {
    	val = $('input[name="category"]:checked').val();   
    }
    if ($('input[name="qualifications"]').is(":checked")) {
    	val = $('input[name="qualifications"]:checked').val();   
    }
    if ($('input[name="locations"]').is(":checked")) {
    	val = $('input[name="locations"]:checked').val();   
    }

	var taxonomy = $(this).find('div').attr('class');
	console.log(taxonomy);
	console.log(val);
	var url = document.location.origin
	window.location.href = url+"/govt-jobs/"+taxonomy+"/"+val;

});

$('#customData').css('display','none');
$('#txtbilal').on("focusin", function(){
	$('#customData').fadeIn('slow')
});

angular.module('myApp', []).controller('namesCtrl', function($scope, $http) {
    $http.get("https://36kheda.com/wp-json/wp/v2/city")
   .then(function (response) {
   	$scope.names = response.data;
   })
});



$(document).on('click', '#jb_bh', function(event){
	$('.thisIsHi a').removeClass('active')
	$('.blog-list').hide();
	$('.jobs_bh').show();
	$(this).addClass('active')
});

$(document).on('click', '#nw_bh', function(event){
	$('.thisIsHi a').removeClass('active')
	$('.blog-list').hide();
	$('.news_bh').show();
	$(this).addClass('active')

});