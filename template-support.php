<?php
/*
Template Name: Support Template
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>

  <?php
    if(function_exists('easy_image_gallery')):
      $attachment_ids = easy_image_gallery_get_image_ids();

  global $post;

  if ( $attachment_ids ) { ?>

    <?php

    $has_gallery_images = get_post_meta( get_the_ID(), '_easy_image_gallery', true );

    if ( !$has_gallery_images )
      return;

    // convert string into array
    $has_gallery_images = explode( ',', get_post_meta( get_the_ID(), '_easy_image_gallery', true ) );

    // clean the array (remove empty values)
    $has_gallery_images = array_filter( $has_gallery_images );

    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'feature' );
    $image_title = esc_attr( get_the_title( get_post_thumbnail_id( $post->ID ) ) );

    // css classes array
    $classes = array();

    // thumbnail count
    $classes[] = $has_gallery_images ? 'thumbnails-' . easy_image_gallery_count_images() : '';

    // linked images
    $classes[] = easy_image_gallery_has_linked_images() ? 'linked' : '';

    $classes = implode( ' ', $classes );

    ob_start();
?>

    <ul class="row list-unstyled <?php echo $classes; ?>">
    <?php
    foreach ( $attachment_ids as $attachment_id ) {

      $classes = array( 'popup' );

      // get original image
      $image_link = wp_get_attachment_image_src( $attachment_id, apply_filters( 'easy_image_gallery_linked_image_size', 'large' ) );
      $image_link = $image_link[0];

      $image = wp_get_attachment_image( $attachment_id, apply_filters( 'easy_image_gallery_thumbnail_image_size', 'thumbnail' ), '', array( 'alt' => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ), 'class' => 'img-responsive' ) );

      $image_caption = get_post( $attachment_id )->post_excerpt ? get_post( $attachment_id )->post_excerpt : '';

      $image_class = esc_attr( implode( ' ', $classes ) );

      $lightbox = easy_image_gallery_get_lightbox();

      $rel = easy_image_gallery_count_images() > 1 ? 'rel="'. $lightbox .'[group]"' : 'rel="'. $lightbox .'"';

      if ( easy_image_gallery_has_linked_images() )
        $html = sprintf( '<li><a %s href="%s" class="%s" title="%s"><i class="icon-view"></i><span class="overlay"></span>%s</a></li>', $rel, $image_link, $image_class, $image_caption, $image );
      else
        $html = sprintf( '<li class="col-md-3">%s</li>', $image );

      echo apply_filters( 'easy_image_gallery_html', $html, $rel, $image_link, $image_class, $image_caption, $image, $attachment_id, $post->ID );
    }
?>
    </ul>
    <?php
    endif;
  ?>
<?php endwhile; ?>
