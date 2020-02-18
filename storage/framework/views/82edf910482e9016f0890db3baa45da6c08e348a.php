<?php echo $__env->make('Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <body>
	<div id="main">
		<div id="wrapper">
			<div id="content">
				
				<div class="map-container column-map right-pos-map">
					<div id="map-main"></div> 						
				</div>

				<div class="col-list-wrap left-list p-10">
				
				<h2 class="text-center">CATEGORIES</h2>
					<hr />
					<div id="categories"><center><div class="loader"></div></center></div>				
				</div>
				
			</div>
		</div>
	</div>
<?php echo $__env->make('Footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/bilgeokul.com/mert.bilgeokul.com/resources/views/Home.blade.php ENDPATH**/ ?>