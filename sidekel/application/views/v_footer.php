<div class="footer-atas color-white">
	<div class="container">
	<div class="row">
			<div class="col-sm-6">
				<div class="footer-content">
					<h2>SIDeKel</h2>	
					<p><h5>Sistem Informasi Desa dan Kelurahan</h5></p>
					<legend></legend>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="logo-footer img-responsive">
								<a href="http://kominfo.go.id/" target="_blank">
									<img src="<?php echo base_url(); ?>assetku/img/logo_kominfo.png" alt="" title="KEMKOMINFO">
								</a>
							</div>
						</div>
					</div>
					<div class="row">
					<?php 
						$nama_desa = '';
						$nama_desa = $desa->nama_desa;
						if($nama_desa == null)
						{
							$nama_desa = 'Sistem Informasi Desa dan Kelurahan';
						}
						else
						{
							$nama_desa = 'Desa '.$nama_desa;
						}
					?>
						<div class="col-md-12">
							<h4><?= $nama_desa ?></h4>
								<table>
									<tr>
										<td><i class="fa fa-map-marker fa-fw"></i>&nbsp;</td>
										<td><?= $desa->alamat_desa?></td>
									</tr>
								</table>
								<br>
								<table>
									<tr>
										<td><i class="fa fa-phone fa-fw"></i>&nbsp;</td>
										<td><?= $desa->no_telp?></td>
									</tr>
								</table>
								<br>
								<table>
									<tr>
										<td><i class="fa fa-envelope-o fa-fw"></i>&nbsp;</td>
										<td><?= $desa->email?></td>
									</tr>
								</table>
							<!--ul class="list-icons">
								<li><i class="fa fa-map-marker"></i> <?= $desa->alamat_desa?></li>
								<li><i class="fa fa-phone pr-10"></i> <?= $desa->no_telp?></li>
								<li><i class="fa fa-envelope-o pr-10"></i> <?= $desa->email?></li>				
							</ul-->
							<ul class="social-links circle">
								<li class="facebook"><a target="_blank" href="<?= $sosmed->link_facebook?>" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li class="twitter"><a target="_blank" href="<?= $sosmed->link_twitter?>" title="Twitter"><i class="fa fa-twitter"></i></a></li>
							</ul>
						</div>						
					</div>
				</div>
			</div>
			<!--
			<div class="col-sm-6  color-white">
				<div class="footer-content">
					<h2>Kontak Kami</h2>
					<h5>&nbsp;</h5>
					<legend></legend>								
					<?php 
					$attributes = array('id' => 'formKontak');
					echo form_open('c_kontak/simpan_kontak/', $attributes); ?>
						<div class="form-group has-feedback">
							<label class="sr-only" for="nama">Nama</label>
							<input type="text" class="form-control input-md" placeholder="Nama" id="nama" name="nama"  required >
						</div>
						<div class="form-group has-feedback">
							<label class="sr-only" for="email">Alamat Email</label>
							<input type="email" class="form-control input-md" placeholder="Alamat Email" id="email" name="email" required >
						</div>
						<div class="form-group has-feedback">
							<label class="sr-only" for="pesan">Pesan</label>
							<textarea class="form-control input-md" rows="5" placeholder="Pesan" id="pesan" name="pesan" required></textarea>
						</div>
			-->
						<!--div class="form-group has-feedback">
						<input class="form-control input-md" type="text" id="aunt" name="aunt" placeholder="Masukan Kode Diatas" required>
						</div-->
						<!--
						<div class="form-group has-feedback">
							<button id="kirim" name="kirim" class="btn btn-default" style="">Kirim</button>
						</div>
						-->
						<!--
						<a id="kirimLogin" href="https://auth.klikindonesia.or.id/authorize.php?scope=authorizations&appid=<?php echo $data_sso->app_id;?>&access_type=login" class="btn btn-default" role="button">Kirim</a>
						-->
						<!--
					<?php echo form_close(); ?>
				</div>
			</div>
			-->
			<div class="col-sm-6">
				<div class="footer-content">
					<h2>Kontak Kami</h2>
					<h5>&nbsp;</h5>
					<legend></legend>
					<?= $sosmed->widget_twitter?>
					</div>
			</div>
		</div>
		
</div>
</div>
<div class="footer-bawah">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<span align="center">SIDeKel ver 6.3a (DEMO VERSION) | Copyright © 2016 <a href="https://www.kominfo.go.id/" target="blank" style="color:#fff;">KEMENTRIAN KOMINFO RI</a><span>
			</div>
		</div>
	</div>
</div>

</body>
</html>
<!-- Alertify CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.core.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css" id="toggleCSS" />	 

<!-- Alertify JavaScript -->
<script src="<?php echo base_url(); ?>assetku/alertify/lib/alertify.min.js"></script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script>

$(function() {
/* 	$('#aunt').realperson({chars: $.realperson.alphanumeric,regenerate: '',length: 5});
	
	$('.realperson-challenge').click(function() { 
		window.location.reload(1);
	}); */
	
	$('#formKontak').submit(function(event) { 
	
	$.ajax({
		type: "POST",
		url: "<?=site_url("c_kontak/simpan_kontak/");?>",
		data: $('form').serialize(),
		success: function(data){
			if(data){
				alertify.success("Terima Kasih, pesan telah terkirim !");
				$('#kirim').prop('disabled', true);
					setTimeout(function(){
				   window.location.reload(1);
				}, 1000);
			}
			/* else {
				alertify.error("Kode tidak cocok !");
				$('#kirim').prop('disabled', true);
				setTimeout(function(){
				   window.location.reload(1);
				}, 1000);
			} */
		}
	});			
	//return true;
	event.preventDefault();
	});
});

</script>