<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>


<?php 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open('indikatorkesejahteraan/c_sensus/simpan_tambah_pertanyaan',$attributes); ?>

<fieldset>
	<legend></legend>
	<!-- Text input-->
	<div class="form-group">
		<div class="col-md-12">
			<input  value="<?= $hasil->id_sensus?>" id="id_sensus" name="id_sensus" type="hidden" placeholder="id" class="form-control input-md">
			<input  id="rows" name="rows" type="hidden"  class="form-control input-md">
			<span class="help-block"><?php echo form_error('id_sensus', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="tes_1">Indikator </label>
        <div class="col-md-9">
         <?php $id = 'id="tes_1" class="form-control input-md" required';
				echo form_dropdown('tes_1',$indikator,'',$id)?>
         <span class="help-block"> </span>
		</div>
	</div>
	
	
	<div class="form-group">
		<label  class="col-md-3 control-label" for="Pertanyaan">Pertanyaan</label>
		<div class="col-md-9">
			<input   id="Pertanyaan_1" name="pertanyaan_1" type="text" 
			placeholder="Pertanyaan" class="form-control input-md" required>
			<span class="help-block"><?php echo form_error('Pertanyaan', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	
	<div class="col-md-12">
	<button name="add_btn"  id="add_btn" class="btn btn-success btn-flat">
		<i class="fa fa-plus-square"></i> Tambah Pilihan Jawaban
	</button>	
	</div>
	<div class="form-group">
		<div id="container">
		
			<label class=" control-label" for="Pertanyaan" type="hidden"> </label>
		</div>		
	</div> 
	<legend></legend>

<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<!--<input type="button" value="Simpan & Tambah Pertanyaan"  id="lanjut" class="btn btn-primary" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_sensus/simpan_tambah_pertanyaan_lagi/<?= $hasil->id_sensus?>'"/>-->
<input type="button" value="Batal" id="batal" class="btn btn-danger"onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_sensus'"/>
</p>
<?php echo form_close(); ?>
</fieldset>
<script>
$(document).ready(function() {
            
        }); 
		
		var count = 0;
            $("#add_btn").click(function(e){
					e.preventDefault();
                    count += 1;
					document.getElementById("rows").value = count;
                $('#container').append(
						
						 '<fieldset><div class="form-group">'
						+'<legend></legend>'
						 
						+ '<span class="help-block"></span>'
						+ '</div>'
						 +'<span class="help-block"></span>'
						+ '<div class="form-group">'
							+ '<label class="col-md-3 control-label" for="jawaban_'+count+'">Pilihan Jawaban </label>'
							+ '<div class="col-md-9">'
								+ '<input id="jawaban_'+count+'" name="jawaban_'+count+'" type="text" class="form-control input-md-" placeholder="Pilihan Jawaban">'
								+ '<span class="help-block"></span>'
							+ '</div>'
						+ '</div>'
						+ '<div class="form-group">'
							+ '<label class="col-md-3 control-label" for="nilai_'+count+'">Nilai </label>'
							+ '<div class="col-md-9">'
								+ '<input id="nilai_'+count+'" name="nilai_'+count+'" type="text" class="form-control input-md-"  placeholder="Bobot" onkeypress="return numbersonly(event)">'
								+ '<span class="help-block"></span>'
							+ '</div>'
						+ '</div>'
						+ '<label class="col-md-3 control-label" for="Pertanyaan" type="hidden"> </label></fieldset>'
                       
						
                    );
					
                });
			
$("#myform").submit(function() {
    $.ajax({
           type: "POST",
           url: url,
           data: $("#myform").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });

    return true; // avoid to execute the actual submit of the form.
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

