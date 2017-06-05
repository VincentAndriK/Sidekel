<?php
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:admin="http://webns.net/mvcb/"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:media="http://search.yahoo.com/mrss/"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
 
	<channel>
		<title><?php echo $feed_name; ?></title>
		<link><?php echo site_url($feed_url); ?></link>
		<description><?php echo $page_description; ?></description>
		<dc:language><?php echo $page_language; ?></dc:language>
		
		<?php foreach($posts as $row):?>	
		<?php $slug = url_title($row->title, 'dash', true); ?>
			<item>
				<title><?php echo $row->title; ?></title>
				<link><?php echo site_url($row->url. '/'.$slug); ?></link>
				<guid><?php echo $row->id ?></guid>
				<description><?php echo $row->content; ?> </description>
				<pubDate><?php echo $row->updated; ?></pubDate>
			</item>
		<?php endforeach; ?>
	</channel>
</rss>