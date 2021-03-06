<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('surat/c_surat/simpan_surat'); ?>

<fieldset>
<legend></legend>
	<div class="form-group">
    	<label class="col-md-3 control-label" for="kode_surat">Kategori Surat</label>  
        <div class="col-md-9">
         <?php $id ='id="kode_surat" class="form-control input-md" required';
		echo form_dropdown('kode_surat',$deskripsi_kode_surat,'',$id)?>
		<span class="help-block"><?php echo form_error('kode_surat', '<p class="field_error">','</p>')?></span> 
		</div>	
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="nomor_surat">Nomor Surat</label> 
        <div class="col-md-3">
        <input class="form-control input-md" type="text" name="nomor_surat" placeholder="Nomor" id="nomor_surat" size="30" value="<?=$nomor_max_increment?>" onkeypress="return numbersonly(event)" required/> 
        <span class="help-block"><?php echo form_error('nomor_surat', '<p class="field_error">', '</p>'); ?></span>
        </div> 
		<div class="col-md-3">
        <input class="form-control input-md" type="text" name="supra_kode" placeholder="Supra Kode" id="supra_kode" size="30" readonly="readonly"/>  
        <span class="help-block"><?php echo form_error('supra_kode', '<p class="field_error">', '</p>'); ?></span>
        </div>
		
		<div class="col-md-3">
        <input class="form-control input-md" type="text" name="tahun_surat" placeholder="Tahun" id="tahun_surat" size="30" value="<?php echo date('Y');?>" readonly="readonly"/>  
        <span class="help-block"><?php echo form_error('tahun_surat', '<p class="field_error">', '</p>'); ?></span>
        </div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="judul_surat">Judul Surat</label> 
        <div class="col-md-9">
        <input class="form-control input-md" type="text" name="judul_surat" placeholder="Contoh: Izin Membuat KTP (Tanpa Kata 'Surat')" id="judul_surat" size="30" required/>  
        <span class="help-block"><?php echo form_error('judul_surat', '<p class="field_error">', '</p>'); ?></span>
        </div> 
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="tgl_surat">Tanggal Surat</label>  
        <div class="col-md-9">
       	<span class="help-block">
       	<input class="form-control input-md" type="text" name="tgl_surat" id="tgl_surat" size="30" value="<?= date('d-m-Y') ?>" disabled/>  
       	</span>
       	</div>	
	</div>
	
	<legend></legend>
		
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="nik_nama">Pencarian Data Penduduk</label>  
	  <div class="col-md-9">
	  <input id="nik_nama" name="nik_nama" type="text" placeholder="NIK / Nama Penduduk" class="form-control input-md">
	  <span class="help-block"><?php echo form_error('nik_nama', '<p class="field_error">','</p>')?></span>  
	  </div>
	</div>
	
	<legend></legend>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="nik">NIK</label>  
	  <div class="col-md-9">
	  <input id="nik_sementara" name="nik_sementara" type="text" placeholder="NIK" class="form-control input-md" required="" disabled/>
	  <input id="nik" name="nik" type="hidden" placeholder="NIK" class="form-control input-md" >
	  <span class="help-block"><?php echo form_error('nik', '<p class="field_error">','</p>')?></span>  
	  </div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="nama">Nama Penduduk</label>  
	  <div class="col-md-9">
	  <input id="nama_sementara" name="nama_sementara" type="text" placeholder="Nama Penduduk" class="form-control input-md" required="" disabled/>
	  <input id="nama" name="nama" type="hidden" placeholder="Nama Penduduk" class="form-control input-md" >
	  <span class="help-block"><?php echo form_error('nama', '<p class="field_error">','</p>')?></span>  
	  </div>
	</div>

	<div class="form-group">
    	<label class="col-md-3 control-label" for="tgl_awal">Tanggal Berlaku</label> 
    	<div class="col-md-4">
        <!--<a href="javascript:NewCssCal('tgl_awal','ddmmyyyy')">
        <div class="input-group">
							 <span class="input-group-addon">
								<span class="fa fa-table"></span>
							</span>
							<input type="text" name="tgl_awal" id="tgl_awal" size="20" class="form-control input-md" placeholder="Awal" readonly="readonly"/>
		</div>
		</a>-->
		<div id="datepicker" class="input-group date" >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					<input placeholder="Awal" type="text" value="" name="tgl_awal" id="tgl_awal" class="form-control input-md" readonly>
			</div>
         <span class="help-block"><?php echo form_error('tgl_awal', '<p class="field_error">','</p>')?></span>  	
	</div>	
	</div>
	<div class="col-md-1">
		<span class="help-block"></span>  
	</div> 
	<div class="form-group">
    	<div class="col-md-4">
      	<!--<a href="javascript:NewCssCal('tgl_akhir','ddmmyyyy')">
      	<div class="input-group">
							 <span class="input-group-addon">
								<span class="fa fa-table"></span>
							</span>
							<input type="text" name="tgl_akhir" id="tgl_akhir" size="20" class="form-control input-md" placeholder="Akhir" readonly="readonly"/>
		</div>
		</a>-->
			<div id="datepicker2" class="input-group date" >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					<input placeholder="Akhir" type="text" value="" name="tgl_akhir" id="tgl_akhir" class="form-control input-md" readonly>
			</div>
      	 <span class="help-block"><?php echo form_error('tgl_akhir', '<p class="field_error">','</p>')?></span>  
	</div>		
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="id_perangkat">Pamong</label>  
        <div class="col-md-9">
        <?php $id = 'id="id_perangkat" class="form-control input-md" required';
		echo form_dropdown('id_perangkat',$nama_pamong,'',$id)?>
		<span class="help-block"><?php echo form_error('id_perangkat', '<p class="field_error">','</p>')?> </span> 
		</div>	
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="keperluan">Keperluan</label> 
        <div class="col-md-9">
        <textarea  class="form-control input-md" name="keperluan" id="keperluan" size="30" required></textarea> 
        <span class="help-block"><?php echo form_error('keperluan', '<p class="field_error">', '</p>'); ?> </span> 
        </div>	
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="kata_penutup">Kata Penutup</label>  
        <div class="col-md-9">
        <textarea class="form-control input-md" name="kata_penutup" id="kata_penutup" size="30" required></textarea> 
        <span class="help-block"><?php echo form_error('kata_penutup', '<p class="field_error">', '</p>'); ?> </span>
        </div>
	</div>
	<legend></legend>

	<div class="form-group">
		<label class="col-md-0 control-label" for="simpan"></label>
		<div class="col-md-9">
		<span class="help-block">
			<button id="simpan" name="simpan" class="btn btn-success">Simpan</button>
			<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>surat/c_surat'"/>
		</span>
		</div>
	</div>
</fieldset>
<?php echo form_close(); ?>
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
  
  $("#kode_surat").change(function(){
			var supra_kode = document.getElementById("kode_surat").value;	
			document.getElementById("supra_kode").value = supra_kode;	
			
	});
  
</script>
<style>
      #result {
        margin-top: 10px;
        width: 900px;
      }

      #result-data {
        display: block;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        word-wrap: break-word;
      }
     }
    </style>
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
$("#datepicker2").datepicker({ 
			autoclose: true, 
			todayHighlight: true,
			format: "dd-mm-yyyy"
		});

});
</script>