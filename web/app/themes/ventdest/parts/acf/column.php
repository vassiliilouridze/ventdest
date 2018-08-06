<?php 
  $media_select = get_sub_field('media_select');
  $title = get_sub_field('title');
  $content = get_sub_field('content');
  $link = get_sub_field('link');
  $img_size = 'lrg_size';
 ?>

<?php if($media_select == 'image' && !empty( get_sub_field( 'image' ) )): ?>
  <?php echo wp_get_attachment_image(get_sub_field('image'), $img_size, '', array( 'class' => 'responsive-image mb-3' )); ?>
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

<div class="content">
  <?php if( !empty( $title )): ?>
  <h4><?php echo $title ?></h4>
  <?php endif; ?>
  <?php echo $content ?>
</div>