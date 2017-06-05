<link rel="stylesheet" href="<?php echo site_url('assetku/css/style_blue.css');?>">

<div class="container">
<legend></legend>
	<div class="row">
		<div class="col-sm-12">	
			<?php 	
				$idberita = $berita->id_berita;
				$judul = $berita->judul_berita;
				$gbr = $berita->gambar;
				$isi = $berita->isi_berita; 
				$tempTanggal = date("d-M-Y", strtotime($berita->waktu));	
				$tempWaktu = date("G:i", strtotime($berita->waktu));	
				$nama = $berita->nama_pengguna;
				$penulis = $berita->penulis;
				if($penulis == null)
				{
					$penulis =  $nama;
				}
				else
				{
					$penulis;
				}
				$jw = $berita->is_masyarakat;
			?>
			<div class="berita-detail-new">
				<div class="heading-berita-detail">
					<span class="judul-berita-detail"><b><?=$judul;?></b></span>
					<img src=<?= site_url($gbr);?> alt="" style="height:auto; width:100%;">
					<span class="bln-berita-detail"><i style="color:#fff" class="fa fa-clock-o"></i> <?=$tempWaktu?>, <i style="color:#fff" class="fa fa-calendar"></i>  <b><?=$tempTanggal?></b></span>
					<span class="penulis-berita-detail"><b>
					<?php 
					if($jw == 'Ya')
					{
						echo '<i style="color:#f1c40f" class="fa fa-star-o"></i> ';
					}
					else
					{
						echo '<i style="color:#00A65A" class="fa fa-pencil"></i> ';
					}
					?>
					</b><?= $penulis;?></span>
				</div>
				<div class="body-berita-detail">
					<span class="isian-berita-detail"><?=$isi;?></span>
				</div>
			</div>
			<br>
		</div>
	</div>
</div>

	
<script>
$(document).ready(function(){  
	document.getElementById("displayPhoto").src = <?php echo site_url($berita);?>;
});
</script>

	