<h3><?= $page_title ?></h3>

		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<button type="button" class="btn btn-danger" aria-label="Left Align" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_sensus'">
							 <span class="fa fa-arrow-circle-left"> Kembali</span>
							</button>
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="table-responsive">
<div class="col-lg-12 col-md-12">

	<table class='table table-striped'>
	 <thead>
      <tr>
        <th>Tanggal Sensus</th>
        <th>Indikator</th>
        <th>Pertanyaan</th>
      </tr>
    </thead>
	
	<tbody>
		<?php
			$i=0;
			foreach($pertanyaan as $rows)
			{
			$i++;
		?>
		<tr>
			<td><?php echo date('d-m-Y', strtotime($rows->tgl_sensus)); ?></td>
			<td><?php echo $rows->indikator; ?></td>
			<td><?php echo $rows->pertanyaan; ?></td>
		</tr>
		
		<?php
				}
		?>
		</tbody>
		
	</table>
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
	
	document.getElementById("a-pengelola_sensus").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>