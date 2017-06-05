<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>
<?php
echo $js_grid;
?>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

function edit_keluarga(id) {
  window.location = _base_url + 'indikatorkesejahteraan/c_rumah_warga/edit/' + id;
}
function tambah_data_rumah(id) {
  window.location = _base_url + 'indikatorkesejahteraan/c_rumah_warga/add/' + id;
}
function hapus_koordinat(id) {
	if(confirm('Apakah anda yakin ingin menghapus data koordinat rumah warga ? '))
	{
		window.location = _base_url + 'indikatorkesejahteraan/c_rumah_warga/delete/' + id;
	}
	else
	{
		
	}
}
/* function tambah_anggota(id) {
  window.location = _base_url + 'datapenduduk/c_keluarga/tambah_anggota/' + id;
}

function cetak(nik) {
  //window.location = _base_url + 'datapenduduk/c_cetak_kk/cetakByNIK/' + nik;
  $("#MyModalBody").html('<iframe src="<?php echo base_url();?>datapenduduk/c_cetak_kk/cetak/'+nik+'" width="100%" height="350" frameborder="no"></iframe>');
}

function tampil_anggota_keluarga(id) {
  window.location = _base_url + 'datapenduduk/c_keluarga/tampil_anggota_keluarga/' + id;
} */

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
		window.location = _base_url + 'indikatorkesejahteraan/c_rumah_warga/add/';
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
					   url: "<?=site_url("datapenduduk/c_keluarga/delete/");?>",
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

function nav_active(){
	document.getElementById("a-rumah_kemiskinan").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});

</script>
	<h3><?= $page_title ?></h3>

<table id="flex1" style="display:none"></table>

