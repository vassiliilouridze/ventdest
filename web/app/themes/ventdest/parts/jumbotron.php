<?php 
$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'sup_size');
?>
<div class="jumbotron jumbotron-fluid not-homepage" <?php if( ! empty( get_post_thumbnail_id() ) ): ?>style="background-image: url(<?php echo $thumbnail; ?>);"<?php endif; ?>>
</div>
