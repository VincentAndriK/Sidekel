<script src="https://maps.googleapis.com/maps/api/js?v=3.exp?key=AIzaSyCRDoMePSoMWD2msayB5PdOK-KqxHFW6B0"></script>
<!-- Custom CSS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/maps/overlay.js"></script>

<script>
var map;
var _base_url = '<?= base_url() ?>';
var jsonPeta = <?= $rumah?>;
var jsonAnak = <?= $anak?>;
var jsonMarker = <?= $marker?>;
var jsonCount = <?= $count?>;
var jsonStatus = <?= $status?>;
var poly = {};
var path = [];
var mark;
var marquez = [];
var rossi = [];
function initialize() {
	var myLatlng = new google.maps.LatLng(<?= $peta->center?>);
	var mapOptions = {
		zoom: 12,
        center: myLatlng,
        draggableCursor: 'default',
        draggingCursor: 'pointer',
        scaleControl: true,
        mapTypeControl: true,
        mapTypeId: google.maps.MapTypeId.<?= $peta->type;?>,
        streetViewControl: false
	};
	map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
	var btn = document.getElementById('eye1');
	var btn2 = document.getElementById('eye2');

	map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(btn);
	map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(btn2);
	//////LEGEND//////
	map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
	document.getElementById('legend'));
	//////LEGEND//////
	
	//////LEGEND//////
	map.controls[google.maps.ControlPosition.RIGHT_TOP].push(
	document.getElementById('overlay_button'));
	//////LEGEND//////
	
			<?php 
			
				echo $batas_wilayah;
			?>
			var markerImage1 = '<?= base_url() ?>images/markerKaya.png';
			var markerImage2 = '<?= base_url() ?>images/markerMisskin.png';
			var markerImage3 = '<?= base_url() ?>images/markerSangatMiskin.png';
			var markerImage4 = '<?= base_url() ?>images/markerSedang.png';
			var markerImage5 = '<?= base_url() ?>images/markerTidakDiketahui.png';
			
			for(j=0;j<jsonMarker.length;j++){
				var a = jsonMarker[j].marker;
				var hasil = a.split(",");
				console.log(hasil[1]);
				var lat = hasil[0];
				var lng = hasil[1];
				
				if(jsonStatus[j].status == 'Kaya')
				{
					var marker = new google.maps.Marker({
					position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
					icon: markerImage1,
					map: map
					});
				}
				else if(jsonStatus[j].status == 'Sedang')
				{
					var marker = new google.maps.Marker({
					position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
					icon: markerImage4,
					map: map
					});
				}
				else if(jsonStatus[j].status == 'Miskin')
				{
					var marker = new google.maps.Marker({
					position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
					icon: markerImage2,
					map: map
					});
				}
				else if(jsonStatus[j].status == 'Sangat Miskin')
				{
					var marker = new google.maps.Marker({
					position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
					icon: markerImage3,
					map: map
					});
				}
				else if(jsonStatus[j].status == 'Tidak Diketahui')
				{
					var marker = new google.maps.Marker({
					position: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
					icon: markerImage5,
					map: map
					});
				}
				attachMarkerInfoWindow(marker, 'NO KK <b>'+jsonPeta[j].no_kk+'</b>'+'<br>'+'Nama KK <b>'+jsonPeta[j].nama+
			'</b>'+'</b>'+'<br>'+'Status <b>'+jsonStatus[j].status+'</b>'+'<br>Jumlah Anggota Keluarga 				   <b>'+jsonCount[j].jumlah+'</b>'+'<br>Jumlah Anak <b>'+jsonAnak[j].anak+'</b>');
				google.maps.event.addListener(marker, 'click', function() {
				  map.panTo(this.getPosition());
				}); 
				marker.setMap(null);
				marquez.push(marker);
		  }
		  
		for(i=0;i<jsonPeta.length;i++){
			coordArray = JSON.parse(jsonPeta[i].koordinat_polygon);
			coordArray.forEach(function(entry){
			  path.push(new google.maps.LatLng(entry[0],entry[1]));
			});
			
			if(jsonStatus[i].status == 'Kaya')
			{
				poly[i] = new google.maps.Polygon({
				  paths: path,
				  editable: false,
				  strokeColor: '#008000',
				  strokeOpacity: 0.8,
				  strokeWeight: 0.5,
				  fillColor: '#008000',
				  clickable: true,
				  fillOpacity: 0.35
				});
			}
			else if(jsonStatus[i].status == 'Sedang')
			{
				poly[i] = new google.maps.Polygon({
				  paths: path,
				  editable: false,
				  strokeColor: '#FFFF00',
				  strokeOpacity: 0.8,
				  strokeWeight: 0.5,
				  fillColor: '#FFFF00',
				  clickable: true,
				  fillOpacity: 0.35
				});
			}
			else if(jsonStatus[i].status == 'Miskin')
			{
				poly[i] = new google.maps.Polygon({
				  paths: path,
				  editable: false,
				  strokeColor: '#FFA500',
				  strokeOpacity: 0.8,
				  strokeWeight: 0.5,
				  fillColor: '#FFA500',
				  clickable: true,
				  fillOpacity: 0.35
				});
			}
			else if(jsonStatus[i].status == 'Sangat Miskin')
			{
				poly[i] = new google.maps.Polygon({
				  paths: path,
				  editable: false,
				  strokeColor: '#FF0000',
				  strokeOpacity: 0.8,
				  strokeWeight: 0.5,
				  fillColor: '#FF0000',
				  clickable: true,
				  fillOpacity: 0.35
				});
			}
			else if(jsonStatus[i].status == 'Tidak Diketahui')
			{
				poly[i] = new google.maps.Polygon({
				  paths: path,
				  editable: false,
				  strokeColor: '#000000',
				  strokeOpacity: 0.8,
				  strokeWeight: 0.5,
				  fillColor: '#FF0000',
				  clickable: true,
				  fillOpacity: 0.35
				});
			}
			
			 poly[i].setMap(map);
			attachPolygonInfoWindow(poly[i], 'NO KK <b>'+jsonPeta[i].no_kk+'</b>'+'<br>'+'Nama KK <b>'+jsonPeta[i].nama+
			'</b>'+'</b>'+'<br>'+'Status <b>'+jsonStatus[i].status+'</b>'+'<br>Jumlah Anggota Keluarga <b>'+jsonCount[i].jumlah+'</b>'
			+'<br>Jumlah Anak <b>'+jsonAnak[i].anak+'</b>'); 
			path = []; 
			console.log(poly[i]);
			rossi.push(poly[i]);
		  }
		  
		  $('#eye1').click(function(e) {
			for (var i = 0; i < marquez.length; i++) {
				marquez[i].setMap(map);
			  }
			   for(var j=0;j<rossi.length;j++){
				 rossi[j].setMap(null);
			   }
			});
		  $('#eye2').click(function(e) {
			for (var i = 0; i < marquez.length; i++) {
				marquez[i].setMap(null);
			  }
			   for(var j=0;j<rossi.length;j++){
				 rossi[j].setMap(map);
			  }
			});
	
}

	//initialize();
