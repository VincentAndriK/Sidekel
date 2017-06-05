<h2><?= $page_title ?></h2>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open('indikatorkesejahteraan/c_pertanyaan_sensus/update_pertanyaan_sensus',$attributes); ?>

<fieldset>
	<legend></legend>
	<!-- Text input-->
	
			<input  value="<?= $hasil->id_sensus?>" id="id_sensus" name="id_sensus" type="hidden" placeholder="id" class="form-control input-md">
			<input  id="rows" name="rows" type="hidden"  class="form-control input-md">
			<input  value="<?= $hasil->id_pertanyaan?>" id="id_pertanyaan" name="id_pertanyaan" type="hidden" placeholder="id" class="form-control input-md">
			
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="indikator">Indikator </label>
        <div class="col-md-9">
         <?php $id = 'id="id_indikator" class="form-control input-md" required';
				echo form_dropdown('id_indikator',$id_indikator,$hasil->id_indikator,$id)?>
         <span class="help-block"> </span>
		</div>
	</div>
		
	<div class="form-group">
		<label  class="col-md-3 control-label" for="Pertanyaan">Pertanyaan</label>
		<div class="col-md-9">
			<input   value = "<?php echo $hasil->pertanyaan?>" id="Pertanyaan" name="pertanyaan" type="text" 
			placeholder="Pertanyaan" class="form-control input-md" required>
			<span class="help-block"><?php echo form_error('Pertanyaan', '<p class="field_error">','</p>')?></span>  
		</div>
	</div>
	
	<div class="form-group">
		<?php $i=0; ?>
			<?php foreach($pilihan as $rows){
					$i++;?>
					<label  class="col-md-3 control-label" for="Pilihan">Pilihan Jawaban</label>
						<div class="col-md-9">
							<input   value = "<?php echo $rows->id?>" id="id_<?php echo $i?>" name="id_<?php echo $i?>" type="hidden">
							<input   value = "<?php echo $rows->deskripsi?>" id="Pilihan_<?php echo $i?>" name="Pilihan_<?php echo $i?>"  
							placeholder="Pilihan" class="form-control input-md" required>
							<span class="help-block"><?php echo form_error('Pilihan', '<p class="field_error">','</p>')?></span> 
					</div>
					<label  class="col-md-3 control-label" for="Bobot">Nilai</label>
						<div class="col-md-9">
							<input   value = "<?php echo $rows->bobot?>" id="Bobot_<?php echo $i?>" name="Bobot_<?php echo $i?>" type="text" 
							placeholder="Bobot" class="form-control input-md" onkeypress="return numbersonly(event)"	required>
							<span class="help-block"><?php echo form_error('Bobot', '<p class="field_error">','</p>')?></span> 
						</div>
			<?php
			} 
			?>
	</div>
	
	<div class="col-md-9">
			<input type="button" name="add_btn" value="Tambah Pilihan Jawaban" id="add_btn" class="btn btn-success"/>
			
	</div>
	<div class="form-group">
		<div id="container">
			<label class="col-md-3 control-label" for="Pertanyaan" type="hidden"> </label>
		</div>		
	</div> 
	<legend></legend>
</fieldset>
<p>
<input type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
<input type="button" value="Batal" id="batal" class="btn btn-danger"onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_pertanyaan_sensus'"/>
</p>
<?php echo form_close(); ?>
<script>
$(document).ready(function() {
            
        }); 
		
		var count = 0;
            $("#add_btn").click(function(e){
                    count += 1;
					document.getElementById("rows").value = count;
                $('#container').append(
						
						 '<div class="form-group">'
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
						+ '<label class="col-md-3 control-label" for="Pertanyaan" type="hidden"> </label>'
                       
						
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
	
	document.getElementById("a-data-pustaka_lainnya").className = "collapsed active";
	
	document.getElementById("pustaka_lainnya").className = "collapsed";

	var d = document.getElementById("nav-pertanyaan");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>

