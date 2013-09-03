<div id="sidebar">
	<ul id="sidebar_inner" class="nav nav-tabs nav-stacked">
		<?php foreach($pages as $val): ?>
		<?php 
			$link = "";
			if( !empty( $val['link'] ) ){
				$link = $val['link'];
			} else {
				$link = base_url()."index.php/".$val['id'];
			} 
		?>
        <li><a href="<?php echo $link; ?>"><?php echo $val["label"]; ?></a></li>
    	<?php endforeach ?>
	</ul>
</div>

