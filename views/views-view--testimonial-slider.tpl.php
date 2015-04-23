

<!-- ================ -->
<!-- = TESTIMONIALS = -->
<!-- ================ -->
<div id="testies" class="bxSliderTestimonial">

 <?php //print $view; ?>



 <?php 


 for ($i=0; $i < sizeof($view->result); $i++) { 

 	$imageURL = "/sites/default/files/Testimonials/".$view->result[$i]->field_field_image[0]['raw']['filename'];
 	$writeup = $view->result[$i]->field_field_write_up_en[0]['raw']['value'];
 	$title = $view->result[$i]->field_field_title_en[0]['raw']['value'];
 	$author = $view->result[$i]->field_field_more_info[0]['raw']['value'];

 	print '<div id="testimonial_0'.($i+1).'" style="background:url(\''.$imageURL.'\') center center no-repeat; background-size:cover; min-height:500px; ">
 	<div class="wrapper">';

 	print '<div class="testimonialDetails">
 	<div class="wrapper">
 	<p>'.$writeup.'</p>
 	</div>
 	</div>';

 	print '<div class="testimonialInfo">
 	<h3>'.$title.'</h3>
 	<p class="author">'.$author.'</p>';
 	print '</div>';


 	print '</div>';
 	print '</div>';
 }

 ?>
</div>
<div class="testiesControls">
	<a href="#" id="testies-prev">&lt;</a>
	<a href="#" id="testies-next">&gt;</a>
</div>

