<div class="container">
<legend><h1>Artikel</h1></legend>
	<div class="row">
		<div class="col-md-12">
		<?php  
			$judul = '';
			$isi = '';
			foreach($artikel as $artikel)
			{
				$id = $artikel->id_artikel;
				$judul_temp = $artikel->judul_artikel;
					if(strlen($judul_temp)<60)
					{
						$judul = $judul_temp;
					}
					else
					{							
						$judul = substr($judul_temp,0,60).' ...';
					}
				$isi_temp = $artikel->isi_artikel;
					if(strlen($isi_temp)<600)
					{
						$isi = $isi_temp;
					}
					else
					{							
						$isi = substr($isi_temp,0,600).' ...';
					}
				$isi = substr($isi_temp,0,600).' ...';
				//$isi = $artikel->isi_artikel;
				$penulis = $artikel->penulis;
				$thumb = $artikel->thumb;
				$hari = date("d", strtotime($artikel->waktu));
				$bulan = date("M", strtotime($artikel->waktu));
				$tahun = date("Y", strtotime($artikel->waktu));
				$waktu = date("G:i", strtotime($artikel->waktu));
				$kategori = $artikel->kategori;
				
		?>
		
			<div class="artikel">
				<div class="row">
					<div class="col-lg-2 col-md-2">
						<div class="tgl-artikel">
							<img src=<?= site_url($thumb);?> alt="" style="height:auto; width:100%;">
							<span class="bln"><b><?=$hari;?></b> <?=$bulan;?> <b><?=$tahun;?></b></span>
							<span class="penulis">Penulis: <b><?=$penulis;?></b></span>
						</div>
					</div>
					<div class="col-lg-10 col-md-10">
						<div class="isi-artikel">	
							<span class="judul"><?=$judul;?></span>
							<label class="label label-warning"><i class="fa fa-tags"></i> Kategori: <?=$kategori;?></label>
							<span class="isian-berita-detail"><?=$isi;?></span>
						</div>
						<a class="btn btn-default btn-sm btn-flat" href="<?php echo site_url('web/c_artikel/get_detail_artikel/'.$id);?>">Selengkapnya</a>	
					</div>
				</div>
			</div>
		<?php
			}
		?>
		</div>
		<div class="col-md-12">
		<div class="yeyeye">
		<?= $this->pagination->create_links(); ?>
		</div>
		</div>
		
	</div>
</div>
<script>
	$(document).ready(function(){  
			document.getElementById("displayPhoto").src = <?php echo site_url($artikel);?>;
			});
</script>
<script type="text/javascript" charset="utf-8">			
	function nav_active(){
	var r = document.getElementById("nav-home");
	r.className = "";

	var d = document.getElementById("nav-artikel");
	d.className = d.className + "active";
	}
</script>