<?php 
  $title = get_sub_field('title');
  $shortcode = get_sub_field('shortcode');
 ?>
<section class="little-section">
  <div class="row">
    <div class="col-12">
      <?php if( !empty( get_sub_field('title') )): ?>
      <h2><?php the_sub_field('title'); ?></h2>
      <?php endif; ?>
      <div class="content-wrapper">
        <?php echo do_shortcode($shortcode); ?>
      </div>
    </div>
  </div>
</section>