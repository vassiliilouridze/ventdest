<?php 
  $media_select = get_sub_field('media_select');
  $image = get_sub_field('image');
  $img_size = 'lrg_size';
  //second false skip ACF pre-processcing
  $video = get_sub_field('video', false, false);

  $title = get_sub_field('title');
  $content = get_sub_field('content');
  $content_parts = get_extended($content);

  $link = get_sub_field('link');
  
  if(isset($layout) && $layout == 'horizontal'){
    $img_size = 'card-small';
  }
 ?>

<?php if(!empty($image) || !empty($video)): ?>
  <?php if($media_select == 'image'): ?>
    <?php echo wp_get_attachment_image($image, $img_size, '', array( 'class' => 'responsive-image d-lg-block card-img-top' )); ?>
  <?php elseif($media_select == 'video'): ?>
    <?php 
    //get wp_oEmed object, not a public method. new WP_oEmbed() would also be possible
    $oembed = _wp_oembed_get_object();
    //get provider
    $provider = $oembed->get_provider($video);
    //fetch oembed data as an object
    $oembed_data = $oembed->fetch( $provider, $video );
    $thumbnail = $oembed_data->thumbnail_url; ?>
    <a href="<?php echo $video ?>" class="video-lightbox" data-lity>
      <img src="<?php echo $thumbnail ?>">
    </a>  
  <?php endif; ?>
<?php endif; ?>

<?php if($layout == 'horizontal'): ?>
<div class="d-flex flex-column align-items-start">
<?php endif; ?>

  <div class="card-body">
    <?php if( !empty( $title )): ?>
    <h3 class="card-title <?php if($layout == 'horizontal'){ echo 'h5'; } ?>"><?php echo $title ?></h3>
    <?php endif; ?>
    <?php echo $content_parts['main']; ?>
  </div>
  <?php if(!empty($content_parts['extended'])): ?>
    <div id="card_<?php echo $index.$subindex; ?>" class="collapse card-body"><?php echo $content_parts['extended']; ?></div>
  <?php endif; ?>
  <div class="card-footer text-muted">
      <?php if(!empty($content_parts['extended'])): ?>
        <i class="fas fa-plus-circle float-right collapseIcon" id="collapse_<?php echo $index.$subindex; ?>" data-toggle="collapse" data-target="#card_<?php echo $index.$subindex; ?>"
          aria-expanded="true" aria-controls="collapseOne" onclick="changeCardCollapseClass(this.id)"></i>
      <?php endif; ?>
      <?php if( !empty( $link )): ?>
        <a href="<?php echo $link['url'] ?>" class="btn btn-outline-secondary-white-bg btn-sm"><?php echo $link['title']; ?></a>
      <?php endif; ?>
  </div>

<?php if($layout == 'horizontal'): ?>
</div>
<?php endif; ?>