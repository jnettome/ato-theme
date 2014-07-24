<!-- <?php post_class(); ?> -->

<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<p class="small-info entry-summary"><?php the_field('subtitle'); ?></p>

<div class="portfolio-info">
    <hr>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <?php if( function_exists( 'easy_image_gallery' ) ) { echo easy_image_gallery(); remove_filter( 'the_content', 'easy_image_gallery_append_to_content' );   } ?>
    </div>
    <hr>

    <?php the_content(); ?>


</div>