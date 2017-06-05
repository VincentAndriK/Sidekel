<div class="container" style="margin-top:-60px;">

<h2>Kabar Terbaru</h2>	
<legend></legend>
<div id="tabs-container">
    <ul class="tabs-menu">
        <li class="current"><a href="#tab-1">Semua Berita</a></li>
        <li><a href="#tab-2">Berita Desa</a></li>
        <li><a href="#tab-3">Jurnalisme Warga</a></li>
        <li><a href="#tab-4">Artikel</a></li>
    </ul>
    <div class="tab">
		<div id="tab-1" class="tab-content">
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
									echo '<i style="color:" class="fa fa-pencil"></i> ';
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
				
			</div>
		</div>
		<div id="tab-2" class="tab-content">
			<div class="row">		
			<?php
				$i=0;
				$judul_warga = '';
				foreach($berita_warga as $berita_warga)
				{
					$i++;
					$idberita_w = $berita_warga->id_berita;
					$judul_w = $berita_warga->judul_berita;
					$slug_warga = url_title($berita_warga->judul_berita, 'dash', true);
					if(strlen($judul_w)<40)
					{
						$judul_warga = $judul_w.'<br><br>';
					}
					else if(strlen($judul_w)<85 AND strlen($judul_w)>40)
					{
						$judul_warga = $judul_w;
					}
					else
					{							
						$judul_warga = substr($judul_w,0,85).'...';
					}
					$gbr_w = $berita_warga->thumb;
					$isi_berita_w = substr($berita_warga->isi_berita,0,460);
					//$isi = $berita_warga->isi_berita;
					$tempTanggal_w = date("d-m-Y", strtotime($berita_warga->waktu));	
					$tempWaktu_w = date("G:i", strtotime($berita_warga->waktu));	
					$nama_w = $berita_warga->nama_pengguna;
					$penulis_w = $berita_warga->penulis;
					if($penulis_w == null)
					{
						$penulis_w =  $nama_w;
					}
					else
					{
						$penulis_w;
					}
			?>
				<a href="<?php echo site_url('web/c_berita/get_detail_berita/'.$idberita_w.'/'.$slug_warga);?>" class="link-berita">
					<div class="col-sm-4" >
						<div class="bg berita-content">
							<div class="heading-berita">
								<img src=<?= site_url($gbr_w);?> title="<?=$judul_w?>" style="height:auto; width:100%;">
								<span class="judul-berita">	<?=$judul_warga;?></span>
								<span class="bln-berita"><i style="color:#fff" class="fa fa-clock-o"></i> <?=$tempWaktu_w?>, <i style="color:#fff" class="fa fa-calendar"></i>  <b><?=$tempTanggal_w?></b></b></span>
								<span class="penulis-berita"><b>
								<i style="color:" class="fa fa-pencil"></i>
								</b><?= $penulis_w;?>
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
			</div>
		</div>
		<div id="tab-3" class="tab-content">
			<div class="row">		
				<?php
				$i=0;
				$judul_jurnal = '';
				foreach($jurnal_warga as $jurnal_warga)
				{
					$i++;
					$idberita_j = $jurnal_warga->id_berita;
					$judul_j = $jurnal_warga->judul_berita;
					$slug_j = url_title($jurnal_warga->judul_berita, 'dash', true);
					if(strlen($judul_j)<40)
					{
						$judul_jurnal = $judul_j.'<br><br>';
					}
					else if(strlen($judul_j)<85 AND strlen($judul_j)>40)
					{
						$judul_jurnal = $judul_j;
					}
					else
					{							
						$judul_jurnal = substr($judul_j,0,85).'...';
					}
					$gbr_j = $jurnal_warga->thumb;
					$isi_berita_j = substr($jurnal_warga->isi_berita,0,460);
					//$isi = $berita_warga->isi_berita;
					$tempTanggal_j = date("d-m-Y", strtotime($jurnal_warga->waktu));	
					$tempWaktu_j = date("G:i", strtotime($jurnal_warga->waktu));	
					$nama_j = $jurnal_warga->nama_pengguna;
					$penulis_j = $jurnal_warga->penulis;
					if($penulis_j == null)
					{
						$penulis_j =  $nama_j;
					}
					else
					{
						$penulis_j;
					}
					?>
				<a href="<?php echo site_url('web/c_berita/get_detail_berita/'.$idberita_j.'/'.$slug_j);?>" class="link-berita">
					<div class="col-sm-4" >
						<div class="bg berita-content">
							<div class="heading-berita">
								<img src=<?= site_url($gbr_j);?> title="<?=$judul_j?>" style="height:auto; width:100%;">
								<span class="judul-berita">	<?=$judul_jurnal;?></span>
								<span class="bln-berita"><i style="color:#fff" class="fa fa-clock-o"></i> <?=$tempWaktu_j?>, <i style="color:#fff" class="fa fa-calendar"></i>  <b><?=$tempTanggal_j?></b></span>
								<span class="penulis-berita"><b>
								<?php
								?>
								<i style="color:#f1c40f" class="fa fa-star-o"></i>
								</b><?= $penulis_j;?>
								</span>
							</div>
							<div class="text-berita">
								<?php echo $isi_berita_j;?>
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
			</div>
		</div>
		<div id="tab-4" class="tab-content">
			<div class="row">
			<?php  
			$judul = '';
			$isi = '';
			foreach($artikel as $artikel)
			{
				$id = $artikel->id_artikel;
				$judul_temp = $artikel->judul_artikel;
				$slug_artikel = url_title($artikel->judul_artikel, 'dash', true);
					if(strlen($judul_temp)<85)
					{
						$judul = $judul_temp;
					}
					else
					{							
						$judul = substr($judul_temp,0,85).' ...';
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
							<label class="label label-success"><i class="fa fa-tags"></i> Kategori: <?=$kategori;?></label>
							<span class="isian"><?=$isi;?></span>
						</div>
							<a class="btn btn-default btn-sm btn-flat" href="<?php echo site_url('web/c_artikel/get_detail_artikel/'.$id.'/'.$slug_artikel);?>">Selengkapnya</a>	
						</div>
					</div>
				</div>
			<?php
			}
			?>
			</div>
		</div>
	</div>
</div>
<br>

	<div style="margin-top:-15px;">
	
	<h2>Statistik Desa</h2>
	<legend></legend>
	<div class="row">			
		<div class="col-xs-12 col-md-6" id="kategori" style="margin: 0 auto;"></div>
		<div class="col-xs-12 col-md-6" id="detil" style="margin: 0 auto;"></div>
		<div class="col-xs-12 col-md-6" id="keluarga" style="margin: 0 auto;"></div>
		<div class="col-xs-12 col-md-6" id="penduduk" style="margin: 0 auto;"></div>
	</div>
	
	</div>
	<br>
	<div style="margin-top:-15px;">
	
		<link rel="stylesheet" href="<?php echo base_url();?>assetku/fancybox/jquery.fancybox.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetku/fancybox/helpers/jquery.fancybox-thumbs.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetku/fancybox/helpers/jquery.fancybox-buttons.js" />
		<h2>Galeri Terbaru</h2>
		<legend></legend>
		<section class="filter-section">
		<div class="row">
		
		</div>
	</section>
	<section class="portfolio-section port-col">
		<div class="container" style="background-color:#fff;">
			<div class="row">
				<div class="isotopeContainer">

				<?php
					foreach($konten_galeri as $kon)
					{
						if($kon->kategori == 'foto')
						{
						?>
							<div class="col-sm-3 isotopeSelector foto">
							   <article class="">
									<figure>
										<img src='<?php echo site_url($kon->url);?>' alt="" style="height:250px;">
										<div class="overlay-background">
											<div class="inner"></div>
										</div>
										<div class="overlay">
											<div class="inner-overlay">
												<div class="inner-overlay-content with-icons">
													<a title="<?=$kon->judul?>" class="fancybox-pop" rel="portfolio-1" href="<?php echo site_url($kon->url)?>"><i class="fa fa-search"></i></a>
													<!--<a href="#"><i class="fa fa-link"></i></a>-->
												</div>
											</div>
										</div>
									</figure>
									<div class="article-title"><a href="#"><?=$kon->judul?></a></div>
								</article>
							</div>
						<?php 
						}
						else
						{
							$a = $kon->url;
							$b = str_replace('https://www.youtube.com/watch?v=', "", $a);
						?>
							 <div class="col-sm-3 isotopeSelector video">
								<article class="">
									<figure>
										<img src="http://img.youtube.com/vi/<?=$b?>/0.jpg" alt="" style="height:250px;">
										<div class="overlay-background">
											<div class="inner"></div>
										</div>
										<div class="overlay">
											<div class="inner-overlay">
												<div class="inner-overlay-content with-icons">
													<a title="<?=$kon->judul?>" class="fancybox-pop" rel="portfolio-4 " href="https://www.youtube.com/watch?v=<?=$b?>"><i class="fa fa-play"></i></a>
												</div>
											</div>
										</div>
									</figure>
									<div class="article-title"><a href="#"><?=$kon->judul?></a></div>
								</article>
							</div>
						<?php    
						}
					}
				?>
				
				
			   
				
				</div>
			</div>
		</div>
	</section>
	<br>
	</div>
</div>
<!-- GALERI js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/fancybox/helpers/jquery.fancybox-media.js"></script>
<!--script type="text/javascript" src="<?php echo base_url(); ?>assetku/fancybox/helpers/jquery.fancybox-button.js"></script-->
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/isotope/isotope.min.js"></script>
<!-- GALERI js -->

<!-- modernizr js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/timeline/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/timeline/js/modernizr.js"></script>

<script>
	$(document).ready(function() {
		$(".tabs-menu a").click(function(event) {
			event.preventDefault();
			$(this).parent().addClass("current");
			$(this).parent().siblings().removeClass("current");
			var tab = $(this).attr("href");
			$(".tab-content").not(tab).css("display", "none");
			$(tab).fadeIn();
		});
		
		/*
|--------------------------------------------------------------------------
| Global myTheme Obj / Variable Declaration
|--------------------------------------------------------------------------
|
|
|
*/
	var myTheme = window.myTheme || {},
    $win = $( window );
/*
|--------------------------------------------------------------------------
| isotope
|--------------------------------------------------------------------------
|
|
|
*/
	myTheme.Isotope = function () {
	
		// 4 column layout
		var isotopeContainer = $('.isotopeContainer');
		if( !isotopeContainer.length || !jQuery().isotope ) return;
		$win.load(function(){
			isotopeContainer.isotope({
				itemSelector: '.isotopeSelector'
			});
		$('.isotopeFilters').on( 'click', 'a', function(e) {
				$('.isotopeFilters').find('.active').removeClass('active');
				$(this).parent().addClass('active');
				var filterValue = $(this).attr('data-filter');
				isotopeContainer.isotope({ filter: filterValue });
				e.preventDefault();
			});
		});
	
	};
/*
|--------------------------------------------------------------------------
| Fancybox
|--------------------------------------------------------------------------
|
|
|
*/
	myTheme.Fancybox = function () {
		//$(".fancybox-pop").attr('rel', 'media-gallery').fancybox({
		$(".fancybox-pop").fancybox({
			maxWidth	: 1500,
			maxHeight	: 1500,
			fitToView	: true,
			width		: '100%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'elastic',
			closeEffect	: 'none',
            arrows : false,
			helpers : {
					thumbs : {
						width  : 50,
						height : 50
					},
					media: {}, // requires to include media js file
					buttons: {} // requires to include buttons js and css files
				}
			
		});
	};	
/*
|--------------------------------------------------------------------------
| Functions Initializers
|--------------------------------------------------------------------------
|
|
|
*/
	myTheme.Isotope();
	myTheme.Fancybox();
	});
</script>
<script>
$(document).ready(function(){ 
	
	});
</script>	
<script type="text/javascript" charset="utf-8">			
	function nav_active(){
	
		var d = document.getElementById("nav-home");
		d.className = d.className + "active";
		}
</script>
<script type="text/javascript">
$(function () {

   Highcharts.setOptions({
       colors: ['#f1c40f','#F39C12','#7CB833','#00C0EF','#008D4D','#005C92','#B13C2E','#00A3CB','#CF850F']
    });

	$('#keluarga').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Statistik Desa'
        },
        subtitle: {
            text: 'Berdasarkan Jenis Kelamin Kepala Keluarga'
        },
        xAxis: {
            categories: [
                'Kepala Keluarga'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Kepala Keluarga'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} KK</b></td></tr>',
            footerFormat: '</table>',
            shared: false,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Laki Laki',
            data: [
					<?php echo $jumlah_kk_laki ; ?>
				]

        }, {
            name: 'Perempuan',
            data: [
					<?php echo $jumlah_kk_perempuan ; ?>
				]

        } ]
		
    });
	
   $('#penduduk').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Grafik Statistik Desa'
        },
		subtitle: {
				text: 'Berdasarkan Jenis Kelamin Pendudukan'
		},
        tooltip: {
            //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			headerFormat: '<span style="font-size:10px">{point.key}: {point.percentage:.1f}%</span><table><br>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Jiwa</b></td></tr>',
            footerFormat: '</table>',
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: ''
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'sebanyak',
            data: [
					['L ',<?php echo $jumlah_penduduk_laki ; ?>],
					['P ',<?php echo $jumlah_penduduk_perempuan ; ?>]
						
				]            
       
	   }]
    });
	
	$('#kategori').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Potensi Ekonomi Desa'
        },
        subtitle: {
            text: 'Berdasarkan Jenis Lahan '
        },
        xAxis: {
            categories: [
                'Lahan'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Jenis</b></td></tr>',
            footerFormat: '</table>',
            shared: false,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
			<?php
				foreach($grafik_kategori as $key)
				{
					echo '{name:"'.$key->deskripsi. '",data:[' .$key->jumlah. ']},' ;
				}
			?>			
		]
		
    });
	
	 $('#detil').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Grafik Potensi Ekonomi Desa'
        },
		subtitle: {
				text: 'Berdasarkan Jenis Potensi Desa'
		},
        tooltip: {
            //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			headerFormat: '<span style="font-size:12px">{point.key}: {point.percentage:.1f}%</span><table><br>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} petak</b></td></tr>',
            footerFormat: '</table>',
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: '#00A65A'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'jumlah',
            data: [
					<?php
						foreach($grafik_detil as $key)
						{
							echo '["'.$key->deskripsi. '",' .$key->jumlah. '],' ;
						}
					?>						
				]            
       
	   }]
    });
});

	
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts-3d.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/exporting.js"></script>