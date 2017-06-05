<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Login</title>
    <link rel="stylesheet" href="<?= base_url() ?>css/login.css" type="text/css" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <link rel="shortcut icon" href="<?php echo base_url();?>assetku/img/favicon.ico" type="image/x-icon" />
	<!-- Alertify CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css" id="toggleCSS" />

	<!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/bootstrap.min.css">
	
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/sb-admin-2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetku/css/admin.css">
	<!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>sidekel_theme/dist/css/AdminLTE.css">
	<meta name="robots" content="noindex,nofollow" />
	<meta name="google" content="notranslate" />
	<meta name="googlebot" content="noindex,nofollow" />
	<meta name="googlebot-news" content="nosnippet">
</head>
<body>

<div class="container">

                <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel " style="background-color: #34495e;">
					
                    <div class="panel-heading">
						<img src="<?php echo base_url(); ?>assetku/img/logo_sidekel.png" class="img-responsive"> 						
                    </div>
					
                    <div class="panel-body">
                        <?php echo form_open('c_login/check_login'); ?>
                        <legend></legend>  
						<div class="form-group">
						<input class="form-control" placeholder="Nama Pengguna" name="username" type="username" autofocus required>
						<span class="help-block"><?php echo form_error('username', '<p class="field_error">', '</p>'); ?></span>
						</div>
						
						<div class="form-group">
						<input id="xxx2" class="form-control" placeholder="Kata Sandi" name="password" type="hidden" value="" required>
						<input id="xxx1" class="form-control" placeholder="Kata Sandi" type="password" value="" required>
						<span class="help-block"><?php echo form_error('password', '<p class="field_error">', '</p>'); ?></span>
						</div>
						<div class="form-group">
						<!-- Change this to a button or input when using this as a form -->
						<input type="submit" value="Masuk" class="btn btn-lg btn-primary btn-block"/>
						</div>
						<legend></legend>
                        <?php echo form_close(); ?>
						<div class="pojok">
						<a href="http://helpdesk.layanan.go.id" target="blank"><label class="pull-right" >Helpdesk ?</label></a>
                       </div>
                    </div>
					
					<div class="panel-footer" style="background-color: #34494f; color:#fff;">
						<span align="center">SIDeKel ver 6.3a(DEMO) | Copyright @2016<span>
					</div>
                </div>
            </div>
        </div>
    </div>
	<div class="alert alert-info col-md-6 col-md-offset-3">
	user : <b>sidekaadmin</b>,<b>sidekapengelola</b><br>
	pass : <b>sidekapass</b><br>
	<br>
	#Pada versi <b>alpha/demo</b> semua exception handling non-aktif dan pesan error ditampilkan
	<br>
	<br>
	<dl>
	  
	  <dt>ver 6.3a | 27-may-16</dt>  
	  <dd>+ (front-end) Penambahan fungsi 'PERMALINKS URL'</dd>	   
	  <dd>+ (front-end) Penambahan fungsi 'RSS FEED' url: '[domain]/xml/rss'</dd>	   
	  <dd>+ (front-end) Penambahan fungsi 'THEME COSTOMIZATION'</dd>   
	  <dd>* (front-end) Pembaruan fungsi 'Search Engine Optimization'</dd>	   
	  <dd>* (front-end) Pembaruan tampilan (acuan SIMAYA)</dd>	  
	  <dd>* (back-end | administrator) Pembaruan tampilan (acuan SIMAYA)</dd>	  
	  <dd>* (back-end)| pengelola data) Pembaruan tampilan (acuan SIMAYA)</dd>	  
	  <dd>* (back-end)) Pembaruan fungsi 'NON AUTH SESSION</dd>	  
	  <dd>* (back-end)) Pembaruan fungsi 'VULNERABILITY XSS</dd>	  
	  
	  <br>	
	  <dt>ver 6.2a | 14-mar-16</dt> 	  
	  <dd>- (front-end) Perbaikan fungsi 'global search'</dd>	  
	  <dd>- (back-end | sidekaadmin) Perbaikan fungsi slider beranda</dd>	  	  
	  <dd>- (back-end | sidekaadmin) Perbaikan fungsi berita [upload,add,edit]</dd>
	  <dd>- (back-end | sidekaadmin) Perbaikan fungsi jurnalisme warga [edit]</dd>
	  <dd>- (back-end | sidekaadmin) Perbaikan fungsi regulasi [upload]</dd>
	  <dd>- (back-end | sidekaadmin) Perbaikan fungsi data provinsi [satuan_luas]</dd>
	  <dd>- (back-end | sidekaadmin) Perbaikan fungsi data kabupaten/kota [satuan_luas]</dd>
	  <dd>- (back-end | sidekaadmin) Perbaikan fungsi data kecamatan [satuan_luas]</dd>
	  <dd>- (back-end | sidekaadmin) Perbaikan fungsi data desa [satuan_luas]</dd>	  
	  <dd>+ (All) Penambahan minimalisir 'size image' yg di upload </dd>
	  <dd>+ (front-end) Penambahan menu Artikel</dd>
	  <dd>+ (back-end | sidekaadmin) Penambahan fungsi Artikel</dd>
	  <dd>+ (back-end | sidekaadmin) Penambahan fungsi grafik potensi ekonomi desa</dd>
	  <dd>+ (database) 'create table' tbl_artikel</dd>
	  <dd>+ (database) 'create table' ref_kategori_artikel</dd>
	  <dd>* (front-end) Pembaruan layout 'Berita'</dd>
	  <dd>* (back-end | sidekaperencana) Pembaruan layout 'CRUDS' di semua fungsi</dd>
	  <dd>* (back-end | sidekaaset) Pembaruan layout 'CRUDS' di semua fungsi</dd>
	  <dd>* (database) 'alter table' tbl_berita penambahan field [thumb]</dd>
	  <dd>- (back-end | sidekaadmin) Perbaikan fungsi detil potensi desa</dd>
	  <dd>- (back-end | sidekaperencana) Perbaikan fungsi SPP </i></dd>
	  <dd>- (database) Perbaikan Trigger </i></dd>
	  <dd>+ (front-end) Penambahan Menu Galeri (On Progress)</dd>	  
	  <dd>+ (back-end | sidekaadmin) Penambahan fungsi 'Media Sosial'</dd>
	  <dd>+ (back-end | sidekaadmin) Penambahan field [no_telp,email] di fungsi 'Pengelolaan Desa'</dd>
	  <dd>+ (database) 'create table' tbl_sosmed</dd>
	  <dd>* (front-end) Pembaruan Layout Galeri di Menu Beranda (On Progress)</dd>
	  <dd>* (front-end) Pembaruan Layout Kontak di Menu Beranda</dd>
	  <dd>* (front-end) Pembaruan Layout Lembaga Kemasyarakatan Desa di Menu Lembaga Desa</dd>
	  <dd>* (database) 'alter table' ref_desa</dd>
	  <dd>- (back-end | sidekaadmin) Perbaikan layout 'CRUDS' di semua fungsi <i>(tested on chrome and firefox)</i></dd>
	  <dd>- (back-end | sidekapengelola) Perbaikan layout 'CRUDS' di semua fungsi <i>(tested on chrome and firefox)</i></dd>
	  <dd>+ (front-end) Penambahan Design baru (Remake SIDeKel 6.1)</dd>
	  <dd>+ (back-end) Penambahan Design baru (Remake SIDeKel 6.1)</dd>
	  <dd>* (back-end | sidekaadmin) Pembaruan fungsi 'Logo'</dd>
	  <dd>* (back-end | sidekaadmin) Pembaruan fungsi 'Sejarah Desa'</dd>
	  <dd>* (back-end | sidekaadmin) Pembaruan fungsi 'Demografi Desa'</dd>
	  <dd>* (back-end | sidekaadmin) Pembaruan fungsi 'Visi Misi Desa'</dd>
	  <dd>* (back-end | sidekaadmin) Pembaruan fungsi 'Pengelolaan Provinsi'</dd>
	  <dd>* (back-end | sidekaadmin) Pembaruan fungsi 'Pengelolaan Kab Kot'</dd>
	  <dd>* (back-end | sidekaadmin) Pembaruan fungsi 'Pengelolaan Kecamatan'</dd>
	  <dd>- (database) Perbaikan metode 'indexing' di semua 'table'</dd>
	  <dd>- (database) Perbaikan metode 'export-import' <i>(tested on local[MySql Workbench] and lppm.uajy.ac.id[cPanel])</i></dd>
	  
	  <!--dt>COMING SOON</dt>
	  <dd>* (front-end) Perbaikan menu Galeri</dd-->
	</dl>
	</div>
	
	
	<!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery-1.11.0.js"></script>
    
	<!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/plugins/metisMenu/metisMenu.min.js"></script>
	
    <!-- Custom Theme JavaScript -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/sb-admin-2.js"></script>
	
	<!-- Alertify JavaScript -->
	<script src="<?php echo base_url(); ?>assetku/alertify/lib/alertify.min.js"></script>	
	
	<!-- Sideka JavaScript -->
	<script src="<?php echo base_url(); ?>assetku/js/sideka.js"></script>

	<script>
	$(document).ready(function(){  
	$("form").submit(function(){var a=$("#xxx1").val(),a=SIDEKA(a),a=SIDEKA(a);$("#xxx2").val(a);return!0});
	if(<?php echo $cek;?>=='0')
	{
		alertify.error("Nama Pengguna dan kata sandi tidak cocok !");
	}
	}); 
	function reset(){$("#toggleCSS").attr("href","<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css");alertify.set({labels:{ok:"OK",cancel:"Cancel"},delay:5E3,buttonReverse:!1,buttonFocus:"ok"})};
</script>
<style>
body{
  background:#f8f8f8;
  font-family:tahoma,verdana,arial,sans-serif;
  font-size:14px;
}
a
{
	color:#eee;
}
a :hover
{
	color:#fff;
}

.panel-heading{background:rgba(245, 245, 245, 0.09);}
.panel-footer{text-align:center;}

.panel {
  margin-bottom: 20px;
  background-color: #fff;
  border: 3px solid rgb(102, 102, 102);
  border-radius: 5px;
  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
  box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
</style>
</style>
</body>
</html>