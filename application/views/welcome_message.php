<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Flickr Project - Recent Photos API Integration using cURL</title>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 5px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		/*border-bottom: 1px solid #D0D0D0;*/
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 0px;
	}
	
	h2 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 0px 0px 5px 0px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		/*border-top: 1px solid #D0D0D0;*/
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 0px;
		padding: 0px;
	}
	
	#container_inner {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
		padding: 10px;
	}
	
	.span_size {
		display: none;		
	}
	
	.span_size_name {
		font-size: 13px;
	}
	</style>
	<script>
	$( document ).ready(function() {
		$( ".preview" ).on( "click", function() {
			var photo_id = $(this).attr('id');
			var photo_src = $(this).attr('photo_src');
			var photo_label = $(this).attr('alt');
			
			$('#img_'+photo_id).attr('src', photo_src );
			$('#h2_'+photo_id).html(photo_label + ' Size');
		});
		
		$( ".img_image" ).on( "click", function() {
			var photo_id = $(this).attr('id').replace("img_", "");;
			$('#span_'+photo_id).toggle();
		});
			
	});
	</script>
</head>
<body>

<div id="container">
	<center><h1>Flickr Project - 'Recent Photos' API Integration using cURL</h1></center>
	<div id="body">
		<?php
		foreach($recentphotos as $photo){
			?><div id="container_inner"><?php
				$cnt = 0;
				$thumbnail_src = "";
				$size_string = "";
				foreach($photo['Sizesphotos'] as $sizesphotos){
				 $size_string .= '<a class="preview" href="JavaScript:Void(0);" id="'.$photo['id'].'" photo_src = "'.$sizesphotos['source'].'" alt = "'.$sizesphotos['label'].'" >'.$sizesphotos['label']. '</a> ('.$sizesphotos['width'].'x'.$sizesphotos['height'].') | ';
					 
				 if($sizesphotos['label'] == "Thumbnail") {
					$thumbnail_src =  $sizesphotos['source'];
				 }
				 
				}
				?>
				<h2>
					<?php echo $photo['title'];?> : <span class="span_size_name" id="h2_<?php echo $photo['id'];?>">Thumbnail Size</span>
				</h2>
				<img class="img_image" id='img_<?php echo $photo['id'];?>' title ="Click Here" src='<?php echo $thumbnail_src;?>'> </br> 
				<span id="span_<?php echo $photo['id'];?>" class="span_size">
					<b>Sizes:</b> <?php echo rtrim($size_string,"| ");?> 
				</span>
			</div><?
		}
		?>
	</div>
	<p class="footer">@All Rights Reserved By Sham H.</p>
</div>
</body>
</html>