<div id="nav_container">
	<div id="navbar_inner" class="navbar-inner">
		<div id="nav_toggler" width="40" height="45" class="pull-left cfm-nav-item"></div>
  		<a id="logo" class="brand cfm-nav-item" href="<?php echo base_url();?>"><img width="161" height="27" src="<?php echo base_url();?>img/cfm_logo.png" /></a>
  		<p style="margin-top:2px; font-size:12px">IT'S TIME YOU PLAYED WITH FIRE</p>
	    <div id="header_search" class="dropdown">	
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">BROWSE<b class="caret"></b>&nbsp;</a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				<?php foreach($suggestions as $val): ?>
					
				<li><a href="<?php echo base_url()."index.php/".$val["id"];?>"><?php echo $val["label"]; ?></a></li>
				<?php endforeach ?>
				<li class="divider"></li>
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
	</div>
</div>
</div>