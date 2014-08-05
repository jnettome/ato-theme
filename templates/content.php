<!-- <?php post_class(); ?> -->

<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<p class="small-info entry-summary"><?php the_field('subtitle'); ?></p>

<?php the_field('pre-content'); ?>

<div class="portfolio-info">
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
        <hr class="header-line">
        <div class="row portfolio-images">
        <?php
          foreach ( $attachment_ids as $attachment_id ) {
            $classes = array( '' );

            // get original image
            $image_link = wp_get_attachment_image_src( $attachment_id, apply_filters( 'easy_image_gallery_linked_image_size', 'large' ) );
            $image_link = $image_link[0];

            $image = wp_get_attachment_image( $attachment_id, apply_filters( 'easy_image_gallery_thumbnail_image_size', 'medium' ), '', array( 'alt' => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ), 'class' => 'img-responsive' ) );

            $image_caption = get_post( $attachment_id )->post_excerpt ? get_post( $attachment_id )->post_excerpt : '';

            $image_class = esc_attr( implode( ' ', $classes ) );

            $settings = (array) get_option( 'easy-image-gallery' );

            // set fancybox as default for when the settings page hasn't been saved
            // $lightbox = isset( $settings['lightbox'] ) ? esc_attr( $settings['lightbox'] ) : 'prettyphoto';

            $rel = ' data-lightbox="group"';

            // $image_description = get_post($attachment_id)->post_content ? get_post($attachment_id)->post_content : '' ;

        $html = sprintf( '<a %s href="%s" class="col-xs-6 col-sm-3 %s" title="%s">%s</a>', $rel, $image_link, $image_class, $image_caption, $image );

      echo apply_filters( 'easy_image_gallery_html', $html, $rel, $image_link, $image_class, $image_caption, $image, $attachment_id, $post->ID );
    }
?>
    </div>
    <?php
  }
    endif;
  ?>

    <hr>

    <div class="post-text">
      <?php the_content(); ?>
    </div>


</div>

<style>
  .single-works .content .portfolio-info hr { margin-top: 20px; }
  .portfolio-images a { margin-bottom: 20px; }
</style>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js"></script>
