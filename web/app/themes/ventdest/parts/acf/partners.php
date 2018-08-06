<section class="text-center container">
    <?php $desc = get_sub_field( 'description' ); ?>
    <?php $cta = get_sub_field('link'); ?>
        
        <h2 class="section-title font-weight-semibold"><?php the_sub_field('title') ?></h2>
        <?php if( isset( $desc ) && !empty( $desc ) ): ?>
        <div class="section-subtitle"><?php echo $desc ?></div>
        <?php endif; ?>
        <?php 
        $post_objects = get_sub_field('partners_list');
        if( $post_objects ):
        ?>
        <div class="customer-logos slider mb-5">
        <?php foreach( $post_objects as $post): ?>
            <?php setup_postdata($post); ?>
            <?php $link = get_field('url_partner'); ?>
            <div class="slide">
            <?php if(isset($link) && ! empty($link)): ?>
                <a class="slide-link" href="<?php echo $link; ?>">
                <?php the_post_thumbnail(); ?>
                </a>
            <?php else: ?>
                <?php the_post_thumbnail(); ?>
            <?php endif; ?>
            </div>
        <?php endforeach; ?>
        
            <?php wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>
    <?php if(isset( $cta ) && ! empty( $cta )): ?>
        <a class="btn btn-secondary" href="<?php echo $cta['url'] ?>"><?php echo $cta['title'] ?></a>
    <?php endif; ?>
</section>