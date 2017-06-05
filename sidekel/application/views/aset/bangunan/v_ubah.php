<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('aset/c_bangunan/update_bangunan', $attributes); 
?>
<fieldset>
<input type="hidden" value="<?= $bangunan->id_aset_bangunan?>" name="id_aset_bangunan"/>  
<!-- Form Name -->
	<legend></legend>
	
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="no_sertifikat">No Sertifikat</label>  
	  <div class="col-md-9">
	  <input id="no_sertifikat_sementara" value="<?= $tanah->no_sertifikat?>" name="no_sertifikat_sementara" type="text" placeholder="No Sertifikat Tanah" class="form-control input-md" required="" disabled>
	  <input id="no_sertifikat" value="<?= $tanah->no_sertifikat?>" name="no_sertifikat" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="deskripsi_tanah">Deskripsi Tanah</label>  
	  <div class="col-md-9">
	  <input id="deskripsi_tanah_sementara" value="<?= $tanah->deskripsi?>" name="deskripsi_tanah_sementara" type="text" placeholder="Deskripsi Tanah" class="form-control input-md" required="" disabled >
	  <input id="deskripsi_tanah" value="<?= $tanah->deskripsi?>" name="deskripsi_tanah" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>

<legend></legend>
	<div class="form-group">
	<label class="col-md-3 control-label" for="no_imb">Nomor IMB</label>
		<div class="col-md-9">
		<input class="form-control input-md" value="<?= $bangunan->no_imb?>" type="text" name="no_imb" placeholder="contoh: 1107.06534.6693 " id="no_imb" size="30" required />           
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Deskripsi Bangunan</label>
		<div class="col-md-9">
		<input class="form-control input-md" value="<?= $bangunan->deskripsi?>" type="text" name="deskripsi" placeholder="Deskripsi" id="no_imb" size="30" required />             
		<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-3 control-label" for="luas">Luas Bangunan</label>
		<div class="col-md-9">
		<input class="form-control input-md" value="<?= $bangunan->luas?>" type="text" name="luas" id="luas" placeholder="Ha (contoh: 15.5)" onkeypress='validate(event)' size="30" required /> 
		<span class="help-block"></span>
		</div>
	</div>	
	<div class="form-group">
		<label class="col-md-3 control-label" for="id_kepemilikan_aset">Kepemilikan </label>
        <div class="col-md-9">         
         <?php $id = 'id="id_kepemilikan_aset" class="form-control input-md" required';
				echo form_dropdown('id_kepemilikan_aset',$kepemilikan,$bangunan->id_kepemilikan_aset,$id)?>
		 <span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="tgl_bangun">Tanggal Bangun</label> 
        		
		<div class="col-md-9">
			<div id="datepicker" class="input-group date" >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<input placeholder="Tgl-Bln-Thn" type="text" value="<?= date('d-m-Y', strtotime($bangunan->tgl_bangun))?>" name="tgl_bangun" id="tgl_bangun" class="form-control input-md" readonly="readonly">
			</div>
			<span class="help-block"><?php echo form_error('tgl_bangun', '<p class="field_error">','</p>')?></span>
		</div>
	</div>
		
	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>aset/c_bangunan'"/>
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
	document.getElementById("a-data-bangunan").className = "collapsed active";
	
	document.getElementById("bangunan").className = "collapsed";

	var d = document.getElementById("nav-bangunan");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
    
	
});

</script>

