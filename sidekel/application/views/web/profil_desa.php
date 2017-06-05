<div class="container">
<h1>Profil Desa</h1>
	<legend></legend>
<div id="tabs-container">
    <ul class="tabs-menu">
        <li class="current"><a href="#tab-1">Sejarah Desa</a></li>
        <li><a href="#tab-2">Demografi Desa</a></li>
        <li><a href="#tab-3">Visi Misi Desa</a></li>
    </ul>
    <div class="tab">
        <div id="tab-1" class="tab-content">
		<?php 	
			$isi_s = $sejarah->isi_sejarah; 
			$banner_s = $sejarah->foto_banner; 
			$tempWaktu_s = $sejarah->waktu;
			$tanggal_s = date("d", strtotime($tempWaktu_s));
			$bulan_s = date("n", strtotime($tempWaktu_s));
			$tahun_s = date("Y", strtotime($tempWaktu_s));
			$nama_s = $sejarah->nama_pengguna;
			$jam_s = date("G:i:s", strtotime($tempWaktu_s));
			$namabulan_s = array("","Januari","Februari","Maret","April","Mei","Juni",
			"Juli","Agustus","September","Oktober","November","Desember");
		?>	
        <h3>Sejarah Desa</h3>
		<legend></legend>
		<img id="displayPhoto" src='<?php echo site_url($banner_s);?>' style="width:100%; margin-bottom: 10px"> 
		<p>
			<?php echo $isi_s;?>	
			<br>
			<b>Ditulis Oleh </b>: 
			<?php echo $nama_s; ?>, 
			<?php echo $tanggal_s." ".$namabulan_s[$bulan_s]." ".$tahun_s;?>,
			<?php echo $jam_s?> WIB			
		</p>
        </div>
		
		<div id="tab-2" class="tab-content">
			<?php 	
				$isi_d = $demografi->isi_demografi; 	
				$banner_d = $demografi->foto_banner; 
				$tempWaktu_d = $demografi->waktu;
				$tanggal_d = date("d", strtotime($tempWaktu_d));
				$bulan_d = date("n", strtotime($tempWaktu_d));
				$tahun_d = date("Y", strtotime($tempWaktu_d));
				$nama_d = $demografi->nama_pengguna;
				$jam_d = date("G:i:s", strtotime($tempWaktu_d));
				$namabulan_d = array("","Januari","Februari","Maret","April","Mei","Juni",
				"Juli","Agustus","September","Oktober","November","Desember");
			?>
			<h3>Demografi Desa</h3>
			<legend></legend>
			<img id="displayPhoto" src='<?php echo site_url($banner_d);?>' style="width:100%; margin-bottom: 10px"> 
			
			<div class="panel panel-success">
				<div class="panel-heading">
					<h4 class="uppercase" style="color:#3C3C3C">1. Keadaan Umum Wilayah Desa</h4>
				</div>
				<div class="panel-body">
					<div class="box">
						<div class="box-content">
							<div class="col-md-12">
								<?php echo $isi_d;?>		
							</div>						
						</div>
					</div>
				</div>
			</div>
		
			<div class="panel panel-success">
				<div class="panel-heading">
					<h4 class="uppercase" style="color:#3C3C3C">2. Gambaran Demografis Desa</h4>
				</div>
				<div class="panel-body">
					<div class="box">
						<div class="box-content">
							<div class="col-md-12">
								<span><h4 style="color:#3C3C3C">a. Kependudukan</h4></span>
								<table class="table table-bordered" style="width:100%">
									<tr style = "background-color : #F6F2FC">
										<th width="2%" align="center">No</th>
										<th width="10%" style="text-align:center;">Statistik</th>		
										<th width="10%" style="text-align:center;">Laki-Laki</th>		
										<th width="10%" style="text-align:center;">Perempuan</th>
										<th width="5%" style="text-align:center;">Jumlah</th>
									</tr>
									
									<?php
										$rows = $penduduk;
										$count = 0;
										$totalLaki = 0;
										$totalPerempuan = 0;
										$total = 0;
										$warna = '';
										foreach($rows as $row)
										{
											$count++;
											if($count%2==0){$warna='#FDFBFF';}
											else{$warna='#FBF9FF';}
											echo'
											<tr style = "background-color : '.$warna.'">	
												<td>'.$count.'</td>
												<td style="text-align:center;">'.$row->jenis.'</td>				
												<td style="text-align:center;">'.$row->laki.'</td>
												<td style="text-align:center;">'.$row->perempuan.'</td>
												<td style="text-align:center;">'.$row->jumlah.'</td>
											<tr>
											';	
											$totalLaki = $totalLaki + $row->laki;		
											$totalPerempuan = $totalPerempuan + $row->perempuan;		
											$total = $total + $row->jumlah;			
										}
									?>
									<tr style = "background-color : #F6F2FC">
									  <td colspan="2" style="text-align:right;">Total</td>
									  <td style="text-align:center;"><?php echo $totalLaki;	?></td>
									  <td style="text-align:center;"><?php echo $totalPerempuan;?></td>
									  <td style="text-align:center;"><?php echo $total;	?></td>
									</tr>
								</table>
							</div>

							<!---------------------------------------->
							<div class="col-md-12">
								<span><h4 style="color:#3C3C3C">B. Kepala Keluarga</h4></span>
								<table class="table table-bordered" style="width:100%">
									<tr style = "background-color : #F6F2FC">
										<th width="2%" align="center">No</th>
										<th width="10%" style="text-align:center;">Statistik</th>		
										<th width="10%" style="text-align:center;">Laki-Laki</th>		
										<th width="10%" style="text-align:center;">Perempuan</th>
										<th width="5%" style="text-align:center;">Jumlah</th>
									</tr>
									
									<?php
										$rows = $keluarga;
										$count = 0;
										$totalLaki = 0;
										$totalPerempuan = 0;
										$total = 0;
										$warna = '';
										foreach($rows as $row)
										{
											$count++;
											if($count%2==0){$warna='#FDFBFF';}
											else{$warna='#FBF9FF';}
											echo'
											<tr style = "background-color : '.$warna.'">	
												<td>'.$count.'</td>
												<td style="text-align:center;">'.$row->jenis.'</td>				
												<td style="text-align:center;">'.$row->laki.'</td>
												<td style="text-align:center;">'.$row->perempuan.'</td>
												<td style="text-align:center;">'.$row->jumlah.'</td>
											<tr>
											';	
											$totalLaki = $totalLaki + $row->laki;		
											$totalPerempuan = $totalPerempuan + $row->perempuan;		
											$total = $total + $row->jumlah;			
										}
									?>
									<tr style = "background-color : #F6F2FC">
									  <td colspan="2" style="text-align:right;">Total</td>
									  <td style="text-align:center;"><?php echo $totalLaki;	?></td>
									  <td style="text-align:center;"><?php echo $totalPerempuan;?></td>
									  <td style="text-align:center;"><?php echo $total;	?></td>
									</tr>
								</table>
							</div>
								
						</div>
					</div>
				</div>
			</div>
			<p>
				<b>Ditulis Oleh </b>: 
				<?php echo $nama_d; ?>, 
				<?php echo $tanggal_d." ".$namabulan_d[$bulan_d]." ".$tahun_d;?>,
				<?php echo $jam_d?> WIB
			</p>	
		</div>
		
        <div id="tab-3" class="tab-content">
			<?php 	
				$isi_v = $visimisi->isi_visi_misi; 
				$banner_v = $visimisi->foto_banner; 
				$tempWaktu_v = $visimisi->waktu;
				$tanggal_v = date("d", strtotime($tempWaktu_v));
				$bulan_v = date("n", strtotime($tempWaktu_v));
				$tahun_v = date("Y", strtotime($tempWaktu_v));
				$nama_v = $visimisi->nama_pengguna;
				$jam_v = date("G:i:s", strtotime($tempWaktu_v));
				$namabulan_v = array("","Januari","Februari","Maret","April","Mei","Juni",
				"Juli","Agustus","September","Oktober","November","Desember");
			?>
			<h3>Visi Misi Desa</h3>
			<legend></legend>
			<img id="displayPhoto" src='<?php echo site_url($banner_v);?>' style="width:100%; margin-bottom: 10px"> 
			<p>
				<?php echo $isi_v;?>	
				<br>
				<b>Ditulis Oleh </b>: 
				<?php echo $nama_v; ?>, 
				<?php echo $tanggal_v." ".$namabulan_v[$bulan_v]." ".$tahun_v;?>,
				<?php echo $jam_v?> WIB			
			</p>
		</div>
    </div>
</div>
</div>

	
<script>
	$(document).ready(function(){  
		document.getElementById("displayPhoto").src = <?php echo site_url($sejarah);?>;
		});
</script>
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
	});
</script>

<script type="text/javascript" charset="utf-8">			
	function nav_active(){
	var r = document.getElementById("nav-home");
	r.className = "";

	var d = document.getElementById("nav-profile");
	d.className = d.className + "active";
	}
</script>



	