google.maps.event.addDomListener(window, 'load', initialize);

function attachMarkerInfoWindow(marker, html)
{
  marker.infoWindow = new google.maps.InfoWindow({
    content: html,
  });
  google.maps.event.addListener(marker, 'mouseover', function() {
    marker.infoWindow.open(map,marker);
  });
  google.maps.event.addListener(marker, 'mouseout', function() {
    marker.infoWindow.close();
  });
}
function attachPolygonInfoWindow(polygon,html)
{
	polygon.infoWindow = new google.maps.InfoWindow({
	content:html,
	});
	google.maps.event.addListener(polygon,'click',function(e){
	var latLng = e.latLng;
	
	polygon.infoWindow.setPosition(latLng);
	polygon.infoWindow.open(map);
	})
}	

  

</script>
<link href="<?php echo base_url(); ?>assetku/maps/style.css" rel="stylesheet">
<style>
  #legend {
    background: rgba(255,255,255,0.4);
    padding: 5px;
  } 
  #overlay_button {
    padding: 5px;
	margin: 5px;
  }
  #legend_table tr td {
    padding: 5px;
  }
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }  
</style>
<?php 	
	$logo_desa = $konten_logo->konten_logo_desa;
?>
<fieldset>
<div class="row">
	<div class="col-md-6">
		<h3>Selamat Datang <b>Pengelola Sensus Kemiskinan</b></h3>
		<legend></legend>
	</div>
	<div class="col-md-6" >
		<img src="<?php echo site_url($logo_desa); ?>" style="float:right; height:fixed; width:250px; margin-top:10px; margin-bottom:10px;"> 		
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<a href="<?php echo site_url('indikatorkesejahteraan/c_sensus/');?>">
			<button type="button" class="btn btn-success"><i class="fa fa-eye fa-fw"></i> Lihat Data Sensus</button>
		</a>
		<a href="<?php echo site_url('indikatorkesejahteraan/c_jawaban_sensus/');?>">
			<button type="button" class="btn btn-success"><i class="fa fa-eye fa-fw"></i> Lihat Data Hasil Sensus</button>
		</a>		
	</div>
