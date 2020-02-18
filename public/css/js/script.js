(function ($) {
    "use strict";
	
	Pace.restart();
	
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	var category_name = $('meta[name="keywords"]').attr('content');
	var file;
	
	$(".map-container.column-map").css({
		height: $(window).outerHeight(true)-0+"px"
	});
	
	$.ajax({
		url: '/venues_explore',
		type: 'POST',
		data: {_token: CSRF_TOKEN, query: category_name},
		dataType: 'JSON',
		beforeSend: function() {
			$(".loader").show(); 
		},
		success: function (data) { 
			if(data.explore_list.length > 0) {
				$("#explore_list").html(data.explore_list).fadeIn('normal'); 
			}
			else
			{
				$(".loader").hide(); 
				$(".alert").removeClass('hidden'); 
			}
		}
	});
	
	$.ajax({
		url: '/venues_categories',
		type: 'POST',
		data: {_token: CSRF_TOKEN},
		dataType: 'JSON',
		beforeSend: function() {
			$(".loader").show(); 
		},
		success: function (data) { 
			$("#categories").html(data.categories).fadeIn('normal'); 
		}
	});
	
	ymaps.ready()
	.done(function (ym) {
		var myMap = new ym.Map('map-main', {
			center: [35.909120463748, 14.505824645394],
			zoom: 10
		}, {
			searchControlProvider: 'yandex#search'
		});

		if(category_name.length > 0) {
			file = 'data_'+category_name;
		}
		else
		{
			file = 'data_all';
		}
	
		jQuery.getJSON('/'+file+'.json', function (json) {
			var geoObjects = ym.geoQuery(json)
					.addToMap(myMap)
					.applyBoundsToMap(myMap, {
						checkZoomRange: true
					});
		});
	});
	
})(jQuery);

