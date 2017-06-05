<h2><?= $page_title ?></h2>
<?php echo form_open('indikatorkesejahteraan/c_rumah_warga/simpan_rumah_warga'); ?>
<fieldset>
<legend></legend>
	<input  value="<?= $id->id_keluarga?>" id="idd" name="idd" type="hidden" placeholder="id" class="form-control input-md">
	<div class="form-group">
    	<label class="col-md-3 control-label" for="nama"> Nama </label> 
        <div class="col-md-9">
        <span class="help-block">
        <input class="form-control input-md" type="text" name="nama" value="<?= $penduduk->nama?>" size="30" readonly="readonly" style="text-transform: uppercase" required/> </span>
	</div>
</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="koor">Koordinat</label>  
		<div class="col-md-9">
		<input id="koor" name="koor" type="text"  placeholder="Koordinat" readonly="readonly"class="form-control input-md" />
		<span class="help-block"> <?php echo form_error('koor', '<p class="field_error">','</p>')?>
	</span>  
	</div>
</div>
<p>
	<button id="simpan" name="simpan" class="btn btn-success">Simpan</button>
	<button id="batal" name="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_rumah_warga'">Batal</button>
</p>
<legend></legend>
<div class="row">
	<div class="col-md-12 map">
		<div id = "map" class = "col-md-12" style="height:500px;"></div> 
		<div id="legend">		
		  <table id="legend_table">
			<tr>
				<td><div style="width:10px;height:10px;border:1px solid; background-color:#FF0000; text-transform: capitalize;"></div></td>
				<td>Batas Wilayah</td>
				<td style="text-align:right;"></td>
			</tr>
		  <table>
		</div>		
	</div>
</div>
</fieldset>
	  
<?php echo form_close(); ?>
<script>
var jsonTampil = <?= $tampil?>;
var poly = {};
var path = [];
function overlayClickListener(overlay) { 
    google.maps.event.addListener(overlay, "mouseup", function(event){
        $('#coord').val(overlay.getPath().getArray());
    });
}
function initMap() {
var myLatlng = new google.maps.LatLng(<?= $peta->center?>);
  map = new google.maps.Map(document.getElementById('map'), {
    //center: {lat: -8.53671, lng: 115.331},
	center: myLatlng,
    zoom: 12
  });
  
  var overlayShapes = [];
  var drawingManager = new google.maps.drawing.DrawingManager({
    drawingMode: google.maps.drawing.OverlayType.HAND,
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_RIGHT,
      drawingModes: [
        google.maps.drawing.OverlayType.POLYGON
      ]
    },
    polygonOptions:{
      editable: true,
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#03a9f4',
      clickable: true,
      geodesic: true,
      fillOpacity: 0.35
    }
  });
  drawingManager.setMap(map);
  
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
	
  var centerControlDiv = document.createElement('div');
  var centerControl = new CenterControl(centerControlDiv, map, drawingManager, overlayShapes);

  centerControlDiv.index = 1;
  map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(centerControlDiv);

  google.maps.event.addListener(drawingManager, "overlaycomplete", function(event){
    overlayShapes.push(event.overlay);
    overlayClickListener(event.overlay);
    $('#koor').val(event.overlay.getPath().getArray());
  });
}
function CenterControl(controlDiv, map, drawingManager, overlayShapes) {

  // Set CSS for the control border.
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = '#d9534f';
  controlUI.style.border = '2px solid #d9534f';
  controlUI.style.borderRadius = '3px';
  controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
  controlUI.style.cursor = 'pointer';
  controlUI.style.marginBottom = '15px';
  controlUI.style.textAlign = 'center';
  controlUI.title = 'Klik untuk membersihkan peta!';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  var controlText = document.createElement('div');
  controlText.style.color = 'rgb(255,255,255)';
  controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
  controlText.style.fontSize = '16px';
  controlText.style.lineHeight = '38px';
  controlText.style.paddingLeft = '5px';
  controlText.style.paddingRight = '5px';
  controlText.innerHTML = 'Bersihkan Peta';
  controlUI.appendChild(controlText);

  // Setup the click event listeners: simply set the map to Chicago.
  controlUI.addEventListener('click', function() {
    drawingManager.setMap(null);
        overlayShapes.forEach(function(item){
            item.setMap(null);
        });
        $('#koor').val('');
        drawingManager.setMap(map);
  });
  
  

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
</style>
<script>
function nav_active(){
	document.getElementById("a-rumah_kemiskinan").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg-c2SFJ9Vodw8dnvBVQzjL1uBr1HTFYk&callback=initMap"
async defer> 
</script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg-c2SFJ9Vodw8dnvBVQzjL1uBr1HTFYk&libraries=drawing&callback=initMap"
         async defer>
</script>