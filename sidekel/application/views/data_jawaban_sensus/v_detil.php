<h3><?= $page_title ?></h3>
		<div class="form-group">
			<div class="col-md-9">
				<input  value="<?= $id_keluarga?>" id="id_keluarga" name="id_keluarga" type="hidden" placeholder="id" class="form-control input-md">
			</div>
		</div>
		
<div class="col-md-12">
	
					<?php if($locked == '0')
							{
							?>
						<span class="help-block"></span>
							<button type="button" style="float:left;"class="btn btn-danger" aria-label="Left Align" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_jawaban_sensus'">
							 <span class="fa fa-arrow-circle-left"> Kembali</span>
							</button>
						<span class="help-block"></span>	
						
						<?php 
							} else if($locked == '1'){
							
							?>
							<div class="alert alert-danger">
							
							<p> Jawaban Sensus Untuk Keluarga Ini Sudah Dikonfirmasi</p>
							</div>
						<?php 
						}
						?>
						
</div>
		
<div class="col-lg-12 col-md-12">

	<table class='table table-striped'>
	 <thead>
      <tr>
		<th>ID Pertanyaan</th>
        <th>Pertanyaan</th>
        <th>Jawaban</th>
		<th>Aksi</th>
      </tr>
    </thead>
	
	<tbody>
		<?php
			foreach($pertanyaan as $rows)
			{
					
		?>
			<tr>
				<td><?php echo $rows->id_pertanyaan; ?></td>
				<td><?php echo $rows->pertanyaan; ?></td>
				<td><?php echo $rows->jawaban; ?></td>
				<?php
					if($locked == 0)
					{
					?>
						<td><button type="button" class="btn btn-success" aria-label="Left Align" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_jawaban_sensus/edit/<?php echo $rows->id_pertanyaan;?>/<?php echo $rows->id_keluarga?>/<?php echo $rows->id_sensus;?>'"><span>Ubah</span></td>
						
				<?php
				}
				else
				{
					
				?>
				<td><button type="button" class="btn btn-success" aria-label="Left Align" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_jawaban_sensus/edit/<?php echo $rows->id_pertanyaan;?>/<?php echo $rows->id_keluarga?>/<?php echo $rows->id_sensus;?>'" disabled><span>Ubah</span></td>
						<?php
						}
						?>
				</tr>
		<?php
			}
		?>
		</tbody>
		
	</table>
	<div>
	<p>Total Nilai Keluarga : <?php 
						foreach($status as $rows)
						{
						?>
							<?php echo $rows->total_nilai;?>
						<?php
						}
						?>
						</p>
	</div>
	<div>
	<p>Kesimpulan : <?php 
						foreach($status as $rows)
						{
						?>
							<?php echo $rows->status;?>
						<?php
						}
						?>
						</p>
	</div>
</div>

							</div>
						</div>
						<!-- /.panel-body -->
					</div>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
<script>
	
	function nav_active(){
	
	document.getElementById("a-jawaban_sensus").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>