<?php
/**
 * Template Name: Page exposants
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

<?php
    require_once( WP_PLUGIN_DIR . '/libramont_sync/search.php' );
?>

<main role="main" class="content-page news_listing">
    <?php get_template_part('parts/title'); ?>
<section class="container main-section">
<div class="card p-5 ml-1 mr-1 mb-5">
    <form method="GET" action="<?php echo get_url_for_language(211) ?>">
        <div class="card-header pl-4 pr-4">
            <h3 class="card-title text-uppercase">
                <?php echo __('Rechercher un exposant', 'libramont') ?>
            </h3>
            <p class="text-muted text-light"><?php echo __('Vous trouverez ci-dessous la liste complète des exposants de la Foire de Libramont 2018.', 'libramont') ?></p>
            
            <div class="input-group input-group-lg">
                <input type="text" id="exhibitor_search" class="form-control" <?php if(isset($query)) echo 'value="'.$query.'"' ?> placeholder="<?php echo _x('Entrez un mot-clé', 'Recherche exposants placeholder', 'libramont') ?>" name="query">
                <div class="input-group-append">
                    <button class="btn btn-secondary pl-5 pr-5" type="submit">
                        <i class="fas fa-search"></i>
                        <?php echo __('Rechercher', 'libramont') ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body mt-5 w-100">
            <div class="table-events-header ">
                <h4>
                    <?php echo __('Affiner la recherche par…', 'libramont') ?>
                    <i class="fas fa-angle-down float-right collapseIcon" id="collapseMoreSearchOptions" data-toggle="collapse" data-target=".collapseMoreSearchOptions"
                        aria-expanded="true" aria-controls="collapseMoreSearchOptions" onclick="changeNewsTableCollapseClass(this.id)"></i>
                </h4>
            </div>
            <div class="row collapse show collapseMoreSearchOptions searchOptionsTable">
                <div class="col-md-4">
                    <div class="leftSearch h-100">
                        <ul class="list-group table-search-exposants">
                            <?php if(!empty($cat)): ?>
                                <li id="searchTab1" class="list-group-item list-group-item-white list-item-content active" onclick="displayAnotherSearchTab(this.id)"><?php echo __('Secteur d’activité', 'libramont'); ?>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty($courses)): ?>
                                <li id="searchTab2" class="list-group-item list-group-item-white list-item-content" onclick="displayAnotherSearchTab(this.id)">
                                <?php echo __('Pôles et parcours', 'libramont'); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(!empty($countries)): ?>
                                <li id="searchTab3" class="list-group-item list-group-item-white list-item-content" onclick="displayAnotherSearchTab(this.id)"><?php echo __('Pays', 'libramont'); ?>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="rightSearch">
                        <?php if(!empty($cat)): ?>
                            <div id="tabSearchExposantsOptions1">
                                <ul class="list-unstyled mt-3 row">
                                    <?php foreach($cat as $c): ?>
                                        <li class="col-md-6">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input"  
                                                       onchange="this.form.submit();"
                                                name="categories[]" 
                                                value="<?php echo $c['category_id']; ?>" 
                                                id="category_<?php echo $c['category_id']; ?>" 
                                                <?php if(isset($catQuery) && in_array($c['category_id'], $catQuery)) echo 'checked="checked"' ?>>
                                                <label class="form-check-label" for="category_<?php echo $c['category_id']; ?>"><?php echo $c['label_'.$lang]; ?></label>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($courses)): ?>
                            <div id="tabSearchExposantsOptions2" class="d-none">
                                <ul class="list-unstyled mt-3 row">
                                    <?php foreach($courses as $c): ?>
                                        <li class="col-md-6">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" 
                                                       onchange="this.form.submit();"
                                                name="courses[]" 
                                                value="<?php echo $c['course_id']; ?>" 
                                                id="course_<?php echo $c['course_id']; ?>" 
                                                <?php if(isset($coursesQuery) && in_array($c['course_id'], $coursesQuery)) echo 'checked="checked"' ?>>
                                                <label class="form-check-label" for="course_<?php echo $c['course_id']; ?>"><?php echo $c['label_'.$lang]; ?></label>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(!empty($countries)): ?>
                            <div id="tabSearchExposantsOptions3" class="d-none">
                                <ul class="list-unstyled mt-3 row">
                                    <?php foreach($countries as $c): ?>
                                        <li class="col-md-6">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" 
                                                       onchange="this.form.submit();"
                                                name="pays[]" 
                                                value="<?php echo $c['pays_id']; ?>" 
                                                id="pays_<?php echo $c['pays_id']; ?>" 
                                                <?php if(isset($paysQuery) && in_array($c['pays_id'], $paysQuery)) echo 'checked="checked"' ?>>
                                                <label class="form-check-label" for="pays_<?php echo $c['pays_id']; ?>"><?php echo $c['label']; ?></label>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
<?php if(isset($searchResults) && ! empty($searchResults)): ?>
<div class="table-events-header">
    <h4>
        <?php echo __('Résultats de la recherche', 'libramont') ?>: <?php echo $searchResults['total']; ?> <?php echo __('Exposant(s) trouvé(s)', 'libramont') ?>
        <i class="fas fa-angle-down float-right collapseIcon" id="collapseExposantsSearchResults" data-toggle="collapse" data-target=".collapseExposantsSearchResults"
            aria-expanded="true" aria-controls="collapseExposantsSearchResults" onclick="changeNewsTableCollapseClass(this.id)"></i>
    </h4>
</div>

<ul class="list-group table-events collapseExposantsSearchResults collapse show">
    <?php foreach($searchResults as $result): ?>
    <?php if(is_array($result)): ?>
        <li class=" list-group-item list-group-item-white list-item-content">
            <a href="<?php echo home_url('exhibitor') ?>?id=<?php echo $result['tier_id'] ?>" class="d-md-flex align-items-center flex-row pb-2">
                <?php if( ! empty($result['logo'])): ?>
                    <img src="<?php echo $img_dir['baseurl'].'/fdl_img/'.$result['logo']; ?>" class="responsive-image exposant_thumbnail">
                <?php endif; ?>
                <div class="flex-column flex-fill pb-1 <?php if(empty($result['logo'])) echo 'offset-md-20';  ?>">
                    <h5 class="mb-0 text-uppercase text-primary">
                        <?php echo $result['exhibitior_name']; ?>
                    </h5>
                    <?php if( ! empty($result['category']) ): ?>
                        <p class="mb-0">
                            <?php echo $result['category']; ?>
                        </p>
                    <?php endif; ?>
                    <?php if( ! empty($result['stand_number']) || ! empty($result['stand_location']) ): ?>
                        <p class="mb-0">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <?php 
                            echo __('Zone', 'libramont').': '. preg_replace('#H(.*)#', 'Hall $1', $result['stand_location']) ;
                            if( ! empty($result['stand_number']) && ! empty($result['stand_location']) ){ echo ' | '; } 
                            echo __('Stand', 'libramont').': '. $result['stand_number'];
                             ?>
                        </p>
                    <?php endif; ?>
                </div>
                <!-- <span class="align-self-center">
                    <img src="../img/foire-de-libramont-2.jpg" width="24" height="24" class="responsive-image rounded-circle">
                    <img src="../img/foire-de-libramont-2.jpg" width="24" height="24" class="responsive-image rounded-circle">
                    <img src="../img/foire-de-libramont-2.jpg" width="24" height="24" class="responsive-image rounded-circle">
                </span> -->
            </a>
        </li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
    
<?php if( ! empty( $searchResults['pages'] ) && $searchResults['pages'] > 1): ?>
<ul class="list-group-horizontal list-unstyled mt-5 pagination justify-content-center">
    <?php if($searchResults['pages'] > 5 ): ?>
        <li class="list-group-item">
            <a href="<?php echo home_url($wp->request) ?>?page=1<?php if(isset($query)) echo '&query='.$query ?>"><<</a>
        </li>
    <?php endif; ?>

    <li class="list-group-item">
        <a href="<?php echo home_url($wp->request) ?>?page=<?php echo $page-1 ?><?php if(isset($query)) echo '&query='.$query ?>"><</a>
    </li>

    <?php for($i = 1; $i < $searchResults['pages']; $i++): ?>
        <li class="list-group-item <?php if($i == $page) echo 'active';?>">
            <a href="<?php echo home_url($wp->request) ?>?page=<?php echo $i ?><?php if(isset($query)) echo '&query='.$query ?>"><?php echo $i ?></a>
        </li>
    <?php endfor; ?>

    <li class="list-group-item">
        <a href="<?php echo home_url($wp->request) ?>?page=<?php echo $page+1 ?><?php if(isset($query)) echo '&query='.$query ?>">></a>
    </li>

    <?php if($searchResults['pages'] > 5 ): ?>
        <li class="list-group-item">
            <a href="<?php echo home_url($wp->request) ?>?page=<?php echo $searchResults['pages'] ?><?php if(isset($query)) echo '&query='.$query ?>">>></a>
        </li>
    <?php endif; ?>
</ul>
    <?php endif; ?>
<?php endif; ?>
</section>
</main>
<?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>
