<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('pustaka/c_perangkat/update_perangkat'); ?>
<fieldset>
<table>
	<input type="hidden" name="id_perangkat" id="id_perangkat" value="<?= $hasil->id_perangkat ?>" size="20" /> 
	<div class="form-group">
        <label class="col-md-3 control-label" for="id_jabatan"> Perangkat Desa</label>
        <div class="col-md-9">
       
         <?php $id = 'id="id_jabatan" class="form-control input-md" ';
        echo form_dropdown('id_jabatan',$deskripsi_jabatan,$hasil->id_jabatan,$id)?> 
         <span class="help-block"></span>
        </div>
    </div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="is_aktif"> Status</label>
        <div class="col-md-9">
			<div class="radio-inline">
			<input type="radio" name="is_aktif"  value="Y" <?php echo set_radio('is_aktif','Y',$hasil->is_aktif=='Y');?> />Aktif
			</div>
			<div class="radio-inline">
			<input type="radio" name="is_aktif"  value="N" <?php echo set_radio('is_aktif','N',$hasil->is_aktif=='N');?> />Tidak Aktif
			</div>
			<span class="help-block"></span>
		</div>
	</div>
	<legend></legend>
   	<div class="form-group">
        <label class="col-md-3 control-label" for="nik"> NIK</label>
        <div class="col-md-9">        
        <input class="form-control input-md" type="text" name="nik" id="nik" value="<?= $nik ?>" size="25" disabled/> 
		<span class="help-block"> <?php echo form_error('nik', '<p class="field_error">','</p>')?>
        </span>
        </div>
    </div>

	<div class="form-group">
        <label class="col-md-3 control-label" for="nama_sementara"> Nama </label>
        <div class="col-md-9">
       
         <input class="form-control input-md" type="text" name="nama" id="nama" size="25" value="<?= $nama ?>" disabled/> 
        <input type="hidden" name="nama" id="nama" size="25" /> 
         <span class="help-block"><?php echo form_error('nama', '<p class="field_error">','</p>')?>
        </span>
        </div>
    </div>
	
	<div class="form-group">
        <label class="col-md-3 control-label" for="nip"> NIP</label> 
        <div class="col-md-9">
         <input class="form-control input-md" type="text" name="nip" id="nip" value="<?= $hasil->nip ?>" size="25" /> 
        
        <span class="help-block"><?php echo form_error('nip', '<p class="field_error">','</p>')?>
        </span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="niap"> NIAP </label>
        <div class="col-md-9">
        
         <input class="form-control input-md" type="text" name="niap" id="niap" value="<?= $hasil->niap ?>" size="25" /> 
         <span class="help-block"><?php echo form_error('niap', '<p class="field_error">','</p>')?>
        </span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="id_pangkat_gol"> Golongan</label>
        <div class="col-md-9">
       
         <?php $id = 'id="id_pangkat_gol" class="form-control input-md"';
                echo form_dropdown('id_pangkat_gol',$deskripsi_pangkat_gol,$hasil->id_pangkat_gol,$id)?> 
         <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="no_sk_angkat"> No. SK Angkat </label>
        <div class="col-md-9">
        
         <input class="form-control input-md" type="text" name="no_sk_angkat" id="no_sk_angkat" value="<?= $hasil->no_sk_angkat ?>" size="25" /> 
         <span class="help-block"> <?php echo form_error('no_sk_angkat', '<p class="field_error">','</p>')?>
        </span>
        </div>
    </div>

    <div class="form-group">
        <label  class="col-md-3 control-label" for="tgl_angkat"> Tanggal Angkat </label>
        <div class="col-md-9">
			<div id="datepicker" class="input-group date" >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<input value="<?= date('d-m-Y',strtotime($hasil->tgl_angkat))?>" placeholder="Tgl-Bln-Thn" type="text" name="tgl_angkat" id="tgl_angkat" class="form-control input-md" readonly="readonly">
			</div>
				<span class="help-block"><?php echo form_error('tgl_angkat', '<p class="field_error">','</p>')?></span>
		</div>
    </div>
    
    <div class="form-group">
        <label class="col-md-3 control-label" for="no_sk_berhenti"> No. SK Berhenti</label> 
        <div class="col-md-9">
        
         <input class="form-control input-md" type="text" name="no_sk_berhenti" id="no_sk_berhenti" value="<?= $hasil->no_sk_berhenti ?>"  size="25" /> 
        <span class="help-block"></span>
        </div>
    </div>  
    
    <div class="form-group">
        <label  class="col-md-3 control-label" for="tgl_berhenti"> Tanggal Berhenti </label>
        <div class="col-md-9">
			<div id="datepicker2" class="input-group date" >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<input value="<?= date('d-m-Y',strtotime($hasil->tgl_berhenti))?>" placeholder="Tgl-Bln-Thn" type="text" name="tgl_berhenti" id="tgl_berhenti" class="form-control input-md" readonly="readonly">
			</div>
			<span class="help-block"><?php echo form_error('tgl_berhenti', '<p class="field_error">','</p>')?></span>
		</div>
    </div>
 
	
	<div class="form-group col-md-12">
	<legend></legend>
	<input type="submit" value="Simpan" class="btn btn-success" id="simpan"/>
	<input type="button" value="Batal" class="btn btn-danger" id="batal" onclick="location.href='<?= base_url() ?>pustaka/c_perangkat'"/>

	</div>
   
</fieldset>
<?php echo form_close(); ?>
<!-- Date Picker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url(); ?>assetku/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
function nav_active(){
	document.getElementById("a-perangkat").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
	nav_active();
	$("#datepicker").datepicker({ 
			autoclose: true, 
			todayHighlight: true,
			format: "dd-mm-yyyy"
		});
	$("#datepicker2").datepicker({ 
			autoclose: true, 
			todayHighlight: true,
			format: "dd-mm-yyyy"
		});
});
</script>