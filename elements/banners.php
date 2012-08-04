<?php




add_action( 'cyberchimps_header_banner_element', 'cyberchimps_header_banner_element_content');
add_action( 'cyberchimps_footer_banner_element', 'cyberchimps_footer_banner_element_content');
add_action( 'cyberchimps_single_banner_element', 'cyberchimps_single_banner_element_content');

/**
* Header Banner Element
*
* @since 2.0
*/
function cyberchimps_header_banner_element_content() {
global $themeslug, $options, $root; //Call global variables

	$banner_type = $options->get($themeslug.'_header_banner_type'); //Type of header banner 
	$affiliate_img = $options->get($themeslug.'_header_banner_affiliate_image'); //Affiate banner image
	$affiliate_url = $options->get($themeslug.'_header_banner_affiliate_link'); //Affiliate banner link
	$img_src = $options->get($themeslug.'_header_banner_image'); //User uploaded image
	$image = $img_src['url'];
	$img_url = $options->get($themeslug.'_header_banner_image_url'); //URL for user uploaded image
	$embed = $options->get($themeslug.'_header_banner_code_embed'); //Embed code for external ad.

?>

		<div id="banner" class="row-fluid">
			
			<?php if ($banner_type == "key1"):?>
				<a href="<?php echo $affiliate_url; ?>/" target="_blank"><img src="http://placehold.it/1020x120" alt="Affiliate"></a>		
			<?php endif; ?>
			
			<?php if ($banner_type == "key2"):?>
				<a href="<?php echo $img_url; ?>/" target="_blank"><img src="<?php echo $image; ?>" alt="logo"></a>		
			<?php endif; ?>
			<?php if ($banner_type == "key3") { echo stripslashes($embed); } ?>
			
			
	</div>	

<?php
}

/**
* Footer Banner Element
*
* @since 2.0
*/
function cyberchimps_footer_banner_element_content() {
global $themeslug, $options, $root; //Call global variables

	$banner_type = $options->get($themeslug.'_footer_banner_type'); //Type of footer banner 
	$affiliate_img = $options->get($themeslug.'_footer_banner_affiliate_image'); //Affiate banner image
	$affiliate_url = $options->get($themeslug.'_footer_banner_affiliate_link'); //Affiliate banner link
	$img_src = $options->get($themeslug.'_footer_banner_image'); //User uploaded image
	$image = $img_src['url'];
	$img_url = $options->get($themeslug.'_footer_banner_image_url'); //URL for user uploaded image
	$embed = $options->get($themeslug.'_footer_banner_code_embed'); //Embed code for external ad.

?>

  <div id="footer-banner" class="row-fluid">
        
      <?php if ($banner_type == "key1"):?>
        <a href="<?php echo $affiliate_url; ?>/" target="_blank"><img src="http://placehold.it/1020x120" alt="Affiliate"></a>		
      <?php endif; ?>
      
      <?php if ($banner_type == "key2"):?>
        <a href="<?php echo $img_url; ?>/" target="_blank"><img src="<?php echo $image; ?>" alt="logo"></a>		
      <?php endif; ?>
      <?php if ($banner_type == "key3") { echo stripslashes($embed); } ?>
        
        
  </div>	
<?php
}

/**
* Single Banner Element
*
* @since 2.0
*/
function cyberchimps_single_banner_element_content() {
global $themeslug, $options, $root; //Call global variables

	$banner_type = $options->get($themeslug.'_single_banner_type'); //Type of single banner 
	$affiliate_img = $options->get($themeslug.'_single_banner_affiliate_image'); //Affiate banner image
	$affiliate_url = $options->get($themeslug.'_single_banner_affiliate_link'); //Affiliate banner link
	$img_src = $options->get($themeslug.'_single_banner_image'); //User uploaded image
	$image = $img_src['url'];
	$img_url = $options->get($themeslug.'_single_banner_image_url'); //URL for user uploaded image
	$embed = $options->get($themeslug.'_single_banner_code_embed'); //Embed code for external ad.

?>

		<div id="single-banner" class="row-fluid">
			
			<?php if ($banner_type == "key1"):?>
				<a href="<?php echo $affiliate_url; ?>/" target="_blank"><img src="http://placehold.it/1020x120" alt="Affiliate"></a>		
			<?php endif; ?>
			
			<?php if ($banner_type == "key2"):?>
				<a href="<?php echo $img_url; ?>/" target="_blank"><img src="<?php echo $image; ?>" alt="logo"></a>		
			<?php endif; ?>
			<?php if ($banner_type == "key3") { echo stripslashes($embed); } ?>
			
			
	</div>	

<?php
}

?>