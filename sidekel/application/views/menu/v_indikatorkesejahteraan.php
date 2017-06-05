<div class="sidebar kiri" role="navigation">

			<ul id="sidebar_menu" class="sidebar-nav nav">
				<li class="sidebar-brand" > 
					<a id="menu-toggle" href="#"><i class="fa fa-align-justify fa-fw "></i> <span>Menu</span></a>
				</li>
			</ul>

			<div id="sidebar-wrapper">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">   
				
						<li> 
                            <a href="<?php echo site_url('c_pemetaankemiskinan');?>" id="a-pengelola_kemiskinan" class=""><i class="fa fa-globe fa-fw "></i> Beranda</a>
                        </li>
						
						<li> 
                            <a href="<?php echo site_url('indikatorkesejahteraan/c_sensus/');?>" id="a-pengelola_sensus"  class=""><i class="fa fa-book fa-fw "></i> Pengelolaan Sensus</a>
                        </li>
						<li> 
                            <a href="<?php echo site_url('indikatorkesejahteraan/c_jawaban_sensus/');?>" id="a-jawaban_sensus"  class=""><i class="fa fa-user fa-fw "></i> Hasil Sensus</a>
                        </li>
						<li> 
                            <a href="<?php echo site_url('indikatorkesejahteraan/c_rumah_warga');?>" id="a-rumah_kemiskinan" class=""><i class="fa fa-chain fa-fw "></i> Pemetaan Rumah Keluarga</a>
                        </li>
						<!---------------------DROPDOWN 1--------------------------------------------------------------->
						<li class="dropdownmenu">
						<a id="a-data-pustaka_lainnya" class="collapsed" data-toggle="collapse" href="#pustaka_lainnya">
						<i class="fa fa-list fa-fw"></i> Pustaka <span class="fa arrow"></span></a>
						<div id="pustaka_lainnya" class="collapse">
							<ul id="yw6" class="nav nav-pills nav-stacked nav-second-level">		
								<li id="nav-indikator" class="">	
									<a href="<?php echo site_url('indikatorkesejahteraan/c_indikator_kesejahteraan/');?>">Indikator Kesejahteraan</a>
								</li>		
								<li id="nav-pertanyaan" class="">
									<a href="<?php echo site_url('indikatorkesejahteraan/c_pertanyaan_sensus/');?>">Pertanyaan Sensus</a>		
								</li>
								<!--<li id="nav-jawaban" class="">
									<a href="<?php echo site_url('indikatorkesejahteraan/c_jawaban_sensus/');?>">Jawaban Sensus</a>		
								</li>-->
								<li id="nav-marker" class="">
									<a href="<?php echo site_url('indikatorkesejahteraan/c_marker_rumah/');?>">Marker Rumah Warga</a>		
								</li>
							</ul>
						</div>
						</li>
						<!------------------------------------------------------------------------------------>
						
                </div>
                <!-- /.sidebar-collapse -->
            </div>
        <!-- /.navbar-static-side -->
 </div>   
 
         <script>
$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar_menu").toggleClass("active");
        $("#sidebar-wrapper").toggleClass("active");
        $("#page-wrapper").toggleClass("active");
		
});
</script>