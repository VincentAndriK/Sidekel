<div class="">
	<!-- Home Slider -->
      <div class="home-slider" style="margin-top:60px; margin-bottom:15px;">
        <!-- Carousel -->
        <div id="home-slider" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->

          <ol class="carousel-indicators">
<?php	
$count = 0; 
foreach($slider_beranda as $sb)
{	
		  echo'
          <li id="bb'.$count.'" data-target="#home-slider" data-slide-to="'.$count.'" class=""></li>
           '; 
		   $count++;
}      
?>
  </ol>         <!-- Wrapper for slides -->
          <div class="carousel-inner">

 <?php
$count = 0; 
foreach($slider_beranda as $sb)
{	
	
	$teks = $sb->konten_teks;
	$background = $sb->konten_background;
	$logo = $sb->konten_logo;	
	$url = $sb->url;	
	
		echo'
			
			<div id="aaaa'.$count.'" class="item" style="background-image:url('.base_url().''.$background.'); background-position: bottom center;" >
			  <div class="container">
				<div class="row">
				  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
					<div class="home-slider__content" style="float:left; margin-top:75px">
					 <div id="cccc'.$count.'" class="animated slideInRight" style="text-align:center;">
					 <div class="img_logo_slider">
					<img src="'.base_url().''.$logo.'" alt="..." >
					 </div>
					 </div>
					<div class="col-lg-10">
					<h3 id="dddd'.$count.'" class="animated slideInDown delay-3" style="text-align:center;" >'.$teks.'<h3> 
					</div>
					<div class="btn_url_slider col-lg-2">
					<a href="'.$url.'"> 
			  		<button  class="animated slideInLeft delay-4 btn btn-md btn-default">Kunjungi <i class="fa fa-link"></i></button>
					</a>
					</div>
					</div>
				  </div>
				</div> <!-- / .row -->
			  </div> <!-- / .container -->
			</div> <!-- / .item -->
	';
	 $count++;
 }
?>
          </div> <!-- / .carousel -->
          <!-- Controls -->
          <a class="carousel-arrow carousel-arrow-prev" href="#home-slider" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="carousel-arrow carousel-arrow-next" href="#home-slider" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </div> <!-- / .home-slider -->
	<script>
		
		var d = document.getElementById('aaaa0');
		d.className = "item active";

		var d = document.getElementById('bb0');
		d.className = "active";
		


	</script>
</div>
	 