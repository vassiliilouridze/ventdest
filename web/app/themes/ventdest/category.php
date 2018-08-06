<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package   WordPress
 * @subpackage  Starkers
 * @since     Starkers 4.0
 */
 ?>
 <?php Starkers_Utilities::get_template_parts( array( 'parts/html-header', 'parts/header' ) ); ?>
 
    <?php get_template_part( 'parts/jumbotron' ); ?>

    <main role="main" class="content-page news_listing">
        <?php get_template_part('parts/title','category'); ?>
        <section class="container main-section">
            <?php if ( have_posts() ): $postCount = 0; ?>
            <div class="row">
                <div class="col-lg-8 order-first order-lg-first">
                    <div class="row">
                    <?php while ( have_posts() ) : the_post(); $postCount++; ?>
                        <?php if($postCount === 1): ?>
                        <div class="col-md-12">
                        <?php else: ?>
                        <div class="col-md-6">
                        <?php endif; ?>
                            <div class="card">
                                <a href="<?php the_permalink(); ?>">
                                <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'lrg_size', '', array('class' => 'card-img-top')); ?>
                                <?php if($postCount === 1): ?>
                                    <div class="row">
                                        <div class="col-md-2 card_header_date">
                                            <span><?php echo get_the_date('d') ?></span>
                                            <br><?php echo get_the_date('M') ?>
                                        </div>
                                        <div class="col-md-10">
                                <?php endif; ?>
                                        <div class="card-header">
                                            <h3 class="text-uppercase font-weight-bold"><?php the_title(); ?></h3>
                                            <div><?php the_excerpt(); ?></div>
                                        </div>
                                <?php if($postCount === 1): ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                </a>
                                <div class="container-fluid">
                                    <div class="row">
                                        <?php if($postCount === 1): ?>
                                        <div class="col-md-10 offset-md-2">
                                        <?php endif; ?>
                                            <div class="card-footer">
                                                <?php if($postCount !== 1): ?>
                                                <span class="font-weight-bold text-uppercase mr-1"><?php echo get_the_date('d M Y') ?></span>
                                                <?php endif; ?> <?php the_category(); ?> 
                                            </div>
                                        <?php if($postCount === 1): ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    </div>
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
        <?php if (function_exists("ets_pagination")) {
            ets_pagination($wp_query->max_num_pages);
        } ?>
        </section>
        <?php $blog_page_id = get_option( 'page_for_posts' ); ?>
        <?php if(have_rows('page_builder', $blog_page_id)): while(have_rows('page_builder', $blog_page_id)): the_row(); ?>
          <?php if(get_row_layout() == 'multisite'): ?>
            <?php get_template_part( 'parts/acf/'. get_row_layout() ); ?>
          <?php endif; ?>
        <?php endwhile; endif; ?>

    </main>

<?php endif; ?>

 <?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>
