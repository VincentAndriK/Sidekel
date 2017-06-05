<link rel="stylesheet" href="<?php echo base_url();?>assetku/fancybox/jquery.fancybox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetku/fancybox/helpers/jquery.fancybox-thumbs.css" />
	
<div class="container">
<legend><h1>Galeri</h1></legend>
<section class="filter-section">
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="filter-container isotopeFilters">
			<?php
				foreach($galeri as $gal)
				{
					if($gal == 'foto')
					{
						$foto = 'foto';
					}
					else
					{
						$video = $gal;
					}
				}
			?>
				<!--<ul class="list-inline filter">
					<li class="active"><a href="#" data-filter="*">Tampil Semua </a><span> /</span></li>
					<li><a href="#" data-filter=".<?= $foto?>">Foto</a><span> /</span></li>
					<li><a href="#" data-filter=".<?= $video?>">Video</a></li>
				</ul>-->
			</div>
		</div>
	</div>
</section>
<section class="portfolio-section port-col">
    <div class="container" style="background-color:#fff;">
        <div class="row">
            <div class="isotopeContainer">

            <?php
                foreach($konten_galeri as $kon)
                {
                    if($kon->kategori == 'foto')
                    {
                    ?>
                        <div class="col-sm-3 isotopeSelector foto">
                           <article class="">
                                <figure>
                                    <img src='<?php echo site_url($kon->url);?>' alt="" style="height:250px;">
                                    <div class="overlay-background">
                                        <div class="inner"></div>
                                    </div>
                                    <div class="overlay">
                                        <div class="inner-overlay">
                                            <div class="inner-overlay-content with-icons">
                                                <a title="<?=$kon->judul?>" class="fancybox-pop" rel="portfolio-1" href="<?php echo site_url($kon->url)?>"><i class="fa fa-search"></i></a>
                                                <!--<a href="#"><i class="fa fa-link"></i></a>-->
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                                <div class="article-title"><a href="#"><?=$kon->judul?></a></div>
                            </article>
                        </div>
                    <?php 
                    }
                    else
                    {
                        $a = $kon->url;
                        $b = str_replace('https://www.youtube.com/watch?v=', "", $a);
                    ?>
                         <div class="col-sm-3 isotopeSelector video">
                            <article class="">
                                <figure>
                                    <img src="http://img.youtube.com/vi/<?=$b?>/0.jpg" alt="" style="height:250px;">
                                    <div class="overlay-background">
                                        <div class="inner"></div>
                                    </div>
                                    <div class="overlay">
                                        <div class="inner-overlay">
                                            <div class="inner-overlay-content with-icons">
                                                <a title="<?=$kon->judul?>" class="fancybox-pop" rel="portfolio-4 " href="https://www.youtube.com/watch?v=<?=$b?>"><i class="fa fa-play"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                                <div class="article-title"><a href="#"><?=$kon->judul?></a></div>
                            </article>
                        </div>
                    <?php    
                    }
                }
            ?>
            
            
           
			
            </div>
            
        </div>
    </div>
    <div class="col-sm-12">
                <!-- <button type="button" class="btn btn-berita btn-block">MEMUAT BERITA SELANJUTNYA</button> -->
    <?php echo $this->pagination->create_links(); ?>
</div>
</section>
</div>

<br>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/fancybox/helpers/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assetku/isotope/isotope.min.js"></script>

<script type="text/javascript" charset="utf-8">			
	function nav_active(){
	var r = document.getElementById("nav-home");
	r.className = "";

	var d = document.getElementById("nav-galeri");
	d.className = d.className + "active";
	}
</script>
<script>
jQuery(document).ready(function($) {
/*
|--------------------------------------------------------------------------
| Global myTheme Obj / Variable Declaration
|--------------------------------------------------------------------------
|
|
|
*/
	var myTheme = window.myTheme || {},
    $win = $( window );
/*
|--------------------------------------------------------------------------
| isotope
|--------------------------------------------------------------------------
|
|
|
*/
	myTheme.Isotope = function () {
	
		// 4 column layout
		var isotopeContainer = $('.isotopeContainer');
		if( !isotopeContainer.length || !jQuery().isotope ) return;
		$win.load(function(){
			isotopeContainer.isotope({
				itemSelector: '.isotopeSelector'
			});
		$('.isotopeFilters').on( 'click', 'a', function(e) {
				$('.isotopeFilters').find('.active').removeClass('active');
				$(this).parent().addClass('active');
				var filterValue = $(this).attr('data-filter');
				isotopeContainer.isotope({ filter: filterValue });
				e.preventDefault();
			});
		});
	
	};
/*
|--------------------------------------------------------------------------
| Fancybox
|--------------------------------------------------------------------------
|
|
|
*/
	myTheme.Fancybox = function () {
		//$(".fancybox-pop").attr('rel', 'media-gallery').fancybox({
		$(".fancybox-pop").fancybox({ 
			fitToView	: true,
			width		: 700,
			height		: 500,
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'elastic',
			closeEffect	: 'none',
            arrows : false,
			helpers : {
					thumbs : {
						width  : 50,
						height : 50
					},
					media: {}, // requires to include media js file
					buttons: {} // requires to include buttons js and css files
				}
			
		});
	};	
/*
|--------------------------------------------------------------------------
| Functions Initializers
|--------------------------------------------------------------------------
|
|
|
*/
	myTheme.Isotope();
	myTheme.Fancybox();
});
</script>
