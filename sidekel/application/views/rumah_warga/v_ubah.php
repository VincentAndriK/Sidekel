<h2><?= $page_title ?></h2>
<?php echo form_open('indikatorkesejahteraan/c_rumah_warga/update_rumah_warga'); ?>
<legend></legend>
<!-- Text input------------------------------------------------------>
	
	<div class="form-group">
		<div class="col-md-9">
			<input  value="<?= $id->id_keluarga?>" id="idd" name="idd" type="hidden" placeholder="id" class="form-control input-md">
		</div>
	</div>
	</div>
	
	<div class="form-group">
    	<label class="col-md-3 control-label" for="nama"> Nama </label> 
        <div class="col-md-9">
         <span class="help-block">
         <input class="form-control input-md" type="text" name="nama" value="<?= $penduduk->nama?>" size="30" readonly="readonly" style="text-transform: uppercase" required/> </span>
	</div></div>
	<div class="form-group">
		  <label class="col-md-3 control-label" for="koor">Koordinat</label>  
		  <div class="col-md-9">
			<input id="koor" name="koor" type="text" value="<?=$koordinat_asli?>" placeholder="Koordinat" readonly="readonly"class="form-control input-md" />
			<span class="help-block"> <?php echo form_error('koor', '<p class="field_error">','</p>')?>
		  </span>  
		  </div>
	</div>
		<legend></legend>
	<p>
	<button id="simpan" name="simpan" class="btn btn-success">Simpan</button>
	<button id="batal" name="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>indikatorkesejahteraan/c_rumah_warga'">Batal</button>
</p>
	
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
	
	<?php echo form_close(); ?>
<script>


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
  
  var coordArray = [<?= $kor?>];

  var poly = new google.maps.Polygon({
    paths: coordArray,
    editable: true,
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#03a9f4',
      clickable: true,
      geodesic: true,
      fillOpacity: 0.35
  });
  poly.setMap(map);
  
    $('#remove_path').click(function(e) {
        e.preventDefault();
        drawingManager.setMap(null);
        poly.setMap(null);
        drawingManager.setMap(map);
    });
  
  google.maps.event.addListener(poly.getPath(), 'insert_at', function(index, obj) {
           //polygon object: yourPolygon
           $('#koor').val(poly.getPath().getArray());
  });
  google.maps.event.addListener(poly.getPath(), 'set_at', function(index, obj) {
           //polygon object: yourPolygon
           $('#koor').val(poly.getPath().getArray());
  });

  

  google.maps.event.addListener(drawingManager, "overlaycomplete", function(event){
    overlayShapes.push(event.overlay);
    overlayClickListener(event.overlay);
    $('#koor').val(event.overlay.getPath().getArray());
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