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
      <?php if ( have_posts() ):  ?>
      <?php while(have_posts()): the_post(); ?>
      <?php 
        $timetable = get_field('horaire');
        $orga = get_field('organisateur');
        $place = get_field('place');
        $subscribe_url = get_field('url_subscribe');
        $access_one = get_field('acces_one');
        $access_two = get_field('acces_two');
        $access_three = get_field('acces_three');
        $access_four = get_field('access_four');
        $access_five = get_field('access_five');

        $day = get_the_terms(get_the_ID(), 'day');

      ?>
      <section class="container main-section">
          <!-- <a href="./listing_exposant.html" class="btn btn-primary ml-1 mb-3">Retour à la recherche d'exposants</a> -->
          
          <div class="card p-5 ml-1 mr-1 mb-5">
              <div class="card-body">
                  <div class="row">
                    <?php if (!empty(get_the_post_thumbnail()) || !empty(get_the_content())): ?>
                      <div class="col-md-6 mt-5 mb-5">
                          <?php echo the_post_thumbnail('lrg_size', array('class' => 'responsive-image')); ?>
                          <?php if(!empty(get_the_content())): ?>
                          <h5 class="text-uppercase"><?php echo _x('Description', 'Single description title', 'libramont') ?></h5>
                          <div class="content-wrapper">
                            <?php the_content(); ?>
                          </div>
                          <?php endif; ?>
                      </div>
                      <div class="col-md-6">
                    <?php else: ?>
                      <div class="col-12">
                    <?php endif ?>
                          <dl class="mb-5 content-wrapper">
                            <?php if(!empty($place)): ?>
                              <dt><?php echo __('Place', 'libramont') ?>:</dt>
                              <dd><?php echo $place ?></dd>
                            <?php endif; ?>

                            <?php if(!empty($timetable)): ?>
                              <dt><?php echo __('Timetable', 'libramont') ?>:</dt>
                              <dd><?php echo $timetable['time_debut']; if($timetable['time_debut']) echo ' – '.$timetable['time_debut'];  ?>
                              </dd>
                            <?php endif; ?>

                            <?php if(!empty($orga['organisateur_name'])): ?>
                              <dt><?php echo __('Speaker', 'libramont') ?>:</dt>
                              <?php if($orga['organisateur_url']): ?>
                                <dd><a href="<?php echo $orga['organisateur_url'] ?>"><?php echo $orga['organisateur_name'] ?></a></dd>
                              <?php else: ?>
                                <dd><?php echo $orga['organisateur_name'] ?></dd>
                              <?php endif; ?>
                            <?php endif; ?>

                          </dl>
                          <?php if(!empty($subscribe_url)): ?>
                          <div>
                            <a href="<?php echo $subscribe_url ?>" class="btn btn-outline-primary mb-5"><?php echo _x("S'inscrire", 'Sign up button for conferences, etc.', 'libramont') ?></a>
                          <?php endif; ?>
                          <?php if(!empty($access_one) || !empty($access_two) || !empty($access_three) || !empty($access_four) || !empty($access_five)): ?>
                            <h6 class="text-uppercase font-weight-bold"><?php echo _x('Accès', 'Access title in conferences, etc.', 'libramont') ?></h6>
                             <ul class="access-list">
                              <?php if(!empty($access_one)): ?>
                                <li class="access access--one" data-toggle="tooltip" data-placement="top" title"<?php echo __('Accès 1', 'libramont') ?>"><?php echo __('Accès 1', 'libramont') ?></li>
                              <?php endif; ?>
                              <?php if(!empty($access_two)): ?>
                                <li class="access access--two" data-toggle="tooltip" data-placement="top" title"<?php echo __('Accès 2', 'libramont') ?>"><?php echo __('Accès 2', 'libramont') ?></li>
                              <?php endif; ?>
                              <?php if(!empty($access_three)): ?>
                                <li class="access access--three" data-toggle="tooltip" data-placement="top" title"<?php echo __('Accès 3', 'libramont') ?>"><?php echo __('Accès 3', 'libramont') ?></li>
                              <?php endif; ?>
                              <?php if(!empty($access_four)): ?>
                                <li class="access access--four" data-toggle="tooltip" data-placement="top" title"<?php echo __('Accès 4', 'libramont') ?>"><?php echo __('Accès 4', 'libramont') ?></li>
                              <?php endif; ?>
                              <?php if(!empty($access_five)): ?>
                                <li class="access access--five" data-toggle="tooltip" data-placement="top" title"<?php echo __('Accès 5', 'libramont') ?>"><?php echo __('Accès 5', 'libramont') ?></li>
                              <?php endif; ?>
                            </ul>
                          <?php endif; ?>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <?php endwhile; ?>
      <?php endif; ?>
    </main>



 <?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>
