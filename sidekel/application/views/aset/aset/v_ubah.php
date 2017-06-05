<h3><?= $page_title ?></h3>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('aset/c_aset/update_aset', $attributes); 
?>
<fieldset>
<input type="hidden" value="<?= $aset->id_aset_master?>" name="id_aset_master"/>  

<!-- Form Name -->
	<legend></legend>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="nama_ruangan">Nama Ruangan</label>  
	  <div class="col-md-9">
	  <input id="nama_ruangan_sementara" value="<?= $ruangan_bangunan->nama_ruangan?>" name="nama_ruangan_sementara" type="text" placeholder="Nama Ruangan" class="form-control input-md" required="" disabled>
	  <input id="nama_ruangan" value="<?= $ruangan_bangunan->nama_ruangan?>" name="nama_ruangan" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="deskripsi_bangunan">Nama Bangunan</label>  
	  <div class="col-md-9">
	  <input id="deskripsi_bangunan_sementara" value="<?= $ruangan_bangunan->nama_bangunan?>" name="deskripsi_bangunan_sementara" type="text" placeholder="Nama Bangunan" class="form-control input-md" required="" disabled >
	  <input id="deskripsi_bangunan" name="deskripsi_bangunan" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>

<legend></legend>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="no_aset">Nomor Aset</label>
		<div class="col-md-9">
		<input class="form-control input-md" value="<?= $aset->no_aset?>" type="text" disabled name="no_aset" placeholder="Nomor Aset" id="no_aset" size="30" />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="nama">Nama</label>
		<div class="col-md-9">
		<input class="form-control input-md" value="<?= $aset->nama?>" type="text" name="nama" placeholder="Nama" id="nama" size="30" required />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="merk">Merk</label>
		<div class="col-md-9">
		<input class="form-control input-md" value="<?= $aset->merk?>" type="text" name="merk" placeholder="Merk" id="merk" size="30" required />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="tgl_beli">Tanggal Beli</label> 
        
		<div class="col-md-9">
			<div id="datepicker" class="input-group date" >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<input placeholder="Tgl-Bln-Thn" type="text" value="<?= date('d-m-Y', strtotime($aset->tgl_beli))?>" name="tgl_beli" id="tgl_beli" class="form-control input-md" readonly="readonly">
			</div>
			<span class="help-block"><?php echo form_error('tgl_beli', '<p class="field_error">','</p>')?></span>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_kategori_aset">Kategori </label>
        <div class="col-md-9">         
         <?php $id = 'id="id_kategori_aset" class="form-control input-md" required';
				echo form_dropdown('id_kategori_aset',$kategori,$aset->id_kategori_aset,$id)?>
		 <span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_kepemilikan_aset">Kepemilikan </label>
        <div class="col-md-9">         
         <?php $id = 'id="id_kepemilikan_aset" class="form-control input-md" required';
				echo form_dropdown('id_kepemilikan_aset',$kepemilikan,$aset->id_kepemilikan_aset,$id)?>
		 <span class="help-block"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_asal_aset">Asal Aset </label>
        <div class="col-md-9">         
         <?php $id = 'id="id_asal_aset" class="form-control input-md" required';
				echo form_dropdown('id_asal_aset',$asal,$aset->id_asal_aset,$id)?>
		 <span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">	
	 	<label class="col-md-3 control-label" for="ketersediaan">Ketersediaan</label>
        <div class="col-md-3">
        <div class="">
		<?php echo form_radio('ketersediaan', 'Ya', $aset->ketersediaan=='Ya'); ?> Ya
		</div>
		<div class="">
		<?php echo form_radio('ketersediaan', 'Tidak', $aset->ketersediaan=='Tidak'); ?> Tidak
		</div>
		</div>
	</div>
	
	<div class="form-group">	
	 	<label class="col-md-1 control-label" for="kondisi">Kondisi</label>
        <div class="col-md-3">
        <div class="">
		<?php echo form_radio('kondisi', 'Baik',  $aset->kondisi=='Baik'); ?> Baik
		</div>
		<div class="">
		<?php echo form_radio('kondisi', 'Tidak Baik',  $aset->kondisi=='Tidak Baik'); ?> Tidak Baik
		</div>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="spesifikasi">Spesifikasi</label>
		<div class="col-md-9">
		<textarea name="spesifikasi" placeholder="Spesifikasi" class="form-control" rows="3"><?= $aset->spesifikasi?></textarea>         
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="keterangan">Keterangan</label>
		<div class="col-md-9">
		<textarea name="keterangan" placeholder="contoh : (masa garansi) / (serial number) / (tgl expired)" class="form-control" rows="3"><?= $aset->keterangan?></textarea>         
		<span class="help-block"></span>
		</div>
	</div>
	
	
	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>aset/c_aset'"/>
		</div>
	</div>

<br>
</fieldset>
<?php echo form_close(); ?>
 <!-- Date Picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url(); ?>assetku/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>	

  $(function() {
   $("#datepicker").datepicker({ 
		autoclose: true, 
		todayHighlight: true,
		format: "dd-mm-yyyy"
	});
  });
 
  
</script>

<script>


function nav_active(){
	document.getElementById("a-data-aset").className = "collapsed active";
	
	document.getElementById("aset").className = "collapsed";

	var d = document.getElementById("nav-aset");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>

