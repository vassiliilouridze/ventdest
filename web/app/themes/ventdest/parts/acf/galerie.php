<?php 
  $list = get_sub_field('choice');
  $index = get_row_index();

  if(isset($_POST['galleryName'])){ 
    $galleryName =  $_POST['galleryName'];
    if($galleryName == '') {
      $galleryName = 0;
    }
  }    

  if( $index ): 
    echo('<section class="gallery">
            <form action="" method="post" class="ml-auto">
              <div class="container">');    
    if(count($list) > 1) {
      echo('<div class="d-flex mb-3">
              <h2 class="w-100">Guide d\'inspiration</h2>
                <select name="galleryName" class="form-control ml-auto w-auto" onchange="this.form.submit()">
                  <option value="">Filtrer par</option>');
                  foreach($list as $key => $post):
                    if($key == $galleryName) {
                      echo('<option value="'.$key.'" selected>'.$post->post_title.'</option>');
                    } else {
                      echo('<option value="'.$key.'">'.$post->post_title.'</option>');
                    }                    
                  endforeach; 
      echo('</select>
        </div>');              
    } elseif(count($list) == 1) {
      if(isset($galleryName)) {
        $post = $list[$galleryName];
      } else {
        $post = $list[0];
      } 
      setup_postdata( $post );

      echo('<h3 class="text-center mb-3">'.get_field('titre').'</h3>');    
    }      

    if(isset($galleryName)) {
      $post = $list[$galleryName];
    } else {
      $post = $list[0];
    } 
    setup_postdata( $post );
    $images = get_field('images');
    if( have_rows('images') ):
      echo('
              <div class="grid gallery">
                <div class="grid-sizer"></div>
                <div class="grid-gutter"></div>');
      while ( have_rows('images') ) : the_row();
        echo('<div class="grid-item">'.wp_get_attachment_image(get_sub_field('image'), 'lrg_size', '', array('class' => 'img-fluid')).'</div>'); 
      endwhile;  
      echo('</div>'); 
    endif; 
    wp_reset_postdata();
    echo('    <div class="d-flex justify-content-center mt-3">   
                <a href="#" class="btn btn-outline-primary">Plus d\'images</a>
              </div> 
            </div>
          </form>
        </section>'); 
  endif;  
?>
