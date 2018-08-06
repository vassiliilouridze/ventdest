
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header') ); ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section>
    <h1><?php the_title(); ?></h1>
    <div class="content"><?php the_content(); ?></div>
</section>

<?php endwhile; endif; ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
