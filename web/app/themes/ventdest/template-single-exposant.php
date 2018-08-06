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

  $lang = ICL_LANGUAGE_CODE;
  $img_dir = wp_upload_dir();

  $id = $_GET['id'];

  $req = searchExhibitors();
  $result = $req->getExhibitor($id, $lang);
 

?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/html-header', 'parts/header' ) ); ?>
 
    
<?php get_template_part( 'parts/jumbotron' ); ?>

    <main role="main" class="content-page news_listing">
      <?php if ( !empty($result) ):  ?>
      <div class="emphasized-title">
          <div class="container content">
              <h1 class="bg-primary font-weight-semibold"><?php echo $result['exhibitior_name'] ?></h1>
                          
        <div class="breadcrumb justify-content-center mt-lg-4"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="<?php echo home_url(); ?>" rel="v:url" property="v:title"><?php echo _x('Home', 'Homepage breadcrumb name', 'libramont') ?></a> / <span rel="v:child" typeof="v:Breadcrumb"><a href="<?php echo get_url_for_language(211) ?>" rel="v:url" property="v:title"><?php echo _x('Exhibitor', 'Exhibitor breadcrumb name', 'libramont') ?></a> / <span class="breadcrumb_last"><?php echo $result['exhibitior_name'] ?></span></span></span></span></div>            </div>
      </div>

      <section class="container main-section">
          <!-- <a href="./listing_exposant.html" class="btn btn-primary ml-1 mb-3">Retour à la recherche d'exposants</a> -->
          
          <div class="card p-5 ml-1 mr-1 mb-5">
              <div class="card-body">
                  <div class="row">
                    <?php if ( ! empty($result['logo']) || ! empty($result['search_text']) ): ?>
                      <div class="col-md-6">
                          <?php if ( ! empty($result['logo']) ): ?>
                            <img src="<?php echo $img_dir['baseurl'].'/fdl_img/'.$result['logo']; ?>" class="responsive-image mb-4">
                          <?php endif; ?>
                          <?php if ( ! empty($result['search_text']) ): ?>
                          <h5 class="text-uppercase"><?php echo _x('Description', 'Single description title', 'libramont') ?></h5>
                          <div class="content-wrapper">
                            <?php echo $result['search_text']; ?>
                          </div>
                          <?php endif; ?>
                      </div>
                      <div class="col-md-6">
                    <?php else: ?>
                      <div class="col-12">
                    <?php endif ?>
                          <dl class="mb-5 content-wrapper">
                            <?php if(!empty($result['stand_number'])): ?>
                              <dt><?php echo __('Stand', 'libramont') ?>:</dt>
                              <dd><?php echo __('Zone', 'libramont') . ' ' . $result['stand_location'] . ' | ' . $result['stand_number'] ; ?></dd>
                            <?php endif; ?>

                            <?php if(!empty($result['address'])): ?>
                              <dt><?php echo __('Address', 'libramont') ?>:</dt>
                              <dd><?php echo $result['address'] . ' – ' . $result['postcode'] . ' ' . $result['city'] . ' ' . $result['country']; ?>
                              </dd>
                            <?php endif; ?>

                            <?php if(!empty($result['phone'])): ?>
                              <dt><?php echo __('Phone', 'libramont') ?>:</dt>
                              <dd><?php echo $result['phone'];  ?>
                              </dd>
                            <?php endif; ?>

                            <?php if(!empty($result['fax'])): ?>
                              <dt><?php echo __('Fax', 'libramont') ?>:</dt>
                              <dd><?php echo $result['fax'];  ?>
                              </dd>
                            <?php endif; ?>
                              
                            <?php if(!empty($result['website'])): ?>
                              <dt><?php echo __('Internet', 'libramont') ?>:</dt>
                              <dd><a href="http://<?php echo $result['website'];  ?>" target="_blank" ><?php echo $result['website'];  ?></a>
                              </dd>
                            <?php endif; ?>

                          </dl>
                          <?php if( ! empty($result['poles_courses_id']) ): ?>
                            <h6 class="text-uppercase font-weight-bold"><?php echo __('Pôles et parcours', 'libramont') ?>:</h6>
                           
                            <?php foreach($result['courses'] as $pp): ?>
                            <a href="<?php echo get_url_for_language(211) ?>?query=&courses[]=<?php echo $pp['course_id'] ?>" >
                              <img class="rounded-circle bg-secondary mb-5" alt="<?php echo $pp['label'] ?>" title="<?php echo $pp['label'] ?>" height="60" width="60" src="<?php echo $img_dir['baseurl'].'/pole_parcours/18Pastilles_foire_parcours_'.$pp['course_id'] . '.jpg'; ?>">
                            </a>
                          <?php endforeach; ?>
                          <?php endif; ?>

                          <?php if( ! empty($result['category']) ): ?>
                            <div class="mb-5" >
                            <h6 class="text-uppercase font-weight-bold"><?php echo __('Catégories', 'libramont') ?>:</h6>
                                <?php $catList = explode(',' , $result['category']); ?>
                                <?php foreach($catList as $index => $cat): ?>
                                    <a href="<?php echo get_url_for_language(211) ?>?query=<?php echo $cat ?>" ><?php echo $cat ?></a>
                                    <?php if($index < count($catList)-1): ?>
                                    &nbsp;-&nbsp;
                                    <?php endif; ?>
                                    <?php if($index == 10): ?>
                                        <i class="fas fa-plus-circle float-right mt-5 mb-5 collapseIcon" id="collapseOneIcon" data-toggle="collapse" data-target="#categories"  onclick="changeCardCollapseClass(this.id)"></i>
                                        <div id="categories" class="collapse">
                                    <?php endif; ?>

                                <?php endforeach; ?>
                                <?php if($index > 10): ?>
                                       </div >
                                 <?php endif; ?>
                            </div>
                          <?php endif; ?>
                          <?php if( ! empty($result['mark_id']) ): ?>
                            <dl class="mb-5">
                              <dt><?php echo __('Marques', 'libramont') ?>: </dt>
                              <?php $marques = explode(',', $result['mark']); ?>
                              <?php foreach($marques as $index => $m): ?>
                              <dd <?php if($index > 0) echo 'class="offset-100"'; ?>><a href="<?php echo get_url_for_language(211) ?>?query=<?php echo $m ?>"><?php echo $m ?></a></dd>
                              <?php endforeach; ?>
                            
                          <?php endif; ?>
                          <?php 
                            // args
                            $args = array(
                                'post_type' => 'conference',
                                'meta_key'  => 'idtiers',
                                'meta_value'	=> $id
                            );
                            // query
                            $the_query = new WP_Query( $args );

                            ?>
                            <?php if( $the_query->have_posts() ): ?>
                               
                                <h6 class="text-uppercase font-weight-bold">Conférences:</h6>
                                    <table class="w-100">
                                        <tbody><tr>
                                            <th>Date &amp; heure</th>
                                            <th>Thème</th>
                                            <th>Emplacement</th>
                                        </tr>
                                         <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                        <tr>
                                            <td><span class="font-weight-bold"></span><?php echo __(get_field('Jour'), 'libramont') ?><br/><?php the_field('horaire'); ?></td>
                                            <td class="font-weight-bold"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></td>
                                            <td><span class="font-weight-bold"><?php the_field('place'); ?></span></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody></table>
                                
                            <?php endif; ?>
                      </div>
                  </div>
              </div>
          </div>
               <a href="javascript:history.back()" class="btn btn-primary centered-element"><?php echo __("Retour à la recherche d'exposants", 'libramont') ?></a>
      </section>
      <?php endif; ?>
    </main>


 <?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>
