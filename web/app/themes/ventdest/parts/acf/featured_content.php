<?php 
  $title = get_sub_field('title');
  $subtitle = get_sub_field('subtitle');
  $contentPosition = get_sub_field('content_position');
  $content = get_sub_field('content');
  $backgroundImage = get_sub_field('bg_image');
  $backgroundColor = get_sub_field('background_color');
  $contentPosition = get_sub_field('content_position');
?>
<section class="featured-content" style="background-size: cover; background-image: url(<?php echo $backgroundImage['sizes']['sup_size']; ?>)">
  <div class="container">
    <h3 class="text-center pt-3"><?php echo($title) ?></h3>
    <div class="d-flex justify-content-center">
      <p class="text-center mb-5 w-75"><?php echo($subtitle) ?></p>
    </div> 
    <div class="row <?php echo $contentPosition; ?>">
      <div class="col-md-6 content-featured <?php echo $backgroundColor; ?>">
        <?php echo $content; ?>        
      </div>
    </div>
  </div>
</section>