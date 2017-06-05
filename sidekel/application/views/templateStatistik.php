<!DOCTYPE html>

<html lang="en">
<head>
		<link rel="shortcut icon" href="<?php echo base_url();?>assetku/img/favicon.ico" type="image/x-icon" />
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<meta name="viewport" content="width=device-width; maximum-scale=1; minimum-scale=1;" />
	<meta name="author" content="Muhammad Yogie Palatino, Lucas Sandy Duta Arga, Yohanes Erwin Dari, Irya Wisnubhadra">
	<meta name="copyright" content="Kementrian Komunikasi dan Informatika">
	<meta name="keywords" content="sistem,informasi,desa,kelurahan,sideka,kemkominfo, <?=$desa->nama_desa?>">	
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
			$title_desa = 'Sistem Informasi Desa dan kelurahan';
		}
		else
		{
			$title_desa = 'Desa '.$nama_desa;
		}
	?>
	<title><?= $title_desa?></title>
	
	
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery-1.11.0.js"></script>
	
	<!-- HTML5 SHIV + DETECT TOUCH EVENTS -->
	<script type="text/javascript" src="<?php echo base_url();?>assetku/js/modernizr.custom.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="<?php echo site_url($path_css);?>"> -->
	<link rel="stylesheet" href="<?php echo site_url('assetku/css/style_blue.css');?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/flexslider.css" type="text/css" media="screen">
	
	<link href="<?php echo base_url(); ?>assetku/font/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assetku/css/animate.css" rel="stylesheet">

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
		} */
		?>
	</div><!--/ #logo-->
	<!-- - - - - - - - - - - - end Logo - - - - - - - - - - - - - -->	


	<!-- - - - - - - - - - - - - - Main - - - - - - - - - - - - - - - - -->		
		<section class="container" style="margin-top:65px;">				
		<h1>Statistik Desa</h1>
		<legend></legend>
		<?php if ( isset($content))
				{
					echo $content;
				}
				else
				{
					echo "Content belum diset";
				}?>
		</section>
	<!-- - - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->	
	
	<footer>			
		<?php if ( isset($footer))
				{
					echo $footer;
				}
				else
				{
					echo "Content belum diset";
				}?>
	</footer>
	
	<!-- - - - - - - - - - - - - end Bottom Footer - - - - - - - - - - - - - -->		


<?php echo $statistik;?>


<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts-3d.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/exporting.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap-hover-dropdown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/scrolltopcontrol.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/lightbox-2.6.min.js"></script>

<script>			
	function nav_active(){
	var d = document.getElementById("nav-statistik");
	d.className = d.className + "active";
	}
</script>
	
<script>
    // very simple to use!
    $(document).ready(function() {
      $('.dropdownhover').dropdownHover().dropdown();
    });
	
	$('.footer-content').css('display', 'none');
	$('.footer-content').fadeIn(1500);
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