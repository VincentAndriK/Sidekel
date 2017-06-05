<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('indikatorkesejahteraan/c_indikator_kesejahteraan/simpan_indikator_kesejahteraan'); ?>
<fieldset>
	<legend></legend>

	<!-- Text input-->
	<div class="form-group">
		<label  class="col-md-3 control-label" for="deskripsi">Deskripsi</label>
		<div class="col-md-9">
			<input   id="deskripsi" name="deskripsi" type="text" 
			placeholder="Deskripsi" class="form-control input-md" required>
			<span class="help-block"><?php echo form_error('deskripsi', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	
	<div class="form-group">
		<label  class="col-md-3 control-label" for="bobot">Bobot</label>
		<div class="col-md-9">
			<input   id="bobot" name="bobot" type="text" 
			placeholder="Bobot" class="form-control input-md" required>
			<span class="help-block"><?php echo form_error('bobot', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_indikator_kesejahteraan'"/>
</p>

<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_lainnya").className = "collapsed active";
	
	document.getElementById("pustaka_lainnya").className = "collapsed";

	var d = document.getElementById("nav-indikator");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

$("#deskripsi").change(function(){				
				var datanyakk = {deskripsi:$("#deskripsi").val()};
				$.ajax({
						type: "POST",
						url : "<?php echo site_url('indikatorkesejahteraan/c_indikator_kesejahteraan/DeskripsiExist')?>",
						data: datanyakk,
						success: function(data){
							if(data)
							{
								alertify.error('<b>Deskripsi Indikator</b> telah digunakan !');
								$("#deskripsi").focus();
								document.getElementById("simpan").disabled = true;	
							}
							else
							{
								document.getElementById("simpan").disabled = false;
							}
						}
					});
				
        });
</script>