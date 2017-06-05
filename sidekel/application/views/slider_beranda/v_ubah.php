<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php
$attributes = array('name' => 'myform');
echo form_open_multipart('admin/c_slider_beranda/update_slider_beranda', $attributes); 
?>
<fieldset>
<legend></legend>

		 <div class="col-md-12">
			<input type="hidden"  id="id_slider_beranda" name="id_slider_beranda" value="<?= $hasil->id_slider_beranda?>"/>
		</div>
		
		<div class="form-group"> 	
    	 <label class="col-md-3 control-label" for="konten_teks">Konten Teks</label>
        <div class="col-md-9">
         <span class="help-block">
			<input class="form-control input-md"  type="text" name="konten_teks" id="konten_teks" placeholder="Konten Teks" value="<?= $hasil->konten_teks?>"/>
		</span>
		</div>
	</div>	
	<div class="form-group"> 	
    	 <label class="col-md-3 control-label" for="url">Url</label>
        <div class="col-md-9">
         <span class="help-block">
			<input class="form-control input-md"  type="url" name="url" id="url" placeholder="http://" value="<?= $hasil->url?>" />
		</span>
		</div>
	</div>	
	<legend></legend>
	<div class="form-group"> 	
    	 <label class="col-md-3 control-label" for="konten_background">Konten Background</label>
        <div class="col-md-9">
         <span class="help-block">
			<input class="form-control input-md"  type="file" name="konten_background" id="imgInp" value="<?=$hasil->konten_background ?>">
			<input class="form-control input-md"  type="hidden" name="path_konten_background" id="path_konten_background" value="<?=$hasil->konten_background ?>" >
			<input class="form-control input-md"  type="hidden" name="old_background" id="old_background" value="<?=$hasil->konten_background ?>">
			<div align="right">Gambar harus bertipe .jpg</div>
		</span>
		</div>
		<label class="col-md-3 control-label"></label>
		 <div class="col-md-9">
			<div id="loading"><i class="fa fa-spinner fa-pulse fa-2x"></i></div>
			<img id="blah" src='<?php echo site_url($hasil->konten_background);?>' alt="your image"  class='img-responsive img-thumbnail' width="640px"/><br><br>
		</div>
	</div>	

	<legend></legend>
	<div class="form-group"> 	
    	 <label class="col-md-3 control-label" for="konten_logo">Konten Logo</label>
        <div class="col-md-9">
         <span class="help-block">
			<input class="form-control input-md"  type="file" name="konten_logo" id="imgInp1" value="<?=$hasil->konten_logo ?>" multiple>
			<div align="right">Gambar harus bertipe .jpg atau .png , maks 500 KB</div>
		</span>
		</div>
		<label class="col-md-3 control-label"></label>
		 <div class="col-md-3">
			<img id="blah1" src='<?php echo site_url($hasil->konten_logo);?>' alt="your image"  class='img-responsive img-thumbnail' width="150px" height="150px"/><br><br>
		</div>
	</div>	

	<legend></legend>
<p>
<input type="submit" class="btn btn-success" value="Simpan" id="simpan"/>
<input type="button" class="btn btn-danger" value="Batal" id="batal" onclick="location.href='<?= base_url() ?>admin/c_slider_beranda'"/>
</p>
<br>
<?php echo form_close(); ?>


<!-- Image Resize JavaScript -->
<script src="<?php echo base_url(); ?>assetku/plugins/image_resize/vendor/canvas-to-blob.min.js"></script>
<script src="<?php echo base_url(); ?>assetku/plugins/image_resize/resize.js"></script>
<script>
var _base_url = '<?= base_url() ?>';

	document.querySelector('#imgInp').addEventListener('change', function (event) {
		document.getElementById("simpan").disabled = true;
		document.getElementById("simpan").value = 'Uploading Image...';
		document.getElementById("loading").style.display = 'block';
		document.getElementById("blah").style.display = 'none';
		'use strict';

		// Initialise resize library
		var resize = new window.resize();
		resize.init();

		// Upload photo
		var upload = function (photo, callback) {
			var formData = new FormData();
			formData.append('photo', photo);
			var request = new XMLHttpRequest();
			request.onreadystatechange = function() {
				if (request.readyState === 4) {
					callback(request.response);
				}
			}
			var oldName = document.getElementById('old_background').value;
			request.open('POST', _base_url + 'admin/c_slider_beranda/resize_upload_background_update?old=' + oldName);
			request.responseType = 'json';
			request.send(formData);
		};

		var fileSize = function (size) {
			var i = Math.floor(Math.log(size) / Math.log(1024));
			return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
		};
	
		event.preventDefault();

		var files = event.target.files;
		for (var i in files) {

			if (typeof files[i] !== 'object') return false;

			(function () {

				var initialSize = files[i].size;

				resize.photo(files[i], 888, 'file', function (resizedFile) {
					
					var resizedSize = resizedFile.size;

					upload(resizedFile, function (response) {
						document.getElementById('path_konten_background').value=response.url;
						document.getElementById('old_background').value=response.url;
						document.getElementById("simpan").disabled = false;
						document.getElementById("simpan").value = 'Simpan';
						document.getElementById("loading").style.display = 'none';
						document.getElementById("blah").style.display = 'block';
					});

					// This is not used in the demo, but an example which returns a data URL so yan can show the user a thumbnail before uploading th image.
					resize.photo(resizedFile, 600, 'dataURL', function (thumbnail) {
						console.log('Display the thumbnail to the user: ', thumbnail);
					});

				});

			}());

		}

	});
 





function readURL_logoDesa(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
		
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imgInp").change(function(){
    readURL_logoDesa(this);
	{document.getElementById("blah").style.display = 'block';}
});

$( document ).ready(function() {
   {document.getElementById("blah").style.display = 'show';}
});


function readURL_logoKabupaten(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah1').attr('src', e.target.result);
        }
		
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imgInp1").change(function(){
    readURL_logoKabupaten(this);
	
});

$( document ).ready(function() {
   {document.getElementById("blah1").style.display = 'show';}
});

function nav_active(){

	document.getElementById("a-data-web").className = "collapsed active";
	
	var r = document.getElementById("pengelola_data_web");
	r.className = "collapsed";

	var d = document.getElementById("nav-slider");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  {document.getElementById("loading").style.display = 'none';}
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

function beforeSubmitFile(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
				
		var fsize = $('#imgInp1')[0].files[0].size; //get file size
		var ftype = $('#imgInp1')[0].files[0].type; // get file type
		

		//allow file types 
		switch(ftype)
        {
            
			case 'image/png':
			case 'image/jpg':
			case 'image/jpeg':
                break;
            default:
				alertify.error("<b>"+ftype+"</b> <br />Tipe berkas tidak mendukung !");
				console.log(ftype);
				return false
        }
		
		//Allowed file size is less than 500 KB (548576)
		if(fsize>548576) 
		{
			
			alertify.error("Ukuran Konten Logo Maksimal : 500 KB !");	
			return false
		}
		//hide submit button
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