<?php 	
	$logo_desa = $konten_logo->konten_logo_desa;
?>

	<div class="row">
		<div class="col-md-6">
			<h3>Selamat Datang <b>Pengelola Aset</b></h3>
			<legend></legend>
		</div>
		<div class="col-md-6" >
		<img src="<?php echo site_url($logo_desa); ?>" style="float:right; height:fixed; width:250px; margin-top:20px; margin-bottom:-40px;"> 		
		</div>
		<div class="col-md-12">
			<a href="<?php echo site_url('aset/c_aset/add');?>">
				<button type="button" class="btn btn-success"><i class="fa fa-plus-square fa-fw"></i> Tambah Aset</button>
			</a>
			<a href="<?php echo site_url('aset/c_aset/');?>">
				<button type="button" class="btn btn-success"><i class="fa fa-list fa-fw"></i> Daftar Aset</button>
			</a>			
		</div>
	</div>
	<br>
	
		
	<div class="row">
        <div class="col-md-6 col-lg-4 col-sm-6 col-xs-12">
          <div class="info-box bg-blue">
		  <a href="<?php echo site_url('aset/c_tanah/');?>"</a>
            <span class="info-box-icon"><i class="fa fa-th-large"></i></span>
		  </a>
            <div class="info-box-content">
              <span class="info-box-text">Tanah</span>
              <span class="info-box-number"><?php echo $tanah;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-lg-4 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
		  <a href="<?php echo site_url('aset/c_bangunan/');?>"</a>
            <span class="info-box-icon"><i class="fa fa-bank"></i></span>
		  </a>
            <div class="info-box-content">
              <span class="info-box-text">Bangunan</span>
              <span class="info-box-number"><?php echo $bangunan;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-lg-4 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
		  <a href="<?php echo site_url('aset/c_aset/');?>"</a>
            <span class="info-box-icon"><i class="fa fa-archive"></i></span>
		  </a>
            <div class="info-box-content">
              <span class="info-box-text">Aset</span>
              <span class="info-box-number"><?php echo $aset;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->        
        </div>
        <!-- /.col -->
        
      </div>
	
     
		


<script>
function nav_active(){
	document.getElementById("a-pengelola-aset").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>
