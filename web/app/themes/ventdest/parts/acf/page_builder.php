<?php 

// Page builder template for all pages except front-page.php
while(have_rows('page_builder')){ the_row();
  if(get_row_layout() == 'content_columns'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 


   }elseif(get_row_layout() == 'content_card'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }elseif(get_row_layout() == 'content_cta'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }elseif(get_row_layout() == 'shortcode'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }elseif(get_row_layout() == 'testimonial'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }elseif(get_row_layout() == 'latest_news'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }elseif(get_row_layout() == 'listings'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }elseif(get_row_layout() == 'galerie'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }elseif(get_row_layout() == 'two_column_content'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }elseif(get_row_layout() == 'featured_content'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }elseif(get_row_layout() == 'partners'){ 

     get_template_part( 'parts/acf/'. get_row_layout() ); 

   }
}