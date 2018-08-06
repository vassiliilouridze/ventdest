<?php 
  $cat = get_sub_field('testimonial_choice');
 ?>

<?php 
  $args = array(
      'post_type'     => 'post',
      'order_by'      => 'date',
      'order'         => 'DESC',
      'posts_per_page' => '2',
      'category__in'  => $cat
  );
  $query = new WP_Query($args);
 ?>

<?php if($query->have_posts()): ?>
 <section class="little-section">
  <div class="row">
    
    <?php if( !empty( get_sub_field('title') )): ?>
    <h2 class="col-12"><?php the_sub_field('title'); ?></h2>
    <?php endif; ?>

    <?php while($query->have_posts()): $query->the_post(); ?>
    <div class="col-md-6">
        <div class="card">
          <a href="<?php the_permalink(); ?>">
          <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'blog@2x', '', array('class' => 'card-img-top')); ?>
            <div class="card-header">
              <h3 class="text-uppercase font-weight-bold"><?php the_title(); ?></h3>
              <div><?php the_excerpt(); ?></div>
            </div>
          </a>
          <div class="container-fluid">
            <div class="row">
              <div class="card-footer">
                <?php the_category(); ?> 
              </div>
            </div>
          </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</section>
<?php endif; ?>