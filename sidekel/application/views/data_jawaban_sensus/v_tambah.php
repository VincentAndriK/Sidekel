<h2><?= $page_title ?></h2>

<div class="row">
                <div class="col-lg-12">
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
		
<?php echo form_open('indikatorkesejahteraan/c_jawaban_sensus/simpan_tambah_jawaban'); ?>
<fieldset>
	<div class="form-group">
		<div class="col-md-12">
			<input  value="<?= $hasil->id_sensus?>" id="id" name="id_sensus" type="hidden" placeholder="id" class="form-control input-md">
			<span class="help-block"><?php echo form_error('id_sensus', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	<div class="col-md-12">
	<?php 
		$ind=0;
		foreach($pertanyaan as $indikator)
		{
			$ind++;?>
			<input name="indikator_<?php echo $ind?>" value="<?php echo $indikator->id_indikator?>" type="hidden"></input>
			<input  name="ind" value="<?php echo $ind?>" type="hidden"></input>
	<?php
		}
		?>
	</div>
	<legend></legend>
	
	<!-- Text input------------------------------------------------------>
	<div class="form-group">
			 <label class="col-md-3 control-label" for="is_sementara_keluarga">Pencarian Data Kartu Keluarga</label>
			 <div class="col-md-9">			 
			 <input type="text" class="form-control" name="nokk_nama" id="nokk_nama" size="50" placeholder="No KK / Nama Kepala Keluarga / NIK Kepala Keluarga (min 2 karakter)" /> 
			<span class="help-block"></span>
		</div>
	</div>
	
	<div class="form-group">
			 <label class="col-md-3 control-label" for="is_sementara_keluarga">Nomer Kartu Keluarga</label>
			 <div class="col-md-9">			 
				<input type="text" class="form-control" name="no_kk_sementara" id="no_kk_sementara" size="50" readonly="readonly" placeholder="No KK" />
				<input id="no_kk" name="no_kk" type="hidden" placeholder="Nomer Kepala Keluarga" class="form-control input-md" >
			<span class="help-block"><?php echo form_error('no_kk', '<p class="field_error">','</p>')?>
			</span>
		</div>
	</div>
	
	<div class="form-group">
			 <label class="col-md-3 control-label" for="is_sementara_keluarga">Nama Kepala Keluarga</label>
			 <div class="col-md-9">
			 
				<input type="text" class="form-control" name="nama_sementara" id="nama_sementara_kepala" size="50" readonly="readonly" placeholder="Nama Kepala Keluarga"/>
				<input id="nama_kepala" name="nama" type="hidden" placeholder="Nama" class="form-control" >
			<span class="help-block">	<?php echo form_error('nama', '<p class="field_error">','</p>')?>	
			</span>
		</div>
	</div>
	
	<div class="form-group">
		  <label class="col-md-3 control-label" for="nik">NIK Kepala Keluarga</label>  
		  <div class="col-md-9">
			<input id="nik_sementara" name="nik_sementara" type="text" readonly="readonly" placeholder="NIK Kepala Keluarga" class="form-control input-md" />
			<input id="nik" name="nik" type="hidden" placeholder="NIK" class="form-control" >
			<span class="help-block"> <?php echo form_error('nik', '<p class="field_error">','</p>')?>
		  </span>  
		  </div>
	</div>
		<legend></legend>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="pertanyaan">Pertanyaan</label>
			 <div class="col-md-9">
				</select><span class="help-block"></span>
				<?php echo $string;?>
			
							
			
			</div>
	</div>	
	<legend></legend>
	<div class="form-group">
		  <label class="col-md-0 control-label" for="simpan"></label>
		  <div class="col-md-9">
			<button id="simpan" name="simpan" class="btn btn-success">Simpan</button>
			<button id="batal" name="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_sensus'">Batal</button>
		  </div>
		</div>
</fieldset>

<script>	

 $(function() {
    var noKK = <?php  echo $json_array; ?> ;
    $("#nokk_nama" ).autocomplete({
      source: noKK,
	  minLength: 2,
	  select: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		nik = bits[bits.length - 1]		
		nama = bits[bits.length - 2]
		no_kk = bits[bits.length - 3]
			$("#no_kk").val(no_kk);
			$("#nama_kepala").val(nama);
			$("#no_kk_sementara").val(no_kk);
			$("#nama_sementara_kepala").val(nama);	
			$("#nik_sementara").val(nik);			
			//document.getElementById("cetak").disabled = false;
        },
        change: function(event, ui) {
		
		bits = ui.item.value.split(' | ')
		nik = bits[bits.length - 1]		
		nama = bits[bits.length - 2]
		no_kk = bits[bits.length - 3]
			$("#no_kk").val(no_kk);
			$("#nama_kepala").val(nama);
			$("#no_kk_sementara").val(no_kk);
			$("#nama_sementara_kepala").val(nama);
			$("#nik_sementara").val(nik);
		
        }
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