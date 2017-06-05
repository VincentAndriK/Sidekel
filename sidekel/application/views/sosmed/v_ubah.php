<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('admin/c_sosmed/update'); ?>


<fieldset>
	<legend></legend>
	<!-- Text input-->
	<div class="form-group">
		<label  class="col-md-3 control-label" for="deskripsi">Link Facebook</label>
		<div class="col-md-9">
			<input  value="<?= $hasil->link_facebook?>" id="link_facebook" name="link_facebook" type="text" placeholder="contoh : https://www.facebook.com/Kemkominfo/" class="form-control input-md">
			<span class="help-block"></span>  
		</div>
	</div>
	
	<!-- Text input-->
	<div class="form-group">
		<label  class="col-md-3 control-label" for="deskripsi">Link Twitter</label>
		<div class="col-md-9">
			<input  value="<?= $hasil->link_twitter?>" id="link_twitter" name="link_twitter" type="text" placeholder="contoh : https://twitter.com/kemkominfo" class="form-control input-md">
			<span class="help-block"></span>  
		</div>
	</div>

	<legend></legend>
	
	<!-- Text input-->
	<div class="form-group">
		<label  class="col-md-3 control-label" for="deskripsi">Widget Twitter</label>
		<div class="col-md-9">
			<textarea  id="widget_twitter" name="widget_twitter" type="text" 
			placeholder="Twitter -> Setting -> Widget" class="form-control input-md" rows="2"><?= $hasil->widget_twitter?></textarea>
			<span class="help-block"></span>  
		</div>
		<div class="col-md-9 pull-right">
			<?= $hasil->widget_twitter?>
		</div>
	</div>
	<legend></legend>
</fieldset>



<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>admin/c_sosmed'"/>

</p>


<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs)}}(document,"script","twitter-wjs");</script>

<script>

function nav_active(){

	document.getElementById("a-data-web").className = "collapsed active";
	
	var r = document.getElementById("pengelola_data_web");
	r.className = "collapsed";

	var d = document.getElementById("nav-sosmed");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
  
});
</script>