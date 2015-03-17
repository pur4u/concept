<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$menu = array('HOME' => base_url(), 'SERVICII VIRTUAL DESK' => base_url('desk') ); 
?>
			<nav>
			  <ul>
				<?php foreach (array_reverse($menu) as $key => $value) { echo '<li><a href="'. $value .'">'. $key .'</a></li>'; } ?>
			  </ul>
		  
			<div class="nav-btn"> <i class="glyph-list-white"></i> </div>
			<ul class="dropdown">
				<?php foreach (array_reverse($menu) as $key => $value) { echo '<li><a href="'. $value .'">'. $key .'</a></li>'; } ?>
			</ul>	
			</nav>