<h2><?= $page_title ?></h2>

<div class="row">
<div class="col-lg-12">


		


<?php $attributes = array('name' => 'myform'); 
echo form_open_multipart('admin/c_galeri/update_galeri',$attributes); ?>
	<fieldset>
		<!-- Form Name -->
		<legend></legend>
		<input type="hidden" id="jenis" value="<?=$konten_galeri->kategori?>" name="jenis">
		<input type="hidden" id="nama" value="" name="nama">
		<input type="hidden" id="id" value="<?=$id_galeri?>" name="id">
		<input type="hidden" id="gambar" value="<?=$konten_galeri->url?>" name="gambar">
		
		<!-- Text input-->
		<div id="label-judul" class="form-group">
			<label class="col-md-3 control-label" for="judul" >Judul</label>
			<div class="col-md-9">
				<input id="judul" class="form-control" placeholder="Judul Konten" type="text" name="judul" value="<?=$konten_galeri->judul?>">
				<span class="help-block"></span>
			</div>
		</div>

		<div id="gambar" class="form-group">
			<label class="col-md-3 control-label" for="url" >URL</label>
			<div class="col-md-9">
				<input id="url-video" class="form-control" placeholder="URL" type="text" name="url-video" value="<?=$konten_galeri->url?>">
				<span class="help-block"></span>
			</div>
		</div>

		<div id="video" class="form-group">
			<div class="image-editor">
				<label class="col-md-3 control-label" for="url-video" >Pilih Gambar</label>
				<div class="col-md-9">
					
					<span class="help-block">
					<div id="lihat">
						<div align="left">Gambar harus bertipe .jpg</div>
					<div class="cropit-image-preview" ></div>				
					<input type="range" class="cropit-image-zoom-input" style="width: 500px">
					<input type="file" id="userfile" class="cropit-image-input custom" accept="image/*">
					<input type="hidden" name="image-data" class="hidden-image-data">
					<span class="help-block"></span>
					</div>
							
				</div>
			</div>
			
		</div>	

		<clear></clear>
		
		<!-- Button (Double) -->
		<legend></legend>
		<div class="form-group">
		  <label class="col-md-0 control-label" for="simpan"></label>
		  <div class="col-md-9">
			<button id="simpan" name="simpan" class="btn btn-success">Simpan</button>
			<button id="batal" name="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>admin/c_galeri'">Batal</button>
			
		  </div>
		</div>

	</fieldset>
<?php echo form_close(); ?>

</div>
</div>

<script src="<?php echo base_url(); ?>assetku/cropit/jquery.cropit.js"></script>
<script src="<?php echo base_url(); ?>assetku/cropit/jquery.cropit.js"></script>
<script>
$(function() {
$('.image-editor').cropit({
  imageState: {
	src: '<?php echo site_url($konten_galeri->url);?>'
  }
});
  });
  
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#userfile').attr('src', e.target.result);		
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#userfile").change(function(){
    readURL(this);
	{	document.getElementById("lihat").style.display = "block";
		var a = document.getElementById("userfile").value;
		document.getElementById('url-video').value = 'uploads/galeri/'+a;
		document.getElementById('nama').value = a;}
});
</script>
<script>
$(function() {
  

// very simple to use!
$(document).ready(function() {
  nav_active();
  var value = "<?=$konten_galeri->kategori?>";
  if(value == "foto"){
    	$('#gambar').show();
    	$('#video').show();
    	$('#label-judul').show();
    	document.getElementById('jenis').value = 'foto';
    	document.getElementById("simpan").disabled = false;
    	document.getElementById("url-video").readOnly = true;

    	//document.getElementById("blah").style.display = 'block';
    }else if(value == "video"){
    	$('#gambar').show();
    	$('#video').hide();
    	$('#label-judul').show();
    	document.getElementById('jenis').value = 'video';
    	document.getElementById("simpan").disabled = false;
    	document.getElementById("url-video").disabled = false;
    	// document.getElementById("blah").style.display = 'none';
    }
    $('form').submit(function() {
if($("#judul").val()==""||$("#url-video").val()==""){
	 		alertify.error("Maaf, data yang anda masukkan belum lengkap !");
	 		return false;
	 	}else{
	 		var imageData = $('.image-editor').cropit('export', {
		  type: 'image/jpeg',
		  quality: .85,
		  originalSize: false
		});		
	  $('.hidden-image-data').val(imageData);
	  return true;
	 	}
  });
	})
});
function nav_active(){
	
	document.getElementById("a-data-web").className = "collapsed active";
	
	document.getElementById("pengelola_data_web").className = "collapsed";

	var d = document.getElementById("nav-galeri");
	d.className = d.className + "active";
	}
</script>
<style>
		/* Show load indicator when image is being loaded */
		.cropit-image-preview.cropit-image-loading .spinner {
		opacity: 1;
		}

		/* Show move cursor when image has been loaded */
		.cropit-image-preview.cropit-image-loaded {
		cursor: move;
		}

		/* Gray out zoom slider when the image cannot be zoomed */
		.cropit-image-zoom-input[disabled] {
		opacity: .2;
		}

		
      .cropit-image-preview {
        background-color: #FFFFFF;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 500px;
        height: 500px;
        cursor: move;
      }

      .cropit-image-background {
        opacity: .2;
        cursor: auto;
      }

      .image-size-label {
        margin-top: 10px;
      }

      input {
        display: block;
      }

      button[type="submit"] {
        margin-top: 10px;
      }
     }
    </style>