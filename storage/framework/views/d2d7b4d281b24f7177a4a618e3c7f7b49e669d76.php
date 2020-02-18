	<script type="text/javascript" src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
	<script src="https://api-maps.yandex.ru/2.1/?lang=tr_TR&amp;apikey=b452ab5b-4b01-45b5-bf34-77428a6979f0&coordorder=longla" type="text/javascript"></script>
	
	<script>
	ymaps.ready()
    .done(function (ym) {
        var myMap = new ym.Map('map-main', {
            center: [35.909120463748, 14.505824645394],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        });

        jQuery.getJSON('/data_valletta_<?php echo Request::segment(2); ?>.json', function (json) {
            var geoObjects = ym.geoQuery(json)
                    .addToMap(myMap)
                    .applyBoundsToMap(myMap, {
                        checkZoomRange: true
                    });
        });
    });
	</script>

	<script>
	$(document).ready(function() {
		
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		$(".map-container.column-map").css({
			height: $(window).outerHeight(true)-0+"px"
		});
		
		$.ajax({
			url: '/venues_explore',
			type: 'POST',
			data: {_token: CSRF_TOKEN, near: 'valletta', query: '<?php echo Request::segment(2); ?>'},
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
	});
	</script>
	
	<script>
	ymaps.ready()
    .done(function (ym) {
        var myMap = new ym.Map('map-main', {
            center: [35.909120463748, 14.505824645394],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        });
    });
	</script>
	
	<script>
	$(document).ready(function() {
		
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		
		$(".map-container.column-map").css({
			height: $(window).outerHeight(true)-0+"px"
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
	});
	</script>
	
</body>
</html><?php /**PATH C:\xampp\htdocs\resources\views/Footer.blade.php ENDPATH**/ ?>