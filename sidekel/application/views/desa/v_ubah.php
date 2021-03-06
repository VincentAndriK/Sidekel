<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('admin/c_desa/update_desa'); ?>
      <input type="hidden" name="id_desa" id="id_desa" size="30" value="<?= $hasil->id_desa?>" readonly = "readonly"/>
<fieldset>
<legend></legend>
     <div class="form-group">
        <label class="col-md-3 control-label" for="kode_desa_bps"> Kode BPS </label>
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="kode_desa_bps" id="kode_desa_bps" size="30" value="<?= $hasil->kode_desa_bps?>" placeholder="Kode Provinsi Badan Pusat Statistik (BPS)" required/> 
        <?php echo form_error('kode_desa_bps', '<p class="field_error">','</p>')?>
        </span>
        </div>
    </div>
     <div class="form-group">
        <label class="col-md-3 control-label" for="kode_desa_kemendagri"> Kode Kemendagri </label> 
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="kode_desa_kemendagri" id="kode_desa_kemendagri" size="30" value="<?= $hasil->kode_desa_kemendagri?>" placeholder="Kode Kemendagri" required/> 
        <?php echo form_error('kode_desa_kemendagri', '<p class="field_error">','</p>')?>
        </span>  
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="nama_desa"> Nama Desa </label> 
        <div class="col-md-9">
        <span class="help-block">
         <input class="form-control input-md" type="text" name="nama_desa" id="nama_desa" size="30" value="<?= $hasil->nama_desa?>"  placeholder="Nama Desa" required/> 
        <?php echo form_error('nama_desa', '<p class="field_error">','</p>')?>
        </span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="luas_wilayah"> Luas Wilayah </label>
        <div class="col-md-9"> 
			<div class="input-group">
				<input class="form-control input-md" type="text" name="luas_wilayah" id="luas_wilayah" value="<?= $hasil->luas_wilayah?>" placeholder="Luas Wilayah (ha)"/> 
			<div class="input-group-addon pull"><i>Hektar (ha)</i></div>
			</div>
			<span class="help-block"><?php echo form_error('luas_wilayah', '<p class="field_error">', '</p>'); ?></span>         
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="kode_kecamatan_bps"> Kecamatan </label> 
        <div class="col-md-9">
        <span class="help-block">
         <?php $id = 'id="id_kecamatan" class="form-control input-md" ';
                echo form_dropdown('id_kecamatan',$nama_kecamatan,$hasil->id_kecamatan,$id)?>
                <?php echo form_error('id_kecamatan', '<p class="field_error">','</p>')?>
        </span>
        </div>
    </div>
	<div class="form-group">
    	<label class="col-md-3 control-label" for="alamat_desa"> Alamat Desa </label>
        <div class="col-md-9">
         <input class="form-control input-md" type="text" name="alamat_desa" id="kode_desa_bps" size="30" value="<?= $hasil->alamat_desa?>"  placeholder="Alamat Desa" required/> 
        <span class="help-block">
		<?php echo form_error('alamat_desa', '<p class="field_error">','</p>')?>
		</span>
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="kode_pos"> Kode Pos </label>
        <div class="col-md-9">
         <input class="form-control input-md" type="text" name="kode_pos" id="kode_pos" size="30" value="<?= $hasil->kode_pos?>"  placeholder="Kode Pos" required/> 
        <span class="help-block">
		<?php echo form_error('kode_pos', '<p class="field_error">','</p>')?>
		</span>
		</div>
	</div>
	<div class="form-group">
    	<label class="col-md-3 control-label" for="no_telp"> No Telpon </label>
        <div class="col-md-9">
         <input class="form-control input-md" type="text" name="no_telp" id="no_telp" size="30" value="<?= $hasil->no_telp?>"  placeholder="(Kode Wilayah) No Telpon" required/> 
        <span class="help-block">
		<?php echo form_error('kode_pos', '<p class="field_error">','</p>')?>
		</span>
		</div>
	</div>
	<div class="form-group">
    	<label class="col-md-3 control-label" for="email"> Email </label>
        <div class="col-md-9">
         <input class="form-control input-md" type="email" name="email" id="email" size="30" value="<?= $hasil->email?>"  placeholder="Email" required/> 
        <span class="help-block">
		<?php echo form_error('kode_pos', '<p class="field_error">','</p>')?>
		</span>
		</div>
	</div>
    <legend></legend>
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-3 control-label" for="nik_nama">Pencarian Data Kepala Desa</label>  
      <div class="col-md-9">
      <input id="nik_nama" name="nik_nama" type="text" placeholder="NIK / Nama Penduduk" class="form-control input-md" value="<?php if($nik!==null){ echo $nik .' | ' . $nama;}?>" >
      <span class="help-block"><?php echo form_error('nik_nama', '<p class="field_error">','</p>')?></span>  
      </div>
    </div>
    
    <legend></legend>
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-3 control-label" for="nik">NIK Kepala Desa</label>  
      <div class="col-md-9">
      <input id="nik_sementara" name="nik_sementara" type="text" placeholder="NIK" class="form-control input-md" required="" disabled value="<?= $nik?>" />
      <input id="nik" name="nik" type="hidden" placeholder="NIK" class="form-control input-md" value="<?= $nik?>" />
      <span class="help-block"><?php echo form_error('nik', '<p class="field_error">','</p>')?></span>  
      </div>
    </div>
    
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-3 control-label" for="nama">Nama Kepala Desa</label>  
      <div class="col-md-9">
      <input id="nama_sementara" name="nama_sementara" type="text" placeholder="Nama Kepala Desa" class="form-control input-md" required="" disabled value="<?= $nama?>" />
      <input id="nama" name="nama" type="hidden" placeholder="Nama Kepala Desa" class="form-control input-md" value="<?= $nama?>"/>
      <span class="help-block"><?php echo form_error('nama', '<p class="field_error">','</p>')?></span>  
      </div>
    </div>

<div class="form-group">
    <label class="col-md-0 control-label" for="simpan"></label>
    <div class="col-md-9">
    <button type="submit" class="btn btn-success" name="simpan" id="simpan"/>Simpan</button>
    <button type="button" class="btn btn-danger" name="batal" id="batal" onclick="location.href='<?= base_url() ?>admin/c_desa'"/>Batal</button>
    </div>
</div>
</fieldset>
<br>
<script>    

  $(function() {
    var nikPenduduk = <?php  echo $json_array_nama; ?> ;
    $("#nik_nama" ).autocomplete({
      source: nikPenduduk,
      minLength: 2,
      select: function(event, ui) {
        
        bits = ui.item.value.split(' | ')
        nik = bits[bits.length - 2]
        nama = bits[bits.length - 1]
            $("#nik").val(nik);
            $("#nama").val(nama);
            $("#nik_sementara").val(nik);
            $("#nama_sementara").val(nama);
        },
        change: function(event, ui) {
        
        bits = ui.item.value.split(' | ')
        nik = bits[bits.length - 2]
        nama = bits[bits.length - 1]
                $("#nik").val(nik);
            $("#nama").val(nama);           
            $("#nik_sementara").val(nik);
            $("#nama_sementara").val(nama);
        }
    });
  });
  
  
  function nav_active(){

	document.getElementById("a-data-wilayah").className = "collapsed active";
	
	var r = document.getElementById("pengelola_data_wilayah");
	r.className = "collapsed";

	var d = document.getElementById("nav-desa");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>