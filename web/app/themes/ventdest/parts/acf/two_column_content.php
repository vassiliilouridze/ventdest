<?php 
  $title = get_sub_field('title');
  $subtitle = get_sub_field('subtitle');
  $background_color = get_sub_field('background_color');
  $left_column = get_sub_field('left_column');
  $right_column = get_sub_field('right_column');
  $left_column_contents = $left_column['contents'];
  $right_column_contents = $right_column['contents'];
?>
<section class="two-column-content <?php echo($background_color) ?>">
  <div class="container">
    <h3 class="text-center"><?php echo($title) ?></h3>
    <div class="d-flex justify-content-center">
      <p class="text-center mb-5 w-50"><?php echo($subtitle) ?></p>
    </div>    
    <div class="row">
      <div class="col-md-6 mt-3 mb-3">
        <img src="<?php echo $left_column['image']['url']; ?>" alt="<?php echo $left_column['image']['alt']; ?>" class="img-fluid mb-3 w-100">
        <h4><?php echo($left_column['title']) ?></h4>
        <?php if ( have_rows( 'left_column' ) ) : ?>
          <?php while ( have_rows( 'left_column' ) ) : the_row();
            if ( have_rows( 'contents' ) ) : ?>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <?php
                while ( have_rows( 'contents' ) ) : the_row();
                  $content_title = get_sub_field( 'content_title' );
                  $show_title = get_sub_field( 'show_title' );
                  $link_class = '';
                  if(get_row_index() == 1) {
                    $link_class = 'active show';
                  }
                  echo('<li class="nav-item '.$show_title.'">
                        <a class="nav-link '.$link_class.'" id="pills-'.get_row_index().'-tab" data-toggle="pill" href="#pills-'.get_row_index().'" role="tab" aria-controls="pills-'.get_row_index().'" aria-selected="true">'.$content_title.'</a>
                      </li>');
              ?>
              <?php endwhile; ?> 
            </ul>

                <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>
        <div class="tab-content" id="pills-tabContent">
          <?php if ( have_rows( 'left_column' ) ) : ?>
            <?php while ( have_rows( 'left_column' ) ) : the_row();
              if ( have_rows( 'contents' ) ) :
                while ( have_rows( 'contents' ) ) : the_row();
                  $content_title = get_sub_field( 'content_title' );
                  $content = get_sub_field( 'content' );
                  $tab_class = '';
                  if(get_row_index() == 1) {
                    $tab_class = 'active show';
                  }
                  echo('<div class="tab-pane fade '.$tab_class.'" id="pills-'.get_row_index().'" role="tabpanel" aria-labelledby="pills-'.get_row_index().'-tab">'.$content.'</div>');
                endwhile; 
              endif; ?>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>        
      </div>
      <div class="col-md-6 mt-3 mb-3">
        <img src="<?php echo $right_column['image']['url']; ?>" alt="<?php echo $right_column['image']['alt']; ?>" class="img-fluid mb-3 w-100">
        <h4><?php echo($right_column['title']) ?></h4>
        <?php if ( have_rows( 'right_column' ) ) : ?>
          <?php while ( have_rows( 'right_column' ) ) : the_row();
            if ( have_rows( 'contents' ) ) : ?>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <?php
                while ( have_rows( 'contents' ) ) : the_row();
                  $content_title = get_sub_field( 'content_title' );
                  $show_title = get_sub_field( 'show_title' );
                  $link_class = '';
                  if(get_row_index() == 1) {
                    $link_class = 'active show';
                  }
                  echo('<li class="nav-item '.$show_title.'">
                        <a class="nav-link '.$link_class.'" id="pills-'.get_row_index().'-tab" data-toggle="pill" href="#pills-'.get_row_index().'" role="tab" aria-controls="pills-'.get_row_index().'" aria-selected="true">'.$content_title.'</a>
                      </li>');
              ?>
              <?php endwhile; ?> 
            </ul>

                <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>
        <div class="tab-content" id="pills-tabContent">
          <?php if ( have_rows( 'left_column' ) ) : ?>
            <?php while ( have_rows( 'left_column' ) ) : the_row();
              if ( have_rows( 'contents' ) ) :
                while ( have_rows( 'contents' ) ) : the_row();
                  $content_title = get_sub_field( 'content_title' );
                  $content = get_sub_field( 'content' );
                  $tab_class = '';
                  if(get_row_index() == 1) {
                    $tab_class = 'active show';
                  }
                  echo('<div class="tab-pane fade '.$tab_class.'" id="pills-'.get_row_index().'" role="tabpanel" aria-labelledby="pills-'.get_row_index().'-tab">'.$content.'</div>');
                endwhile; 
              endif; ?>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>        
      </div>
    </div>
  </div>
</section>