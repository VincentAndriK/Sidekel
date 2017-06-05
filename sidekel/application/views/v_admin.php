<?php 	
	$logo_desa = $konten_logo->konten_logo_desa;
	//$logo_kabupaten = $konten_logo->konten_logo_kabupaten;
?>
<div class="row">
		<div class="col-md-6">
			<h3>Selamat Datang <b>Administrator</b></h3>
			<legend></legend>
		</div>
		<div class="col-md-6" >
			<img src="<?php echo site_url($logo_desa); ?>" style="float:right; height:fixed; width:250px; margin-top:20px; margin-bottom:-40px;"> 		
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo site_url('admin/c_dusun/');?>">
				<button type="button" class="btn btn-success"><i class="fa fa-eye fa-fw"></i> Lihat Data Dusun</button>
			</a>
			<a href="<?php echo site_url('ped/c_ped/');?>">
				<button type="button" class="btn btn-success"><i class="fa fa-eye fa-fw"></i> Lihat Data Potensi Ekonomi Desa</button>
			</a>		
		</div>
	</div>
	<br>
	<div class="row">
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $jurnalisme;?></h3>
              <p>Jurnalisme Warga</p>
            </div>
            <div class="icon">
              <i class="fa fa-newspaper-o"></i>
            </div>
            <a href="<?php echo site_url('admin/c_jurnalisme/');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $ped;?></h3>
              <p>Detil Potensi Ekonomi Desa</p>
            </div>
            <div class="icon">
              <i class="fa fa-tree"></i>
            </div>
            <a href="<?php echo site_url('ped/c_ped/');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $regulasi;?></h3>
              <p>Regulasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="<?php echo site_url('admin/c_regulasi/');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
	
<div class="row">	
	<div class="col-md-12 col-lg-6" id="kategori" style="margin: 0 auto;"></div>
	<div class="col-md-12 col-lg-6" id="detil" style="margin: 0 auto;"></div>
</div>
		
		
	</div>
	<!-- /.row -->
     

<script type="text/javascript">
$(function () {

    // Radialize the colors
   /*  Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.1).get('rgb')], // darken				
               // [1, '#008D4D'] // darken				
            ],
        };
    }); */
	Highcharts.setOptions({
       colors: ['#0073B7','#DD4B39','#7CB833', '#f1c40f','#F39C12','#00C0EF','#008D4D','#005C92','#B13C2E','#00A3CB','#CF850F']
    });

   $('#kategori').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Potensi Ekonomi Desa'
        },
        subtitle: {
            text: 'Berdasarkan Jenis Lahan '
        },
        xAxis: {
            categories: [
                'Lahan'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Jenis</b></td></tr>',
            footerFormat: '</table>',
            shared: false,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
			<?php
				foreach($grafik_kategori as $key)
				{
					echo '{name:"'.$key->deskripsi. '",data:[' .$key->jumlah. ']},' ;
				}
			?>			
		]
		
    });
	
	 $('#detil').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Grafik Potensi Ekonomi Desa'
        },
		subtitle: {
				text: 'Berdasarkan Jenis Potensi Desa'
		},
        tooltip: {
            //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			headerFormat: '<span style="font-size:12px">{point.key}: {point.percentage:.1f}%</span><table><br>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} petak</b></td></tr>',
            footerFormat: '</table>',
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: '#00A65A'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'jumlah',
            data: [
					<?php
						foreach($grafik_detil as $key)
						{
							echo '["'.$key->deskripsi. '",' .$key->jumlah. '],' ;
						}
					?>						
				]            
       
	   }]
    });
});

	
</script>



</script>

<script>
function nav_active(){
	document.getElementById("a-admin").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts-3d.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/exporting.js"></script>