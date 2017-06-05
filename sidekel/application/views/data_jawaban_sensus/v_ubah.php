<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('indikatorkesejahteraan/c_jawaban_sensus/update_jawaban_sensus'); ?>
<fieldset>
	<legend></legend>
	<!-- Text input-->
	<div class="form-group">
		<label  class="col-md-3 control-label" for="nama">Nama Kepala Keluarga</label>
		<div class="col-md-9">
			<input  value="<?= $hasil->nama?>"  id="nama" name="nama" type="text" 
			placeholder="Nama Kepala Keluarga" class="form-control input-md" required disabled>
			<span class="help-block"><?php echo form_error('nama', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	
	<div>
	
	<div class="form-group">
		<label  class="col-md-3 control-label" for="pertanyaan">Pertanyaan</label>
		<div class="col-md-9">
			<!--<label><?php echo $pertanyaan->pertanyaan;?></label> -->
			<?php echo $string;?>
			<span class="help-block"><?php echo form_error('pertanyaan', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	
	
	
	<div class="form-group">
		<div class="col-md-9">
			<input  value="<?= $hasil->id_sensus?>" id="id_sensus" name="id_sensus" type="hidden" placeholder="id" class="form-control input-md">
		</div>
	</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-9">
			<?php  echo $string2;?>
		</div>
	</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-9">
			<input  value="<?= $hasil->id_jawaban?>" id="id_jawaban" name="id_jawaban" type="hidden" placeholder="id" class="form-control input-md">
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-9">
			<input  value="<?= $hasil->id_keluarga?>" id="id_keluarga" name="id_keluarga" type="hidden" placeholder="id" class="form-control input-md">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-9">
			<input  value="<?= $hasil->id_pertanyaan_sensus?>" id="id_pertanyaan_sensus" name="id_pertanyaan_sensus" type="hidden" placeholder="id" class="form-control input-md">
		</div>
	</div>
	
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_jawaban_sensus'"/>
</p>
<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_lainnya").className = "collapsed active";
	
	document.getElementById("pustaka_lainnya").className = "collapsed";

	var d = document.getElementById("nav-jawaban");
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
						url : "<?php echo site_url('indikatorkesejahteraan/c_ciri_pembeda/DeskripsiExist')?>",
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