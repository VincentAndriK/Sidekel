<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>
<?php
echo $js_grid;
?>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function pengaturan_peta(id) {
  window.location = _base_url + 'peta/c_petaPotensi/pengaturan_peta/' + id;
}

function detail_potensi(id) {
  window.location = _base_url + 'peta/c_petaPotensi/lists2/' + id;
}

function btn(com,grid)
{
    if (com=='Select All')
    {
		$('.bDiv tbody tr',grid).addClass('trSelected');
    } 
	
	if (com=='Back')
    {
		window.location = _base_url + 'peta/c_petaPotensi/';
    }

    if (com=='DeSelect All')
    {
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
	
	if (com=='Add')
    {
		window.location = _base_url + 'aset/c_tanah/add';
    }	
	
	if (com=='Delete Selected Items')
        {
		
           if($('.trSelected',grid).length>0){
			   if(confirm('Hapus ' + $('.trSelected',grid).length + ' item?')){
		            var items = $('.trSelected',grid);
		            var itemlist ='';
		        	for(i=0;i<items.length;i++){
						itemlist+= items[i].id.substr(3)+",";
					}
					$.ajax({
					   type: "POST",
					   url: "<?=site_url("aset/c_tanah/delete/");?>",
					   data: "items="+itemlist,
					   success: function(data){
					   	$('#flex1').flexReload();
					  	alertify.success("Data berhasil dihapus !");
					   } ,
						error: function() {
							alertify.error("Maaf, data yang akan dihapus masih digunakan !");
						}
					});
				}
			} else {
				return false;
			}
        }
}

function nav_active(){
	document.getElementById("a-potensi").className = "collapsed active";
}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>
<div class="row">
<div class="col-md-9">
<h3><?= $page_title ?></h3>
</div>

</div>
<legend></legend>
<table id="flex1" style="display:none"></table>


<script>

function colorpick(id_ped_sub)
{
	//Color
	var color 	 = $('#colorpicker'+id_ped_sub).val();
	var info = {id_ped_sub: id_ped_sub, warna_peta: color}

	$.ajax({
	   type: "POST",
	   url: "<?=site_url("peta/c_petaPotensi/update_warna/");?>",
	   data: info,
	   success: function(data){
		//$('#flex1').flexReload();
		alertify.success("Pengaturan warna berhasil !");
	   } ,
		error: function() {
			alertify.error("Maaf, pengaturan warna gagal !");
		}
	});
}
		
</script>
