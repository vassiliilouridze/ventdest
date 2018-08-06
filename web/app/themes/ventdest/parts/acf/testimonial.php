<?php 
    $title = get_sub_field('title');
    $subtitle = get_sub_field('subtitle');
    $desc = get_sub_field('description');
    //second false skip ACF pre-processcing
    $url = get_sub_field('video', false, false);
    //get wp_oEmed object, not a public method. new WP_oEmbed() would also be possible
    $oembed = _wp_oembed_get_object();
    //get provider
    $provider = $oembed->get_provider($url);
    //fetch oembed data as an object
    $oembed_data = $oembed->fetch( $provider, $url );
    $thumbnail = $oembed_data->thumbnail_url; 
 ?>
<section class="little-section">
    <div class="row bg-primary text-white pt-5 pb-5 pl-3 pr-3 ml-1 mr-1">
        <div class="col-md-8">
            <h5 class="text-uppercase text-white"><?php echo $title; ?></h5>
            <h6 class="text-secondary"><?php echo $subtitle; ?></h6>
            <div class="font-italic font-weight-light text-white">
              <?php echo $desc; ?>
            </div>
        </div>
        <div class="col-md-4">
          <a href="<?php echo $url ?>" class="video-lightbox" data-lity>
            <img src="<?php echo $thumbnail ?>">
          </a>  
        </div>
    </div>
</section>