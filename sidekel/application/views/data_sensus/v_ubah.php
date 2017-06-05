<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('indikatorkesejahteraan/c_sensus/update_data_sensus', $attributes); 
?>
<fieldset>
<legend></legend>
	<!--<input type="hidden" name="id_pengguna" id="id_pengguna" value="<?= $hasil->id_pengguna ?>" size="20" /> -->
	
	<div class="form-group">
    	 <label class="col-md-3 control-label" for="tanggal_sensus">Tanggal Sensus</label> 
		 <div class="col-md-9">
			<div id="datepicker" class="input-group date" >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<input placeholder="Tgl-Bln-Thn" type="text" value="<?= date('j/m/Y',strtotime($hasil->tanggal_sensus))?>" name="tanggal_sensus" id="tanggal_sensus" class="form-control input-md" readonly="readonly">
			</div>
			<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
		<label  class="col-md-3 control-label" for="keterangan">Keterangan</label>
		<div class="col-md-9">
			<input   value="<?= $hasil->keterangan?>" id="keterangan" name="keterangan" type="text" 
			placeholder="keterangan" class="form-control input-md" required>
			<span class="help-block"><?php echo form_error('keterangan', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-9">
			<input  value="<?= $hasil->id_sensus?>" id="id_sensus" name="id_sensus" type="hidden" placeholder="id" class="form-control input-md">
			<span class="help-block"><?php echo form_error('id_sensus', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	

<div class="form-group">
		  <label class="col-md-0 control-label" for="simpan"></label>
		  <div class="col-md-9">
			<button id="simpan" name="simpan" class="btn btn-success">Simpan</button>
			<button id="batal" name="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_sensus'">Batal</button>
		  </div>
		</div>
</fieldset>
<br>
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
	
	document.getElementById("a-pengelola_sensus").className = "collapsed active";
	
	
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>