</div>

<br>

<div class="row">
<div class="col-md-12">
			<span></span>
		</div>
	<div class="col-md-12 map">
  </head>
  <body>
		<div id="map_canvas"></div>
		<button id="eye1" type="button" class="btn btn-default btn-circle btn-lg" style="margin-bottom:10px; margin-right:5px;"><i class="fa fa-eye"></i>
        </button>
		<button id="eye2" type="button" class="btn btn-danger btn-circle btn-lg" style="margin-bottom:10px; margin-left:5px;"><i class="fa fa-eye-slash"></i>
        </button>
		<div id="legend">		
		  <table id="legend_table">
			
			<th colspan="3" style="text-align:left;">Keterangan</th>
			
			<?php 
			echo '<tr>
						<td colspan="1"><div style="width:10px;height:10px;border:1px solid; background-color:#008000; float:right;"></div></td>
						<td style=" text-transform: capitalize;">Kaya</td>
						<td style="text-align:right;"><b>'.$jumlah_status_kaya.'</b> Keluarga</td>
					</tr>';
			echo '<tr>
						<td colspan="1"><div style="width:10px;height:10px;border:1px solid; background-color:#FFFF00; float:right;"></div></td>
						<td style=" text-transform: capitalize;">Sedang</td>
						<td style="text-align:right;"><b>'.$jumlah_status_sedang.'</b> Keluarga</td>
					</tr>';
			echo '<tr>
						<td colspan="1"><div style="width:10px;height:10px;border:1px solid; background-color:#FFA500; float:right;"></div></td>
						<td style=" text-transform: capitalize;">Miskin</td>
						<td style="text-align:right;"><b>'.$jumlah_status_miskin.'</b> Keluarga</td>
					</tr>';
			echo '<tr>
						<td colspan="1"><div style="width:10px;height:10px;border:1px solid; background-color:#FF0000; float:right;"></div></td>
						<td style=" text-transform: capitalize;">Sangat Miskin</td>
						<td style="text-align:right;"><b>'.$jumlah_status_sangatmiskin.'</b> Keluarga</td>
					</tr>';
			echo '<tr>
						<td colspan="1"><div style="width:10px;height:10px;border:1px solid; background-color:#000000; float:right;"></div></td>
						<td style=" text-transform: capitalize;">Tidak Diketahui</td>
						<td style="text-align:right;"><b>'.$jumlah_status_tidakdiketahui.'</b> Keluarga</td>
					</tr>';
			echo '<tr>
						<td></td>
						<td style=" text-transform: capitalize;">Jumlah Keluarga</td>
						<td style="text-align:right;"><b>'.$jumlah_penduduk.'</b> Keluarga</td>
					</tr>';
			echo '<tr>
						<td></td>
						<td style=" text-transform: capitalize;">Anak Dalam Status Miskin</td>
						<td style="text-align:right;"><b>'.$total.'</b>&nbsp;Anak</td>
					</tr>';
			?>
		  </table>
		</div>		
	</div>
	
	<br>	
</div>
<br>
<div class="row">
	<div class="col-md-6" id="keluarga" style="margin: 0 auto;"></div>
	<div class="col-md-6" id="penduduk" style="margin: 0 auto;"></div>
</div>
</fieldset>
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
<script>
function nav_active(){
	
	document.getElementById("a-pengelola_kemiskinan").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/highcharts-3d.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/highchart/exporting.js"></script>