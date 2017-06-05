<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open_multipart('admin/c_regulasi/simpan_regulasi'); ?>
<legend></legend>
    <div class="form-group">
    	 <label  class="col-md-3 control-label" for="judul_regulasi">Judul Regulasi </label>
        <div class="col-md-9">
         <span class="help-block">
         <input class="form-control input-md" type="text" name="judul_regulasi" id="judul_regulasi" size="30" required/> 
		<?php echo form_error('judul_regulasi', '<p class="field_error">','</p>')?>
		</span>
		</div>
	</div>
	<div class="form-group">
    	 <label  class="col-md-3 control-label" for="isi_regulasi">Isi Regulasi</label>
        <div class="col-md-9">        
		 <textarea class="form-control input-md" rows="5" name="isi_regulasi" id="isi_regulasi" required></textarea>
		 <span class="help-block"><?php echo form_error('isi_regulasi', '<p class="field_error">','</p>')?>	</span>
		</div>
	</div>
	
	<div class="form-group"> 	
    	 <label class="col-md-3 control-label" for="file_regulasi">File Regulasi</label>
        <div class="col-md-9">
			<input class="form-control input-md"  type="file" name="file_regulasi" id="file_upload" required/>
			<div align="right">File harus bertipe .doc /.pdf /.xls</div>
		<span class="help-block"><?php echo form_error('file_regulasi', '<p class="field_error">','</p>')?>	</span>
		</div>
	</div>	

<div class="form-group">
    <label class="col-md-0 control-label" for="simpan"></label>
    <div class="col-md-9">
    <button type="submit" class="btn btn-success" name="simpan" id="simpan"/>Simpan</button>
    <button type="button" class="btn btn-danger" name="batal" id="batal" onclick="location.href='<?= base_url() ?>admin/c_regulasi'"/>Batal</button>
    </div>
</div>

<?php echo form_close(); ?>

<script>

function nav_active(){

	document.getElementById("a-data-web").className = "collapsed active";
	
	var r = document.getElementById("pengelola_data_web");
	r.className = "collapsed";

	var d = document.getElementById("nav-regulasi");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
  $('form').submit(function() { 
		if(beforeSubmitFile()==false)
		{
			return false;
		}
		else			
		// always return false to prevent standard browser submit and page navigation 
		return true; 
	}); 
});

//function to check file size before uploading.
function beforeSubmitFile(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#file_upload').val()) //check empty input filed
		{
			alertify.error("Silahkan Pilih Berkas !");
			return false
		}
		
		var fsize = $('#file_upload')[0].files[0].size; //get file size
		var ftype = $('#file_upload')[0].files[0].type; // get file type
		

		//allow file types 
		switch(ftype)
        {
            
			case 'application/vnd.ms-excel':
			case '"application/excel"':
			case 'application/msword':
			case 'application/pdf':
                break;
            default:
				alertify.error("<b>"+ftype+"</b> <br />Tipe berkas tidak mendukung !");
				console.log(ftype);
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>2048576) 
		{
			
			alertify.error("Ukuran Berkas Maksimal : 2MB !");	
			return false
		}
		
		//document.getElementById("submit-btn-file").disabled = true;	
		//alertify.log("Proses Import Data sedang dilakukan, harap tunggu hingga proses selesai !")
		//$('#submit-btn-file').hide(); //hide submit button
		//$('#loading-img-file').show(); //hide submit button
		//$("#output-file").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		alertify.error("Silahkan tingkat versi dari piranti lunak browser anda, karena browser anda sekarang tidak mendukung fitur terbaru !");	
		return false;
	}
}


//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
</script>