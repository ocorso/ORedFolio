<div id="sidebar">
	<ul id="sidebar_inner" class="nav nav-tabs nav-stacked">
		<?php foreach($pages as $val): ?>
		<?php 
			$link = "";
			if( !empty( $val['link'] ) ){
				$link = $val['link'] . DOMAIN;
			} else {
				$link = base_url() . $val['id'];
			} 
		?>
        <li><a href="<?= $link; ?>" title="<?= $val["heading"]; ?>"><?= $val["label"]; ?></a></li>
    	<?php endforeach ?>
	</ul>
</div>

