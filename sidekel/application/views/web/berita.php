<div class="container">
<legend><h1>Berita</h1></legend>
			<div class="row">		
			<?php
			$i=0;
			$judul_berita='';
			foreach($berita as $berita)
			{
				$i++;
				$idberita = $berita->id_berita;
				$judul = $berita->judul_berita;
				$slug = url_title($berita->judul_berita, 'dash', true);
				if(strlen($judul)<40)
					{
						$judul_berita = $judul.'<br><br>';
					}
				else if(strlen($judul)<85 AND strlen($judul)>40)
					{
						$judul_berita = $judul;
					}
				else
					{							
						$judul_berita = substr($judul,0,85).'...';
					}
				$gbr = $berita->thumb;
				$isi_berita = substr($berita->isi_berita,0,460);
				//$isi = $berita->isi_berita;
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
				<a href="<?php echo site_url('web/c_berita/get_detail_berita/'.$idberita.'/'.$slug);?>" class="link-berita">
					<div class="col-sm-4" >
						<div class="bg berita-content">
							<div class="heading-berita">
								<img src=<?= site_url($gbr);?> title="<?=$judul?>" style="height:auto; width:100%;">
								<span class="judul-berita">	<?=$judul_berita;?></span>
								<span class="bln-berita"><i style="color:#fff" class="fa fa-clock-o"></i> <?=$tempWaktu?>, <i style="color:#fff" class="fa fa-calendar"></i>  <b><?=$tempTanggal?></b></span>
								<span class="penulis-berita"><b>
								<?php 
								if($jw == 'Ya')
								{
									echo '<i style="color:#f1c40f" class="fa fa-star-o"></i> ';
								}
								else
								{
									echo '<i style="color:#" class="fa fa-pencil"></i> ';
								}
								?>
								</b><?= $penulis;?>
								</span>
							</div>
							<div class="text-berita">
								<?php echo $isi_berita;?>
							</div>
							<div class="text-berita-next">
							<legend></legend>
								<h6>Selengkapnya &raquo;</h6>
							</div>
						</div>
					</div>
				</a>
				<?php
			}
			?>	
				<div class="col-sm-12">
				<!-- <button type="button" class="btn btn-berita btn-block">MEMUAT BERITA SELANJUTNYA</button> -->
				<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
			</div>
<legend></legend>
	
<script>
	$(document).ready(function(){  
			document.getElementById("displayPhoto").src = <?php echo site_url($berita);?>;
			});
</script>


<script type="text/javascript" charset="utf-8">			
	function nav_active(){
	var r = document.getElementById("nav-home");
	r.className = "";

	var d = document.getElementById("nav-berita");
	d.className = d.className + "active";
	}
</script>