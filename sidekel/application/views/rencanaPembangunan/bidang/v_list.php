<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>


<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<?php
echo $js_grid;
?>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function edit_bidang(id) {
  window.location = _base_url + 'rencanaPembangunan/c_bidang/edit/' + id;
}

function add_sub_bidang(id) {
  window.location = _base_url + 'rencanaPembangunan/c_bidang/add_sub_bidang/' + id;
}

function show_detail_bidang(id) {
  window.location = _base_url + 'rencanaPembangunan/c_bidang/show_detail_bidang/' + id;
}

function show_tree_bidang(id) {
  window.location = _base_url + 'rencanaPembangunan/c_bidang/show_tree_bidang/' + id;
}

function btn(com,grid)
{
    if (com=='Select All')
    {
		$('.bDiv tbody tr',grid).addClass('trSelected');
    }

    if (com=='DeSelect All')
    {
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
	
	if (com=='Add')
    {
		window.location = _base_url + 'rencanaPembangunan/c_bidang/add';
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
					   url: "<?=site_url("rencanaPembangunan/c_bidang/delete/");?>",
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

$(function(){
  
});
</script>


<table id="flex1" style="display:none"></table>



<script>
function nav_active(){
	
	document.getElementById("a-data-pustaka_per").className = "collapsed active";
	document.getElementById("pustaka_per").className = "collapsed active";

	var d = document.getElementById("nav-bidang");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>