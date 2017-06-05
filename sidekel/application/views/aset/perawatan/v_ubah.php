<h3><?= $page_title ?></h3>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('aset/c_perawatan/update_perawatan', $attributes); 
?>
<fieldset>
<input type="hidden" value="<?= $perawatan->id_aset_perawatan_bgn?>" name="id_aset_perawatan_bgn"/>  
<!-- Form Name -->
	<legend></legend>
		
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="no_imb">No IMB</label>  
	  <div class="col-md-9">
	  <input id="no_imb_sementara" value="<?= $bangunan->no_imb?>" name="no_imb_sementara" type="text" placeholder="No IMB" class="form-control input-md" required="" disabled>
	  <input id="no_imb" value="<?= $bangunan->no_imb?>" name="no_imb" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="deskripsi_bangunan">Nama Bangunan</label>  
	  <div class="col-md-9">
	  <input id="deskripsi_bangunan_sementara" value="<?= $bangunan->deskripsi?>" name="deskripsi_bangunan_sementara" type="text" placeholder="Nama Bangunan" class="form-control input-md" required="" disabled >
	  <input id="deskripsi_bangunan" value="<?= $bangunan->deskripsi?>" name="deskripsi_bangunan" type="hidden" class="form-control input-md" >
	  <span class="help-block"></span>  
	  </div>
	</div>

<legend></legend>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="tgl_bangun">Tanggal Perawatan</label> 
        
		<div class="col-md-9">
			<div id="datepicker" class="input-group date" >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<input placeholder="Tgl-Bln-Thn" type="text" value="<?= date('d-m-Y', strtotime($perawatan->tgl_perawatan))?>" name="tgl_perawatan" id="tgl_perawatan" class="form-control input-md" readonly="readonly">
			</div>
			<span class="help-block"><?php echo form_error('tgl_perawatan', '<p class="field_error">','</p>')?></span>
		</div>
	</div>
		
		
	<div class="form-group">
	<label class="col-md-3 control-label" for="deskripsi">Deskripsi Perawatan</label>
		<div class="col-md-9">
		<textarea name="deskripsi" placeholder="Deskripsi Perawatan" class="form-control" rows="3" required><?= $perawatan->deskripsi?></textarea>         
		<span class="help-block"></span>
		</div>
	</div>
		
	
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
			<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>aset/c_perawatan'"/>
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

	var d = document.getElementById("nav-perawatan");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>

