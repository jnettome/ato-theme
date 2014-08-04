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
      $attachment_ids = get_post_meta( $post->ID, '_easy_image_gallery', true );
      $attachment_ids = array_filter(explode( ',', $attachment_ids ));

      if ($attachment_ids) {
        $has_gallery_images = get_post_meta( get_the_ID(), '_easy_image_gallery', true );
        $has_gallery_images = explode( ',', get_post_meta( get_the_ID(), '_easy_image_gallery', true ) );

        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'feature' );
        $image_title = esc_attr( get_the_title( get_post_thumbnail_id( $post->ID ) ) );
        ?>

        <div class="row support-images">
        <?php
          foreach ( $attachment_ids as $attachment_id ) {
            $classes = array( '' );

            // get original image
            $image_link = wp_get_attachment_image_src( $attachment_id, apply_filters( 'easy_image_gallery_linked_image_size', 'large' ) );
            $image_link = $image_link[0];

            $image = wp_get_attachment_image( $attachment_id, apply_filters( 'easy_image_gallery_thumbnail_image_size', 'thumbnail' ), '', array( 'alt' => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ), 'class' => '' ) );

            $image_caption = get_post( $attachment_id )->post_excerpt ? get_post( $attachment_id )->post_excerpt : '';

            $image_class = esc_attr( implode( ' ', $classes ) );

            $settings = (array) get_option( 'easy-image-gallery' );

            // set fancybox as default for when the settings page hasn't been saved
            $lightbox = isset( $settings['lightbox'] ) ? esc_attr( $settings['lightbox'] ) : 'prettyphoto';

            $rel = 'rel="'. $lightbox .'[group]"';

            $image_description = get_post($attachment_id)->post_content ? get_post($attachment_id)->post_content : '' ;

        $html = sprintf( '<a %s href="%s" target="_blank" class="col-xs-6 col-sm-3 %s" title="%s">%s</a>', $rel, $image_description, $image_class, $image_caption, $image );

      echo apply_filters( 'easy_image_gallery_html', $html, $rel, $image_link, $image_class, $image_caption, $image, $attachment_id, $post->ID );
    }
?>
    </div>
    <?php
  }
    endif;
  ?>

<?php endwhile; ?>

<style>
  .support-images { display: table-row; margin-top: -60px; }
  .support-images a { line-height: 170px; text-align: center; display: table-cell; vertical-align: middle; }
  .support-images a img { vertical-align: middle; }
</style>
