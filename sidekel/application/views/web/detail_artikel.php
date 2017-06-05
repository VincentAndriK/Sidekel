<div class="container">
<h1>Artikel</h1>	
<legend></legend>
	<div class="row">
		<div class="col-sm-12" >
			<?php 	
				$id = $artikel->id_artikel;
				$judul = $artikel->judul_artikel;
				$isi = $artikel->isi_artikel;
				$penulis = $artikel->penulis;
				$gambar = $artikel->gambar;
				$thumb = $artikel->thumb;
				$hari = date("d", strtotime($artikel->waktu));
				$bulan = date("M", strtotime($artikel->waktu));
				$tahun = date("Y", strtotime($artikel->waktu));
				$waktu = date("G:i", strtotime($artikel->waktu));
				$kategori = $artikel->kategori;
			?>
			<div class="artikel-detail-new">
				
				<div class="heading-artikel-detail">
					<span class="judul-artikel-detail"><b><?=$judul;?></b></span>
					<img src=<?= site_url($gambar);?> alt="" style="height:auto; width:100%;">
					
					<span class="bln-artikel-detail">
							<i style="color:#fff" class="fa fa-tags"></i> <b>Kategori: <?=$kategori;?></b>
							
					</span>
					<span class="penulis-artikel-detail">
						<i style="color:#00A65A" class="fa fa-calendar"></i> <?= $hari.'-'.$bulan.'-'.$tahun ;?>, 
						<i style="color:#00A65A" class="fa fa-pencil"></i> <b><?= $penulis ;?></b>
					</span>
				</div>
				<div class="body-artikel-detail">
					<span class="isian-artikel-detail"><?=$isi;?></span>
				</div>
				<div class="footer-artikel-detail">
					
					<div class="text-center">
						<ul class="social-links circle">
							<li class="facebook"><a  style="cursor: pointer;" target="_blank" onclick="fbShare('<?php echo current_url(); ?>', '<?php echo $judul; ?>', 'Facebook share popup', '<?=site_url($gambar);?>', 520, 350)" ><i class="fa fa-facebook"></i></a></li>
							<li class="twitter"><a  style="cursor: pointer;" target="_blank" onclick="twitterShare('<?php echo current_url(); ?>', '<?php echo $judul; ?>', 520, 350)"  title="Twitter"><i class="fa fa-twitter"></i></a></li>
							<li class="googleplus"><a  style="cursor: pointer;" target="_blank" onclick="gplusShare('<?php echo current_url(); ?>', '<?php echo $judul; ?>', 520, 350)" style="cursor:hand;" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	
<script>
	$(document).ready(function(){  
			document.getElementById("displayPhoto").src = <?php echo site_url($berita);?>;
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
	
	<script>
					    function fbShare(url, title, descr, image, winWidth, winHeight) {
					        var winTop = (screen.height / 2) - (winHeight / 2);
					        var winLeft = (screen.width / 2) - (winWidth / 2);
					        window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
					    }
					    
					    function twitterShare(url, title, winWidth, winHeight) {
					        var winTop = (screen.height / 2) - (winHeight / 2);
					        var winLeft = (screen.width / 2) - (winWidth / 2);
					        window.open('http://twitter.com/intent/tweet?status=' + title+" "+ url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
					    }
					    function gplusShare(url, title, winWidth, winHeight) {
					        var winTop = (screen.height / 2) - (winHeight / 2);
					        var winLeft = (screen.width / 2) - (winWidth / 2);
					        window.open('https://plus.google.com/share?url='+ url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
					    }
					</script>
	
	