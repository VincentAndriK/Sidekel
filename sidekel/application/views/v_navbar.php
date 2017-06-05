<!-- Scrolling Nav Css -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/scrolling-nav/scrolling-nav.css" media="screen" />
	
<nav class="navbar navbar-fixed-top" role="navigation">
<?php 	
	$logo_desa = $konten_logo->konten_logo_desa;
?>
<div id="nav_brand" class="navbar-brand">
	<a href="<?php echo site_url('web/c_home/');?>"> 
	<img src='<?php echo site_url($logo_desa);?>'>
	</a>
</div>
<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
</div>
<div class="navbar-collapse collapse">
	<ul style="margin-left:-2px;" class="nav navbar-nav navbar-right">
		<li id="nav-home"><a href="<?php echo site_url('web/c_home/');?>">Beranda</a></li>
		<li id="nav-profile"><a href="<?php echo site_url('web/c_profil_desa/');?>">Profil Desa</a></li>	
		<li id="nav-artikel"><a href="<?php echo site_url('web/c_artikel/');?>">Artikel</a></li>
		<li id="nav-galeri"><a href="<?php echo site_url('web/c_galeri/');?>">Galeri</a></li>
		<!--
		<li id="nav-profil" class="dropdown">
			<a class="dropdown-toggle dropdownhover" data-toggle="dropdown" href="#">Profil Desa <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo site_url('web/c_sejarah/');?>">Sejarah Desa</a></li>
				<li><a href="<?php echo site_url('web/c_demografi/');?>">Demografi</a></li>
				<li><a href="<?php echo site_url('web/c_visimisi/');?>">Visi dan Misi</a></li>
			</ul>
		</li>
		-->
		<li id="nav-berita" class="">
			<a class="dropdown-toggle dropdownhover" data-toggle="dropdown" href="#">Berita <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo site_url('web/c_berita/');?>">Berita</a></li>
				<li><a href="<?php echo site_url('web/c_jurnal_warga/');?>">Jurnalisme Warga</a></li>
			</ul>
		</li>
		<li id="nav-peta"><a href="<?php echo site_url('web/c_peta/');?>">Peta Desa</a></li>
		
		<li id="nav-lembaga" class="">
			<a class="dropdown-toggle dropdownhover" data-toggle="dropdown" href="#">Lembaga Desa <span class="caret"></span></a>
			<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
				<li><a href="<?php echo site_url('web/c_lembaga_desa/');?>">Pemerintah Desa</a></li>
				<li><a  href="<?php echo site_url('web/c_rt_rw/');?>">Lembaga Kemasyarakatan Desa</a></li>
			</ul>
		</li>
		
		<li id="nav-statistik" class="">
			<a class="dropdown-toggle dropdownhover" data-toggle="dropdown" href="#"> Statistik Desa <span class="caret"></span></a>
			<ul class="dropdown-menu">	
				<li><a href="<?php echo site_url('web/c_statistik_agama/');?>">Agama</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_buruh_migran');?>">Buruh Migran</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_bsm');?>">Bantuan Siswa Miskin</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_buruh_migran');?>">Buruh Migran</a></li>			
				<li><a href="<?php echo site_url('web/c_statistik_gizi_buruk');?>">Gizi Buruk</a></li>	
				<li><a href="<?php echo site_url('web/c_statistik_goldar');?>">Golongan Darah</a></li>		
				<li><a href="<?php echo site_url('web/c_statistik_jamkesmas');?>">Jamkesmas</a></li>	
				<li><a href="<?php echo site_url('web/c_statistik_kelas_sosial');?>">Kelas Sosial</a></li>	
				<li><a href="<?php echo site_url('web/c_statistik_kehamilan');?>">Kehamilan</a></li>				
				<li><a href="<?php echo site_url('web/c_statistik_kk');?>">Kepala Keluarga</a></li>	
				<li><a href="<?php echo site_url('web/c_statistik_pekerjaan/');?>">Pekerjaan</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_pendidikan');?>">Pendidikan</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_piramida');?>">Piramida Penduduk</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_pkh');?>">Program Keluarga Harapan</a></li>
				<li><a href="<?php echo site_url('web/c_statistik_raskin');?>">Raskin</a></li>	
				<li><a href="<?php echo site_url('web/c_statistik_status_kawin');?>">Status Kawin</a></li>				
			</ul>
		</li>
		
		<li id="nav-regulasi"><a href="<?php echo site_url('web/c_regulasi/');?>">Regulasi</a></li>
		<li class="navbar-right" id="navbar-search">
			<a><i class="fa fa-search"></i></a>
		<div class="hidden" id="navbar-search-box">
		<?php $this->load->helper(array('form', 'search')); ?>		
		<?php echo form_open('web/c_pages/search/');?>
		<?php echo validation_errors(); ?>	
		<fieldset>			
			<div class="input-group">
				<input type="text" class="form-control" name="keyword" id="keyword" autofocus placeholder="Masukkan Kata Kunci">
				<span class="input-group-btn">
					<button class="btn btn-default" value="Submit" name="submit" type="submit">Cari</button>
				</span>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
		
		<!--	
		<li><a title="Login SSO" id="sso" href="https://auth.klikindonesia.or.id/authorize.php?scope=authorizations&appid=<?php //echo $data_sso->app_id;?>&access_type=login"><i class="fa fa-user"></i> LOGIN</a></li>
		-->
		
		</div>
	</li>

	</ul>
</div>
</div>
</nav>
	

<!-- Scrolling Nav JS -->	
<script src="<?php echo base_url(); ?>assetku/scrolling-nav/scrolling-nav.js"></script>