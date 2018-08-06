<?php 
  $color = get_sub_field('color');
  $ctaSize = get_sub_field('cta_size');
  $title = get_sub_field('title');
  $content = get_sub_field('description');
  $link = get_sub_field('link');
  $image = get_sub_field('bg_image');
  $btn_color = '';
  if ($color == 'bg-primary-light' || $color == 'bg-primary-dark') {
    $btn_color = 'btn-primary';
  }else{
    $btn_color = 'btn-outline-light';
  }
  if (!empty($image)) {
    $btn_color = 'btn-secondary';
  }
 ?>
 <?php if(! empty($image)): ?>
 <section class="little-section <?php echo $ctaSize ?>"  style="background-image: url(<?php echo $image['sizes']['lrg_size']; ?>);background-position: center;background-size: cover;">
  <div class="h-100 <?php echo $color ?><?php if(! empty($image)) echo '-alpha'; ?>">
    <div class="container d-flex flex-column justify-content-center h-100">
      <div class="block-cta pt-5 pb-5 d-md-flex w-75" >
        <div class="content">
          <h2><?php echo $title; ?></h2>
          <?php echo $content; ?>
          <p>
            <a href="<?php echo $link['url']; ?>" class="btn <?php echo $btn_color ?> align-self-center"><?php echo $link['title']; ?></a>
          </p>              
        </div>
      </div>
    </div>
  </div>
</section>
<?php else: ?>
<section class="little-section <?php echo $ctaSize ?>">
  <div class="<?php echo $color ?>">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="block-cta color-block pt-5 pb-5 d-md-flex justify-content-between" >
            <div class="content">
              <h2><?php echo $title; ?></h2>
              <?php echo $content; ?>
            </div>
            <a href="<?php echo $link['url']; ?>" class="btn <?php echo $btn_color ?> align-self-center"><?php echo $link['title']; ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>