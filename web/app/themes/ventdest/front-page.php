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

 <?php
     $pageTitle = get_the_title();
 ?>

<?php if(have_rows('slider')): ?>
  <div class="home-page-main-slider">
    <?php while(have_rows('slider')): the_row(); ?>
    <?php 
        $slideTitle = get_sub_field('slide_title', false);
        $slideDesc = get_sub_field('slide_description');
        $slideLink = get_sub_field('slide_button');
        $slideImage = get_sub_field('slide_image');
      ?>
    <div class="jumbotron jumbotron-fluid" style="background-image: url(<?php echo $slideImage['sizes']['sup_size']; ?>)">
      <div class="container">
        <div class="row">
          <div class="col-md-5"></div>
          <div class="col-md-7">
            <h2><?php echo $slideTitle ?></h1>
            <div class="content-wrapper">
              <?php echo $slideDesc ?>
            </div>
            <a class="btn btn-secondary" href="<?php echo $slideLink['url'] ?>" role="button"><?php echo $slideLink['title'] ?></a>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php if(have_rows('featured_section')): ?>
  <div class="container featured-section">
    <div class="row">
      <?php while(have_rows('featured_section')): the_row(); ?>
        <?php 
          $featuredTitle = get_sub_field('featured_title', false);
          $featuredDesc = get_sub_field('featured_description');
          $featuredLink = get_sub_field('featured_link');
          $featuredImage = get_sub_field('featured_image');
        ?>
        <div class="col-md-4">
          <a href="<?php echo $featuredLink['url'] ?>">
            <div class="img-container" style="background-image: url(<?php echo $featuredImage['sizes']['sup_size']; ?>)"></div>
            <h3 class="mt-3"><?php echo $featuredTitle ?></h3> 
            <p><?php echo $featuredDesc ?></p> 
          </a>
        </div>
      <?php endwhile; ?>
    </div>
    <div class="row mt-5">
      <?php 
        $aboutImg = get_field( 'about_img');
        $aboutTitle = get_field( 'about_title');
        $aboutDescription = get_field( 'about_description');
      ?>
      <div class="col-md-6">
        <img src="<?php echo $aboutImg; ?>" class="img-fluid">
      </div>
      <div class="col-md-6">
        <h1><?php echo $aboutTitle ?></h1>
        <p><?php echo $aboutDescription ?></p> 
      </div>
    </div>
  </div>  
<?php endif; ?>

<?php if(have_rows('page_builder')): ?>
<main role="main" class="content-page news_listing">
  <?php if ( have_posts() ): $postCount = 0; while( have_posts() ): the_post(); ?>
      <?php if(have_rows('page_builder')): ?>
        <?php while(have_rows('page_builder')): the_row(); ?>
            <?php get_template_part( 'parts/acf/'. get_row_layout() ); ?>
        <?php endwhile; ?>
      <?php endif; ?>   
    <?php endwhile; ?> 
  <?php endif; ?> 
</main>
<?php endif; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>
