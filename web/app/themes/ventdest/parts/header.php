<div id="above-header" class="d-none d-lg-flex pl-3 pr-3">
	<?php
			$phone = get_field( 'phone', 'option' );
			$schedules = get_field( 'schedules', 'option' );
	?>
	<div class="d-flex">		
		<a href="tel:<?php echo($phone); ?>" class="mr-3"><i class="fas fa-phone mr-2 text-secondary align-self-center"></i><?php echo($phone); ?></a>
		<span><?php echo($schedules); ?></span>
	</div>
	<div class="d-flex ml-auto">
		<?php
			$args = array(
			'theme_location'    => 'top_bar',
			'container'         => false,
			'menu_class'        => 'list-inline d-inline-flex mr-auto',
			'item_spacing'      => 'discard');
			wp_nav_menu( $args ); ?>
			
			<a href="#" class="text-uppercase ml-3"><i class="fas fa-sign-out-alt mr-1 mt-1 text-secondary"></i><strong>Accès professionnel</strong></a>
	</div>	
</div>


<header role="banner" class="header fixed-top" data-toggle="affix">
	<nav id="main_nav" class="navbar navbar-expand-lg navbar-white bg-white btco-hover-menu" role="navigation">
		<a class="navbar-brand" href="<?php bloginfo('url') ?>">
        <img class="img-fluid" src="<?php echo get_header_image(); ?>" alt="Logo Vent d'Est">
    </a>
    <div class="navbar-collapse" id="navbarsExample05">
			<div class="d-flex flex-column d-lg-none mb-3">
				<div class="language-list mb-3">
					<?php languages_list(); ?>
				</div>		
				<a href="tel:<?php echo($phone); ?>" class="mb-3 text-primary"><i class="fas fa-phone mr-2 text-secondary align-self-center"></i><?php echo($phone); ?></a>
				<span><?php echo($schedules); ?></span>
			</div>

			<?php
				$args = array(
				'theme_location'    => 'top_bar',
				'container'         => false,
				'menu_class'        => 'navbar-nav mr-auto mb-3 d-lg-none',
				'item_spacing'      => 'discard');
				wp_nav_menu( $args ); ?>
				
			<?php
				$args = array(
					'theme_location'	=> 'primary',
					'container' 			=> false,
					'menu_class'    	=> 'navbar-nav mr-auto',
					'fallback_cb'   	=> 'WP_Bootstrap_Navwalker::fallback',
					'walker'        	=> new WP_Bootstrap_Navwalker(),
				);
				wp_nav_menu( $args ); ?>
			<i class="fas fa-search mr-3 ml-auto"></i>
			<a href="#" class="btn btn-secondary mr-2"><i class="fas fa-map mr-1"></i>Nos points de vente</a>
			<button type="button" class="dismiss">
					<i class="fas fa-times text-white"></i>
			</button>
		</div>
	</nav>
  <div class="navbar-header">
    <button type="button" id="sidebarCollapse" class="btn btn-ligth text-primary">
      <i class="fas fa-bars text-secondary"></i>
    </button>
  </div>
</header>
