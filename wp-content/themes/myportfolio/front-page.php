<?php 
	/**
	 * Template Name: Front Page Template
	 * @package myportfolio
	 */
	
	get_header();
 ?>


<!-- Front Page Content Starts -->
<section class="container-fluid main-container container-home p-0 revealator-slideup revealator-once revealator-delay1">
    <div class="color-block d-none d-lg-block"></div>
    <div class="row home-details-container align-items-center">
        <div class="col-lg-4 bg position-fixed d-none d-lg-block"></div>
        <div class="col-12 col-lg-8 offset-lg-4 home-details text-left text-sm-center text-lg-left">
            <div>
                <?php $hero_image = get_field( 'hero_image', 'option' ); ?>
                <?php if ( $hero_image ) : ?>
                    <img src="<?php echo esc_url( $hero_image['url'] ); ?>" class="img-fluid main-img-mobile d-none d-sm-block d-lg-none" alt="<?php echo esc_attr( $hero_image['alt'] ); ?>" />
                <?php endif; ?>
                <h6 class="text-uppercase open-sans-font mb-0 d-block d-sm-none d-lg-block"><?php the_field( 'hero_area_subtitle', 'option' ); ?></h6>
                <h1 class="text-uppercase poppins-font">
                    <?php 
                        the_field( 'hero_area_title', 'option' ); 
                        ?>
             </h1>
                <p class="open-sans-font"><?php the_field( 'hero_area_description', 'option' ); ?></p>
                <a href="<?php the_field( 'hero_button_url', 'option' ); ?>
" class="btn btn-about"><?php the_field( 'hero_button_text', 'option' ); ?></a>
            </div>
        </div>
    </div>
</section>
<!-- Main Content Ends -->

<?php get_footer(); ?>