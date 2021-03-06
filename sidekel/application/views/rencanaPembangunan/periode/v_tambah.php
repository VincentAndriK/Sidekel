<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('rencanaPembangunan/c_periode/simpan_periode'); ?>
<fieldset>
	<legend></legend>

	<!-- Text input-->	
	<div class="form-group">
		 <label class="col-md-3 control-label" for="periode_awal">Periode Awal</label>
		<div class="col-md-9">
        <span class="help-block">
		 <?php $periode_awal = 'id="periode_awal" class="form-control" onchange="onPeriode();" required';
				echo form_dropdown('periode_awal',$year,'',$periode_awal)?> 
		
		<?php echo form_error('periode_awal', '<p class="field_error">','</p>')?>	
		</span>
		</div>
	</div>
	
	
	<div class="form-group">
    	 <label  class="col-md-3 control-label" for="nama_rw">Periode Akhir </label>
        <div class="col-md-9">
			<input class="form-control input-md" type="text" name="periode_akhir" id="periode_akhir" readonly/>
		</div>		
	</div>
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>rencanaPembangunan/c_periode'"/>
</p>

<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_per").className = "collapsed active";
	
	document.getElementById("pustaka_per").className = "collapsed";

	var d = document.getElementById("nav-periode");
	d.className = d.className + "active";
	}

 function onPeriode() {
    var periode_awal = parseInt(document.getElementById("periode_awal").value);
	var periode_akhir = periode_awal + 5;
    document.getElementById("periode_akhir").value =  periode_akhir;
}
// very simple to use!
$(document).ready(function() {
  nav_active();
  
});

</script>
