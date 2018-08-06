<?php 
  $fc = 'left_column';
  $sc = 'second_column';
  $tc = 'third_column';
  $col = get_sub_field('column_number');
 ?>
<section class="little-section">
  <div class="row">
  <?php if( !empty( get_sub_field('title') )): ?>
  <h2 class="col-12"><?php the_sub_field('title'); ?></h2>
  <?php endif; ?>
  
  <?php if( $col == 'one' ): ?>

    <div class="header mb-5 col-12">
      <div class="row">
      <?php while(have_rows($fc)): the_row(); ?>
        <?php 
          $media_select = get_sub_field('media_select');
          $title = get_sub_field('title');
          $content = get_sub_field('content');
         ?>
        <div class="col-md-8">
          <?php if( !empty( $title )): ?>
          <h2><?php echo $title ?></h2>
          <?php endif; ?>

          <div class="content-wrapper"><?php echo $content ?></div>
        </div>
        <div class="col-md-4">
          <?php if($media_select == 'image' && !empty( get_sub_field( 'image' ) )): ?>
            <?php echo wp_get_attachment_image(get_sub_field('image'), 'mid_size', '', array( 'class' => 'responsive-image mb-3' )); ?>
          <?php elseif($media_select == 'video' && !empty( get_sub_field( 'video' ) )): ?>
          <?php 
            //second false skip ACF pre-processcing
            $url = get_sub_field('video', false, false);
            //get wp_oEmed object, not a public method. new WP_oEmbed() would also be possible
            $oembed = _wp_oembed_get_object();
            //get provider
            $provider = $oembed->get_provider($url);
            //fetch oembed data as an object
            $oembed_data = $oembed->fetch( $provider, $url );
            $thumbnail = $oembed_data->thumbnail_url; ?>
            <a href="<?php echo $url ?>" class="video-lightbox" data-lity>
              <img src="<?php echo $thumbnail ?>">
            </a>  
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
      </div>
    </div>

  <?php elseif ( $col == 'two' ): ?>
    
  <?php 
  $layout = get_sub_field('grid_size'); 
  $right_size = '';
  $left_size = '';
  switch ($layout) {

    case 'col-md-4':
      $left_size = 'col-md-4';
      $right_size = 'col-md-8';
      break;

    case 'col-md-8':
      $left_size = 'col-md-8';
      $right_size = 'col-md-4';
      break;

    default:
      $left_size = 'col-md-6';
      $right_size = 'col-md-6';
      break;
  }
  ?>

  <div class="<?php echo $left_size; ?>">
    <?php while(have_rows($fc)): the_row(); ?>
        <?php get_template_part( 'parts/acf/column' ); ?>
    <?php endwhile; ?>
  </div>

  <div class="<?php echo $right_size; ?>">
    <?php while(have_rows($sc)): the_row(); ?>
        <?php get_template_part( 'parts/acf/column' ); ?>
    <?php endwhile; ?>
  </div>

  <?php elseif ( $col == 'three' ): ?>

  <div class="col-md-4">
    <?php while(have_rows($fc)): the_row(); ?>
        <?php get_template_part( 'parts/acf/column' ); ?>
    <?php endwhile; ?>
  </div>

  <div class="col-md-4">
    <?php while(have_rows($sc)): the_row(); ?>
        <?php get_template_part( 'parts/acf/column' ); ?>
    <?php endwhile; ?>
  </div>

  <div class="col-md-4">
    <?php while(have_rows($tc)): the_row(); ?>
        <?php get_template_part( 'parts/acf/column' ); ?>
    <?php endwhile; ?>
  </div>

  <?php endif; ?>
  </div>
</section>