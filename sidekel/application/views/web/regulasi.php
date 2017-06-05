<div class="container">
<h1>Regulasi</h1>	
<legend></legend>
		<div class="row">
		<?php
			$i=0;
			foreach($regulasi as $r)
			{
			$i++;
		?>
			<?php 	
			$id_regulasi = $r->id_regulasi;
			$judul_regulasi = $r->judul_regulasi;
			$isi_regulasi = $r->isi_regulasi;
			$file_regulasi = $r->file_regulasi;
			if(strlen($judul_regulasi)>40)
			{
				$judul_regulasi = substr($judul_regulasi,0,40).'...';
			}
			?>
			<div class="col-sm-6" >
				<div class="regulasi-content">
				<div class="regulasi-content-text">
					<legend><h3><?php echo $judul_regulasi;?></h3></legend>
					<p><?php echo $isi_regulasi;?></p>
					 <button id="simpan" name="simpan" class="btn btn-info" onclick="location.href='<?php echo site_url($file_regulasi);?>'" >Unduh</button>
					 
    			</div>
				</div>
			</div>
		<?php
			}
			?>
	</div>
</div>
	<script type="text/javascript" charset="utf-8">			
			 function nav_active(){
				var r = document.getElementById("nav-home");
				r.className = "";
				
				var d = document.getElementById("nav-regulasi");
				d.className = d.className + "active";
				}
	</script>