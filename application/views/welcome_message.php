<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Flickr Project - Recent Photos API Integration using cURL</title>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<link href="<?php echo $this->config->item('base_url');?>css/style.css" rel="stylesheet">
	<script src="<?php echo $this->config->item('base_url');?>js/flr.js"></script>
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