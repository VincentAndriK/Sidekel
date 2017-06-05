<?php 	
	$logo_desa = $konten_logo->konten_logo_desa;
?>

	<div class="row">
		<div class="col-md-6">
			<h3><b>Grafik Pemetaan Kemiskinan</b></h3>
			<legend></legend>
		</div>
		<!--<div class="col-md-6" >
		<img src="<?php echo site_url($logo_desa); ?>" style="float:right; height:fixed; width:250px; margin-top:20px; margin-bottom:-40px;">
		<span class="help-block"> </span>
		</div>-->
		<!--<div class="col-md-3">
			<?php $id = 'id="sensus" class="form-control input-md" required';
				echo form_dropdown('sensus',$sensus,'',$id)?>
			</a>
		</div>-->
			<!--<a href="<?php echo site_url('datapenduduk/c_keluarga/');?>">
				<button type="button" class="btn btn-success"><i class="fa fa-list fa-fw"></i> Daftar Data Kepala Keluarga</button>
			</a>			
		-->
	</div>
	<br>
	<div class="row">	
		
	<div class="col-md-6" id="keluarga" style="margin: 0 auto;"></div>
	<div class="col-md-6" id="penduduk" style="margin: 0 auto;"></div>
			
		
		
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
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')],// darken
				[2, Highcharts.Color(color).brighten(-0.2).get('rgb')]
            ]
        };
    }); */
	
	Highcharts.setOptions ({ 
		colors : ['#000000','#008000','#FFFF00','#FFA500','#FF0000']
	});

   $('#keluarga').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Kemiskinan'
        },
        subtitle: {
            text: 'Berdasarkan Kelas Sosial Penduduk'
        },
        xAxis: {
            categories: [
                'Kelas Sosial'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Penduduk'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} KK</b></td></tr>',
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
        series: [{
            name: 'TidakDiketahui',
            data: [
					<?php echo $jumlah_status_tidakdiketahui ; ?>
				]

        }, {
            name: 'kaya',
            data: [
					<?php echo $jumlah_status_kaya ; ?>
				]
		}, {
			name: 'sedang',
			data: [
					<?php echo $jumlah_status_sedang; ?>]
		}, {
			name: 'miskin',
			data: [
					<?php echo $jumlah_status_miskin; ?> ]
		}, {
			name: 'SangatMiskin',
			data: [
					<?php echo $jumlah_status_sangatmiskin; ?>]
		}
		]
		
    });
	
	 $('#penduduk').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Grafik Kemiskinan'
        },
		subtitle: {
				text: 'Berdasarkan Kelas Sosial Penduduk'
		},
        tooltip: {
            //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			headerFormat: '<span style="font-size:10px">{point.key}: {point.percentage:.1f}%</span><table><br>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Jiwa</b></td></tr>',
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
                    connectorColor: ''
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'sebanyak',
            data: [
					['TidakDiketahui ',<?php echo $jumlah_status_tidakdiketahui ; ?>],
					['Kaya ',<?php echo $jumlah_status_kaya ; ?>],
					['Sedang ',<?php echo $jumlah_status_sedang ; ?>],
					['Miskin ',<?php echo $jumlah_status_miskin ; ?>],
					['SangatMiskin ',<?php echo $jumlah_status_sangatmiskin ; ?>],
						
				]            
       
	   }]
    });
});

	
</script>



</script>


<script>
function nav_active(){
	document.getElementById("a-grafik_kemiskinan").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts-3d.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/exporting.js"></script>