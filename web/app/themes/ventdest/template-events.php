<?php
/**
 * Template Name: Page evenements
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package     WordPress
 * @subpackage  Starkers
 * @since       Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/html-header', 'parts/header' ) ); ?>
 
    
    <?php get_template_part( 'parts/jumbotron' ); ?>

    <main role="main" class="content-page news_listing">
        <?php get_template_part('parts/title'); ?>
        <section class="container main-section">
            <?php if ( have_posts() ): $postCount = 0; while( have_posts() ): the_post(); ?>
            
            <?php
                $days = get_field('days');
                $types = get_field('typeEvents');
            ?>
            <div class="row">
                <?php 
                $siblings = wp_nav_submenu('primary', get_the_ID()); ?>
                <?php if(! empty( $siblings )): ?>
                    <div class="col-lg-2 col-xl-3 order-first">
                        <?php echo $siblings; ?>
                    </div>
                <?php endif; ?>
                <?php if(have_rows('page_builder')): ?>
                  <div class="col-lg-10 col-xl-9 order-last">
                    <div class="box-container">
                    <?php while(have_rows('page_builder')): the_row(); ?>
                        <?php get_template_part( 'parts/acf/'. get_row_layout() ); ?>
                    <?php endwhile; ?>
                    </div>
                  </div>
                <?php endif; ?>
             </div>
            <?php foreach ($days as $day): ?>
                <?php $date = get_term($day); ?>
                <div class="table-events-header below_grid">
                   <h4>
                       <i class="far fa-calendar-alt"></i>
                       <?php echo __('conferences' , 'libramont') . ' ' . $date->name;  ?>
                       <i class="float-right collapseIcon fas fa-angle-down" id="collapseNewsListIcon" data-toggle="collapse" data-target="#term_<?php echo $day ?>" aria-expanded="true" aria-controls="collapseNewsList" onclick="changeNewsTableCollapseClass(this.id)"></i>
                   </h4>
                </div>

                <ul id="term_<?php  echo $day ?>" class="list-group table-events collapseNewsList below_grid collapse show mb-5" style="">
                     <li class="list-group-item list-group-item-white list-item-content">
                        <a href="#" class="d-md-flex flex-row">
                             <div class="flex-column flex-fill">
                                  <h5 class="mb-0">
                                                    "Qui nourrira nos villes demain ?"
                                  </h5>
                                  <p class="mb-0">Par
                                       <span class="font-weight-bold text-primary">Haïssam Jijakli</span>
                                  </p>
                                  <p class="mb-0">
                                      <i class="far fa-clock"></i>
                                          10h30 - 11h30 | Auditoire LEC4
                                      <i class="far fa-calendar-alt"></i>
                                  </p>
                             </div>
                            <span class="align-self-center">1 -2</span>
                         </a>
                     </li>           
                 </ul>
            <?php endforeach; ?>
        </section>
    </main>

<?php endwhile; endif; ?>

 <?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>