<?php
/*
 * Plugin Name:       Encoder File Gallery
 * Plugin URI:        https://encodeit.net/
 * Description:       Handle customized MetaBOX with the plugin.
 * Version:           1.0.6
 */

 //define('POST_TYPE','greentech_sectors');
 define('POST_TYPE','greentech_case_study');
 //define('POST_TYPE','expense');


 require_once( dirname( __FILE__ ).'/image-gallery.php' );
 require_once( dirname( __FILE__ ).'/ajax-code.php' );

 function custom_gallery_enqueue_media() {
   
        wp_enqueue_media();
        

        wp_enqueue_script('custom-gallery-meta-box', plugins_url('/assets/meta_box_scripts.js', __FILE__), array('jquery'), null, true);
        wp_enqueue_script('custom-gallery-script', plugins_url('/assets/scripts.js', __FILE__), array('jquery'), null, true);
      
        
        
        wp_enqueue_style('custom-gallery-style', plugins_url('assets/style.css', __FILE__));
      
    
   
}
add_action('admin_enqueue_scripts', 'custom_gallery_enqueue_media');

add_action('init',function(){
    add_shortcode('enc-my-shortcode', 'create_shortcode');
});


function create_shortcode(){
         $args = array(
         'post_type'   => POST_TYPE,
         'post_status' => 'any',
         'posts_per_page' => -1
       );
      
      $query = get_posts($args);
      foreach($query as $key=>$value)
      {
         $gallery_data_from_postmeta=get_post_meta( $value->ID, '_custom_product_gallery', true );
         if(empty($gallery_data_from_postmeta))
         {
            $the_post_thumbnail_id=get_post_thumbnail_id($value->ID);
            

            if($the_post_thumbnail_id)
            {
                  
                    
                  update_post_meta( $value->ID, '_custom_product_gallery', $the_post_thumbnail_id );
        
            }
            

               
         }

      }
}
