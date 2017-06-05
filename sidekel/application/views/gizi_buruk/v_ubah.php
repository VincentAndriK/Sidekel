<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open_multipart('datapenduduk/c_gizi_buruk/update_gizi_buruk'); ?>
	<fieldset>
		<!-- Form Name -->
		<legend></legend>
		
		<!-- Text input-->
		<div class="form-group">
		  <div class="col-md-9">
		  <input  value="<?= $hasil->id_gizi_buruk?>" id="id_gizi_buruk" name="id_gizi_buruk" type="hidden" placeholder="NIK / Nama Penduduk" class="form-control input-md">
		  <span class="help-block"><?php echo form_error('id_gizi_buruk', '<p class="field_error">','</p>')?></span>  
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-3 control-label" for="nik">NIK</label>  
		  <div class="col-md-9">
		  <input value="<?= $penduduk->nik?>" id="nik_sementara" name="nik_sementara" type="text" placeholder="NIK" class="form-control input-md" required="" disabled>
		  <input value="<?= $penduduk->nik?>" id="nik" name="nik" type="hidden" placeholder="NIK" class="form-control input-md" >
		  <span class="help-block"><?php echo form_error('nik', '<p class="field_error">','</p>')?></span>  
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-3 control-label" for="nama">Nama Penduduk</label>  
		  <div class="col-md-9">
		  <input value="<?= $penduduk->nama?>" id="nama_sementara" name="nama_sementara" type="text" placeholder="Nama Penduduk" class="form-control input-md" required="" disabled >
		  <input value="<?= $penduduk->nama?>" id="nama" name="nama" type="hidden" placeholder="Nama Penduduk" class="form-control input-md" >
		  <span class="help-block"><?php echo form_error('nama', '<p class="field_error">','</p>')?></span>  
		  </div>
		</div>

		<legend></legend>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-3 control-label" for="berat_badan">Berat Badan</label>  
		  <div class="col-md-9">
		  <input value="<?= $hasil->berat_badan?>" id="berat_badan" name="berat_badan" type="text" placeholder="Berat Badan (kg)" class="form-control input-md" required="" onkeypress="return numbersonly(event)">
		  <span class="help-block"><?php echo form_error('berat_badan', '<p class="field_error">','</p>')?></span>  
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-3 control-label" for="tinggi_badan">Tinggi Badan</label>  
		  <div class="col-md-9">
		  <input value="<?= $hasil->tinggi_badan?>" id="tinggi_badan" name="tinggi_badan" type="text" placeholder="Tinggi Badan (cm)" class="form-control input-md" required="" onkeypress="return numbersonly(event)">
		  <span class="help-block"><?php echo form_error('tinggi_badan', '<p class="field_error">','</p>')?></span>  
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-3 control-label" for="tgl_timbang">Tanggal Menimbang</label>  
		  <div class="col-md-9">
		  <!--<a href="javascript:NewCssCal('tgl_timbang','ddmmyyyy')">
			 <div class="input-group">
							 <span class="input-group-addon">
								<span class="fa fa-table"></span>
							</span>
							<input value="<?= date('j-m-Y ',strtotime($hasil->tgl_timbang))?>" readonly="readonly" class="form-control" type="text"  name="tgl_timbang" id="tgl_timbang" size="20" placeholder="Tgl-Bln-Thn" class="form-control input-md" required="" />
							</div></a>
		  <span class="help-block"><?php echo form_error('tgl_timbang', '<p class="field_error">','</p>')?></span>  
		  </div>
		</div>-->
		<div id="datepicker" class="input-group date" >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					<input placeholder="Tgl-Bln-Thn" type="text" value="<?= date('j-m-Y ',strtotime($hasil->tgl_timbang))?>" name="tgl_timbang" id="tgl_timbang" class="form-control input-md" readonly>
			</div>

		<!-- Button (Double) -->
		<legend></legend>
		<div class="form-group">
		  <label class="col-md-0 control-label" for="simpan"></label>
		  <div class="col-md-9">
			<button id="simpan" name="simpan" class="btn btn-success">Simpan</button>
			<button id="batal" name="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>datapenduduk/c_gizi_buruk'">Batal</button>
		  </div>
		</div>

	</fieldset>
<?php echo form_close(); ?>

</div>
</div>

<script>
function nav_active(){
	
	document.getElementById("a-data-perspektif_kesehatan_penduduk").className = "collapsed active";
	
	document.getElementById("perspektif_kesehatan_penduduk").className = "collapsed";

	var d = document.getElementById("nav-gizi_buruk");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
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


});
</script>