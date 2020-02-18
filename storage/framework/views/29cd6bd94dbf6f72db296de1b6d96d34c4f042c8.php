<?php echo $__env->make('Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <body>
	<div id="main">
		<div id="wrapper">
			<div id="content">
			
				<div class="map-container column-map right-pos-map">
					<div id="map-main"></div> 						
                </div>
				
				<div class="col-list-wrap left-list p-10">
				
				<h2 class="text-center">PLACES</h2>
				<hr />
				<div id="explore_list"><center><div class="loader"></div><div class="alert alert-danger hidden" role="alert">
				  <strong>Oh snap!</strong> Change a few things up and try submitting again.
				</div></center></div>				
				</div>
			</div>
		</div>
	</div>
<?php echo $__env->make('Footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/Category.blade.php ENDPATH**/ ?>