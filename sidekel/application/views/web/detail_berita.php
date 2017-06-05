<div class="container">
<h1>Berita</h1>	
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
				<div class="footer-berita-detail">
					<div class="text-center">
						<ul class="social-links circle">
							<li class="facebook"><a  style="cursor: pointer;" target="_blank" onclick="fbShare('<?php echo current_url(); ?>', '<?php echo $judul; ?>', 'Facebook share popup', '<?=site_url($gbr);?>', 520, 350)" ><i class="fa fa-facebook"></i></a></li>
							<li class="twitter"><a  style="cursor: pointer;" target="_blank" onclick="twitterShare('<?php echo current_url(); ?>', '<?php echo $judul; ?>', 520, 350)"  title="Twitter"><i class="fa fa-twitter"></i></a></li>
							<li class="googleplus"><a  style="cursor: pointer;" target="_blank" onclick="gplusShare('<?php echo current_url(); ?>', '<?php echo $judul; ?>', 520, 350)" style="cursor:hand;" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
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


<script type="text/javascript" charset="utf-8">			
function nav_active(){
var r = document.getElementById("nav-home");
r.className = "";

var d = document.getElementById("nav-berita");
d.className = d.className + "active";
}
</script>
	
<script>
function fbShare(url, title, descr, image, winWidth, winHeight) {
	var winTop = (screen.height / 2) - (winHeight / 2);
	var winLeft = (screen.width / 2) - (winWidth / 2);
	window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'popup', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
}

function twitterShare(url, title, winWidth, winHeight) {
	var winTop = (screen.height / 2) - (winHeight / 2);
	var winLeft = (screen.width / 2) - (winWidth / 2);
	window.open('http://twitter.com/intent/tweet?status=' + title+" "+ url, 'popup', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
}
function gplusShare(url, title, winWidth, winHeight) {
	var winTop = (screen.height / 2) - (winHeight / 2);
	var winLeft = (screen.width / 2) - (winWidth / 2);
	window.open('https://plus.google.com/share?url='+ url, 'popup', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
}
</script>
	
	