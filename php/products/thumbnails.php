<?php
$Image_ = $_Image;
$DataOpen_ = $_DataOpen;
$Title_ = $_Title
?>
<div class="responsive-picture thumbnail">
<div class="image-wrapper overlay-fade-in" data-open="<?php echo $DataOpen_ ?>">
<picture><!--[if IE 9]><video style="display: none;"><![endif]-->
<source srcset="<?php echo $Image_; ?>" media="(min-width: 64em)">
<source srcset="<?php echo $Image_; ?>" media="(min-width: 1em)"><!--[if IE 9]></video><![endif]--><img alt="<?php echo $Title_; ?>" src="<?php echo $Image_; ?>">
</picture>
</div>
</div>

<!--Modals-->
<div class="reveal Modal" id="<?php echo $DataOpen_ ?>" data-reveal>
	<div class="responsive-picture thumbnail ">
    <picture><!--[if IE 9]><video style="display: none;"><![endif]-->
    <source srcset="<?php echo $Image_; ?>" media="(min-width: 64em)">
    <source srcset="<?php echo $Image_; ?>" media="(min-width: 1em)"><!--[if IE 9]></video><![endif]--><img alt="<?php echo $Title_; ?>" src="<?php echo $Image_; ?>">
    </picture>
	</div>
	
  <button class="close-button" data-close aria-label="Close modal">
    <span aria-hidden="true">&times;</span>
  </button>
</div>