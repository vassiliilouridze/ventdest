<?php
    $address = get_field( 'address', 'option' );
    $email = get_field( 'email_address', 'option' );
    $phone = get_field( 'phone', 'option' );
    $fax = get_field( 'fax', 'option' );

    $facebook = get_field( 'facebook', 'option' );
    $instagram = get_field( 'instagram', 'option' );
    $gplus = get_field( 'google_plus', 'option' );
    $twitter = get_field( 'twitter', 'option' );

    $button_title = get_field( 'button_title', 'option' );
    $button_link = get_field( 'button_link', 'option' );

    $desc = get_field('description', 'option');

    $showBlock = get_field('show_block_above_footer');
?>
<?php if($showBlock): ?>
    <?php if(have_rows('block_content', 'option')): ?>
        <section class="bg-light above-footer-section">
            <div class="container">
                <div class="row">
                    <?php while(have_rows('block_content', 'option')): the_row(); ?>
                        <div class="col-md-4">
                            <div class="media">
                                <i class="mr-3 fa <?php echo the_sub_field('block_icon', 'option'); ?>"></i>
                                <div class="media-body">
                                    <h5 class="mt-0"><?php echo the_sub_field('block_title', 'option'); ?></h5> 
                                    <p><?php echo the_sub_field('block_description', 'option'); ?></p> 
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
<footer class="bg-primary-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h4 class="mb-4">Menu</h4>
                <?php
                    $args = array(
                    'theme_location'    => 'footer',
                    'container'         => false,
                    'menu_class'        => 'mr-auto'
                );
                wp_nav_menu( $args ); ?>
            </div>
            <div class="col-lg-3">
                <?php $footer_links_obj = ets_get_menu_by_location('copyright');  ?>
                <h4 class="mb-4"><?php echo esc_html($footer_links_obj->name) ?></h4>
                <?php
                    $args = array(
                    'theme_location'    => 'copyright',
                    'container'         => false,
                    'menu_class'        => 'mr-auto'
                );
                wp_nav_menu( $args ); ?>
            </div>
            <div class="col-lg-3 last-news">
                <h4 class="mb-4"><?php echo __('Recevez nos news') ?></h4>
                <form type="POST" action="">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text pointer-hover" ><i class="far fa-envelope"></i></button>
                        </div>
                    </div>
                </form>
                <p class="mb-3">Vos données sont traitées comme des informations strictement confidentielles.</p>
            </div>
            <div class="col-lg-3">
                <h4 class="mb-4"><?php echo __('Suivez-nous sur') ?></h4>
                <p>
                    <?php if( ! empty($facebook) ): ?>
                        <a href="<?php echo $facebook; ?>" class="icon" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    <?php endif; ?>
                    <?php if( ! empty($instagram) ): ?>
                        <a href="<?php echo $instagram; ?>" class="icon" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                    <?php if( ! empty($twitter) ): ?>
                        <a href="<?php echo $twitter; ?>" class="icon" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    <?php endif; ?>
                    <?php if( ! empty($gplus) ): ?>
                        <a href="<?php echo $gplus; ?>" class="icon" target="_blank">
                            <i class="fab fa-google-plus-g"></i>
                        </a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</footer>
