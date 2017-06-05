<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>


<?php echo form_open('admin/c_artikel/simpan_kategori'); ?>
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
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>admin/c_artikel/lists_kategori'"/>
</p>

<script>

function nav_active(){
	
	document.getElementById("a-data-web").className = "collapsed active";
	
	document.getElementById("pengelola_data_web").className = "collapsed";

	var d = document.getElementById("nav-artikel");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>