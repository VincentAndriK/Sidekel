<?php 
	$session['hasil'] = $this->session->userdata('logged_in');
	$nama = $session['hasil']->nama_pengguna;
	$role = $session['hasil']->role;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="robots" content="noindex,nofollow" />
	<meta name="google" content="notranslate" />
	<meta name="googlebot" content="noindex,nofollow" />
	<meta name="googlebot-news" content="nosnippet">
	<title><?= $page_title ?></title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
	<!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/sidekel.css">	
	
    <link rel="shortcut icon" href="<?php echo base_url();?>assetku/img/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assetku/css/bootstrap.css" rel="stylesheet">

   

    <!-- Custom CSS REQUIRED
    <link href="<?php echo base_url(); ?>assetku/css/admin.css" rel="stylesheet"> -->
	 <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assetku/css/<?php if($role=="Pengelola Data"){echo "pengelola_data";}else {echo "admin";} ?>.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assetku/font/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- Alertify CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css" id="toggleCSS" />	 

	<!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery-1.11.0.js"></script>
	
	<!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap.min.js"></script>

   	
	 <!-- Auto Complete Library -->
	<link href="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.structure.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.structure.min.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.js"></script>  
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.min.js"></script>  
    
	
	
	<!--new --><!--new --><!--new --><!--new --><!--new --><!--new --><!--new --><!--new --><!--new -->
	
	<!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>sidekel_theme/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>sidekel_theme/dist/css/skins/_all-skins.min.css">
  
   
</head>
<body>
    <div id="wrapper">		
				
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top " role="navigation" style="margin-bottom: 0px">
			
			<div class="col-md-12">
				<ul class="nav navbar-top-links navbar-right  " style="margin-top:3px;">
					<li class="dropdown ">
						<a class="dropdown-toggle pojok" data-toggle="dropdown" href="#">
							<i class="fa fa-user fa-fw"></i>
							<?php echo $nama ?> | <b><?php echo $role ?></b>
							<i class="fa fa-caret-down"> </i> 
						</a>
						<ul class="dropdown-menu dropdown-user">		
							<li><a href="<?php echo site_url('c_changePass');?>"><i class="fa fa-pencil fa-fw"></i> Ubah Kata Sandi</a>
							</li>
							
						<li class="divider"></li>
							<li><a href="<?php echo site_url('c_login/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Keluar</a>
						</li>
						</ul>
					</li>
				</ul> 
			</div>             
            <!-- /.navbar-header -->
			
			<!-- sidebar -->
			<div class="sidebar logo">
					<div class="sidebar- img-responsive">			
						<img src="<?php echo base_url(); ?>assetku/img/logo_sidekel.png" style="float:left; width:95%;"> 
					</div>						
			</div>
			<?= $menu ?>	
			<!-- /.sidebar -->			
		</nav>
		<!-- /.Navigation -->
		
		
        <div id="page-wrapper" style="padding-bottom:10%;">
            <div class="row">
					<?= $content ?>
                <!-- /.col-lg-12 -->
				
                           
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>

	<!-- Alertify JavaScript -->
	<script src="<?php echo base_url(); ?>assetku/alertify/lib/alertify.min.js"></script>

	<script>
	
	function reset () {
		$("#toggleCSS").attr("href", "<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css");
		alertify.set({
			labels : {
				ok     : "OK",
				cancel : "Cancel"
			},
			delay : 5000,
			buttonReverse : false,
			buttonFocus   : "ok"
		});
	}
	$(document).ready(function() {
	 
	<?php $flashmessage = $this->session->flashdata('message');
		echo ! empty($flashmessage) ? 'alertify.success("'.$flashmessage.'")' : ''; ?>
	<?php $flashexist = $this->session->flashdata('exist');
		echo ! empty($flashexist) ? 'alertify.error("'.$flashexist.'")' : ''; ?>
	});
	</script>

</body>
</html>