<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>

<?php
echo $js_grid;
?>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function edit_publish(id) {
  
  $.ajax({
   type: "POST",
   url: "<?=site_url("admin/c_jurnalisme/update_publish/");?>",
   data: "items="+id,
   success: function(data){
		$('#flex1').flexReload();
		
		} ,
		error: function() {
			alertify.error("Maaf, terjadi kegagalan koneksi !");
		}
	});
}

function show_detail(id) {
  $("#MyModalBody").html('<iframe src="<?php echo base_url();?>admin/c_jurnalisme/show_detail/'+id+'" width="100%" height="350" frameborder="no"></iframe>');
  
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
		window.location = _base_url + 'admin/c_berita/add';
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
					   url: "<?=site_url("admin/c_berita/delete/");?>",
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

</script>

<script>
function nav_active(){
	
	document.getElementById("a-data-web").className = "collapsed active";
	
	document.getElementById("pengelola_data_web").className = "collapsed";

	var d = document.getElementById("nav-jurnalisme");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>

<h3><?= $page_title ?></h3>

<table id="flex1" style="display:none"></table>

<!-- Modal -->
<div class="modal fade" id="dialog-print" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 95%; height :100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" ><span class="fa fa-eye"></span>&nbsp;Detil Berita</h4>
      </div>
      <div class="modal-body" id="MyModalBody" >
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times"></span> Tutup</button>
        </div>
    </div>
  </div>
</div>
<!-- akhir kode modal dialog -->

