<div class="container" style="margin-top:0px;">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="page-title">Hasil Pencarian</h1>
			<legend></legend>
			<?php $this->load->helper(array('form', 'search')); ?>
				
			<?php if ( ($key['results']) != " " ): ?>
				<?php if (count($key['results'])): ?>
					<p><?php echo $key['total_results'] ?> konten yang cocok dengan kata <b>'<?php echo urldecode($key['search_terms']); ?>'</b>.</p>
					<legend></legend>
					<ul>
					<?php foreach ($key['results'] as $result) :?>			
						<li><a href="<?php 
										$slug = url_title($result->title, 'dash', true);
											echo site_url($result->url.'/'.$slug); 
									?>">
						<h3><?php echo search_highlight(strip_tags($result->title), urldecode($key['search_terms']))?></h3></a>
						<?php echo search_extract(strip_tags($result->content), urldecode($key['search_terms'])) ?>		
						</li>
					<legend></legend>
					<?php endforeach ?>
					</ul>
					
					<?php //echo $this->pagination->create_links(); ?>
					
				<?php else: ?>
					<p><em>Konten tidak ditemukan.</em></p>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
</div>