<?php

?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/html-header', 'parts/header' ) ); ?>
<?php get_template_part( 'parts/jumbotron' ); ?>
<main role="main">
  <?php get_template_part('parts/title','category'); ?>
  <div class="container">
    <section class="text-center">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <h2><?php echo _x('Erreur de chargement de la page', 'Titre page erreur 404', 'libramont') ?></h2>
          <div class="content-wrapper">
            <?php echo _x('La page à laquelle vous tentez d’accéder n’existe pas.', 'Texte page erreur 404', 'libramont') ?>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
<?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>