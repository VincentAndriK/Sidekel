<!DOCTYPE html>

<html lang="en">
<head>
	
	<link rel="shortcut icon" href="<?php echo base_url();?>assetku/img/favicon.ico" type="image/x-icon" />
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<meta name="viewport" content="width=device-width; maximum-scale=1; minimum-scale=1;" />
	<meta name="author" content="Muhammad Yogie Palatino, Lucas Sandy Duta Arga, Yohanes Erwin Dari, Irya Wisnubhadra">
	<meta name="copyright" content="Kementrian Komunikasi dan Informatika">
	<meta name="keywords" content="sistem,informasi,desa,kelurahan,sideka,kemkominfo,<?=$desa->nama_desa?>">	
	<meta name="title" content="<?=$desa->nama_desa?> - Sistem Informasi Desa dan Kelurahan" />
	<meta name="description" content="Sistem Informasi Desa dan Kelurahan, Program yang memanfaatkan IT untuk tata kelola informasi dan tata kelola sumberdaya desa dan kelurahan." />
	<meta name="format-detection" content="telephone=no">
	<link rel="canonical" href="<?=base_url()?>" />
	<meta property="og:title" content="<?=$desa->nama_desa?> - Sistem Informasi Desa dan Kelurahan"/>
	<meta property="og:description" content="Sistem Informasi Desa dan Kelurahan, Program yang memanfaatkan IT untuk tata kelola informasi dan tata kelola sumberdaya desa dan kelurahan."/>
	<meta property="og:site_name" content="<?=$desa->nama_desa?> - Sistem Informasi Desa dan Kelurahan"/>
	<meta property="og:url" content="<?=base_url()?>"/>
	<meta property="og:image" content="<?=base_url().$konten_logo->konten_logo_desa?>"/>	
	<meta name="robots" content="index,follow" />
	<meta name="google" content="notranslate" />
	<meta name="googlebot" content="index,follow" />
	<meta name="googlebot-news" content="nosnippet">
	
	<?php 
		$title_desa = '';
		$nama_desa = $konten_logo->nama_desa;
		if($nama_desa == null)
		{
			$title_desa = 'Sistem Informasi Desa dan Kelurahan';
		}
		else
		{
			$title_desa = 'Desa '.$nama_desa;
		}
	?>
	<title><?= $title_desa?></title>
	<?php 	
	$path_css = $konten_logo->path_css;
	//$path_css = 'assetku/css/style_blue.css';
	?>
	
	
	<!-- REVOLUTION BANNER CSS SETTINGS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assetku/rs-plugin/css/settings.css" media="screen" />	
	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assetku/css/old/style.css" media="screen" />
	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo site_url($path_css);?>"> 
	<!--<link rel="stylesheet" href="<?php //echo site_url('assetku/css/style_blue.css');?>"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/flexslider.css" type="text/css" media="screen">
	
	<link href="<?php echo base_url(); ?>assetku/font/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assetku/css/animate.css" rel="stylesheet">
    <!--link href="<?php echo base_url(); ?>assetku/css/lightbox.css" rel="stylesheet"-->
	
    <link href="<?php echo base_url(); ?>assetku/scrolling-nav/scrolling-nav.css" rel="stylesheet">
     
	
	<link href="<?php echo base_url(); ?>assetku/plugin/bxslider/jquery.bxslider.css" rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assetku/plugin/owl-carousel/owl.carousel.css" rel="stylesheet">
	
	<!-- Alertify CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css" id="toggleCSS" />	 

	<!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery-1.11.0.js"></script>
	
	
