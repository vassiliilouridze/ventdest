<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/html-header', 'parts/header' ) ); ?>
 
    <?php get_template_part( 'parts/jumbotron' ); ?>

    <main role="main" class="content-page news_listing">
        <?php get_template_part('parts/title'); ?>
        <section class="container main-section">
            <?php if ( have_posts() ):  ?>
            <div class="row">
                <div class="col-lg-8 order-first order-lg-first">
                    <?php while ( have_posts() ) : the_post();  ?>
                      <div class="card news">
                          <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'lrg_size', '', array('class' => 'card-img-top')); ?>
                          <div class="card-header">
                            <div class="row">
                              <div class="col-md-2 card_header_date">
                                <span><?php echo get_the_date('d') ?></span>
                                <br><?php echo get_the_date('M') ?>
                              </div>
                              <div class="col-md-10 my-auto">
                                <h3 class="text-uppercase font-weight-bold"><?php the_title(); ?></h3>
                              </div>
                            </div>
                          </div>
                          <div class="card-body content-wrapper">
                              <?php the_content(); ?>
                              <?php echo do_shortcode('[ssba-buttons]'); ?>
                          </div>

                        <?php 
                        $categories = get_the_category();
                        $tags = get_the_tags(get_the_ID());

                        if(!empty($categories) || !empty($tags)):
                         ?>
                          <div class="card-footer tags">
                            <?php if( ! empty($categories)): ?>
                              <div class="d-flex flex-row align-items-center mb-3">
                                  <span class="font-weight-bold text-uppercase"><?php echo __('Catégorie(s)', 'libramont') ?> : </span>
                                  <div class="d-flex flex-row justify-content-start align-items-start flex-wrap ml-3 mlr-between-children mb-children">
                                      <?php foreach( $categories as $category ): ?>
                                        <a href="/<?php echo $category->taxonomy.'/'.$category->slug; ?>" class="btn btn-outline-secondary-white-bg"><?php echo $category->name; ?></a>
                                      <?php endforeach; ?>
                                  </div>
                              </div>
                            <?php endif; ?>

                            <?php if( ! empty($tags)): ?>
                              <div class="d-flex flex-row align-items-center mb-3">
                                  <span class="font-weight-bold text-uppercase"><?php echo __('Tag(s)', 'libramont') ?> : </span>
                                  <div class="d-flex flex-row justify-content-start align-items-start flex-wrap ml-3 mlr-between-children mb-children">
                                    <?php foreach( $tags as $tag ): ?>
                                      <a href="/tag/<?php echo $tag->slug; ?>" class="btn btn-outline-secondary-white-bg"><?php echo $tag->name; ?></a>
                                    <?php endforeach; ?>
                                  </div>
                              </div>
                            <?php endif; ?>
                            
                          </div>
                        <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <aside class="col-lg-4 order-last order-lg-last">
                    <?php 
                    $args = array(
                        'post_type'     => 'post',
                        'order_by'      => 'date',
                        'order'         => 'DESC',
                        'posts_per_page' => '3'
                    );
                    $query = new WP_Query($args);
                    ?>
                    <?php if($query->have_posts()): ?>
                        <h2 class="bg-primary font-weight-semibold text-uppercase w-100 text-center"><?php echo __('Les dernières news', 'libramont'); ?></h2>
                        <?php while($query->have_posts()): $query->the_post();?>
                            <div class="media mb-3">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('blog-mini', array('class' => 'align-self-start mr-3')); ?>
                                </a>
                                <div class="media-body">
                                    <h5 class="mt-0 font-weight-bold text-uppercase">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h5>
                                    <div><?php echo get_the_date('d M Y'); ?> | <?php the_category(); ?> </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <hr>
                    <?php endif; ?>

                    <?php 
                    $args = array(
                        'post_type'     => 'post',
                        'meta_key' => 'ets_post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'posts_per_page' => '3'
                    );
                    $query = new WP_Query($args);
                    ?>
                    <?php if($query->have_posts()): ?>
                        <h2 class="bg-primary font-weight-semibold text-uppercase w-100 text-center"><?php echo __('Les news les plus consultées', 'libramont'); ?></h2>
                        <?php while($query->have_posts()): $query->the_post();?>
                            <div class="media mb-3">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('blog-mini', array('class' => 'align-self-start mr-3')); ?>
                                </a>
                                <div class="media-body">
                                    <h5 class="mt-0 font-weight-bold text-uppercase">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h5>
                                    <div><?php echo get_the_date('d M Y'); ?> | <?php the_category(); ?></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <hr>
                    <?php endif; ?>
                </aside>
            </div>
        </section>
    </main>

<?php endif; ?>

 <?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>
