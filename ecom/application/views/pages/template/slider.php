<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						<style>
							.carousel-inner .item img{
								height:350px;
								width:100%;
							}
						</style>
						<div class="carousel-inner">
							<?php
							foreach($sliders as $key =>$slider){
							?>
							<div class="item ">
							<div class="item active">
								<div class="col-sm-12">
									<img src="<?php echo base_url('uploads/sliders/'.$slider->image)?>" class="girl img-responsive" alt="<?php echo $slider->title?>" />
								</div>
							</div>
							<?php
							}
							?> 
						</div>  
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->