


<div class="slider-wrapper theme-default">
		<!--	IMAGES	-->
		<div id="slider" class="nivoSlider">

		<?php
		 //$info = explode("-split-", $rows);	
		//print $view;
	
	

for ($i=0; $i < sizeof($view->result); $i++) { 

	print "<img src='/sites/default/files/HomeSlider/".$view->result[$i]->field_field_home_slider_image[0]['raw']['filename']."' title= '#homecaption-".$view->result[$i]->field_field_home_slider_position[0]['raw']['value']."'/>";
}

		?>

		</div>

		<?php

			for ($ii=0; $ii < sizeof($view->result); $ii++) { 
				print "<div class='nivo-html-caption' id='homecaption-".$view->result[$ii]->field_field_home_slider_position[0]['raw']['value']."'><h2>".$view->result[$ii]->node_title."</h2><a href='".$view->result[$ii]->field_field_home_slider_link[0]['raw']['url']."' class='btn homeSlider'>Read More</a></div>";
			}
		?>

</div>