</head>
<body>
	
	<!-- - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - -->	
	<nav class="navbar">
		<?php if ( isset($menu))
		{
			echo $menu;		
		}
		else
		{
			echo "Content belum diset";
		}?>	
	</nav><!--/ #navigation-->
	<!-- - - - - - - - - - - - end Navigation - - - - - - - - - - - - - -->	

		<!-- - - - - - - - - - - - - Logo - - - - - - - - - - - - - - -->	
	<div class="container">
		<?php 
		/* if ( isset($logo))
		{
			echo $logo;
		}
		else
		{
			echo "Content belum diset";
		}  */
		?>
	</div><!--/ #logo-->
	<!-- - - - - - - - - - - - end Logo - - - - - - - - - - - - - -->	

	
	<!-- - - - - - - - - - - - - Slider - - - - - - - - - - - - - - - -->	
	<div class="wrapper">
		<?php if ( isset($slider))
		{
			echo $slider;
		}
		else
		{
			echo "";
		}?>
    </div>
	<!-- - - - - - - - - - - - - end Slider - - - - - - - - - - - - - - -->
	

	<!-- - - - - - - - - - - - - - Main - - - - - - - - - - - - - - - - -->		
		<div class="wrapper" style="margin-top:65px;">
		<div class="">
		<?php if ( isset($content))
				{
					echo $content;
				}
				else
				{
					echo "";
				}?>
		</div>
		</div>
		</div>
	<!-- - - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->	
	<div class="wrapper">
	<footer>
	<?php if ( isset($footer))
				{
					echo $footer;
				}
				else
				{
					echo "footer belum diset";
				}?>
			
	</footer>	
	</div>
	
	<!-- - - - - - - - - - - - - end Bottom Footer - - - - - - - - - - - - - -->		

	
	<!-- HTML5 SHIV + DETECT TOUCH EVENTS -->
	<script type="text/javascript" src="<?php echo base_url();?>assetku/js/modernizr.custom.js"></script>
		
	<!-- JS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap-hover-dropdown.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery.flexslider.js"></script>
	
    <script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/scrolltopcontrol.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assetku/scrolling-nav/scrolling-nav.js"></script>

	<script src="<?php echo base_url(); ?>assetku/plugin/bxslider/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/plugin/owl-carousel/owl.carousel.js"></script>
	
 
<script>
    // very simple to use!
    $(document).ready(function() {
      $('.dropdownhover').dropdownHover().dropdown();
      nav_active();
	$('.footer-content').css('display', 'none');
	$('.footer-content').fadeIn(1500);
    });
</script>

<script>
	//JS for owl-carousel
		if ($('.owl-carousel').length>0) {
			$(".owl-carousel.carousel").owlCarousel({
				items: 3,
				autoPlay: 5000,
				interval: 5000,
				pagination: false,
				navigation: true,
				navigationText: false
			});
			$(".owl-carousel.carousel-autoplay").owlCarousel({
				items: 3,
				autoPlay: 5000,
				pagination: false,
				navigation: true,
				navigationText: false
			});
			$(".owl-carousel.clients").owlCarousel({
				items: 3,
				autoPlay: true,
				pagination: false,
				itemsDesktopSmall: [992,5],
				itemsTablet: [768,4],
				itemsMobile: [479,3]
			});
			$(".owl-carousel.content-slider").owlCarousel({
				singleItem: true,
				autoPlay: 5000,
				navigation: false,
				navigationText: false,
				pagination: false
			});
			$(".owl-carousel.content-slider-with-controls").owlCarousel({
				singleItem: true,
				autoPlay: false,
				navigation: true,
				navigationText: false,
				pagination: true
			});
			$(".owl-carousel.content-slider-with-controls-autoplay").owlCarousel({
				singleItem: true,
				autoPlay: 5000,
				navigation: true,
				navigationText: false,
				pagination: true
			});
			$(".owl-carousel.content-slider-with-controls-bottom").owlCarousel({
				singleItem: true,
				autoPlay: false,
				navigation: true,
				navigationText: false,
				pagination: true
			});
		};
</script>
  
  <script type="text/javascript">
	$('#navbar-search > a').on('click', function() {
		$('#navbar-search > a > i').toggleClass('fa-search fa-times');
		$("#navbar-search-box").toggleClass('show hidden animated fadeInUp');
		return false;
	});
  </script>

</body>
</html>	
