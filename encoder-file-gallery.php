<?php
/*
 * Plugin Name:       Encoder File Gallery
 * Plugin URI:        https://fenix_people.net/
 * Description:       Handle customized form with the plugin.
 * Version:           1.0.0
 */

 //define('POST_TYPE','greentech_sectors');
 define('POST_TYPE','post');
 
 //require_once( dirname( __FILE__ ).'/custom-gallery.php' );
 require_once( dirname( __FILE__ ).'/image-gallery.php' );
 require_once( dirname( __FILE__ ).'/ajax-code.php' );

 function custom_gallery_enqueue_media() {
   
        wp_enqueue_media();
        

        wp_enqueue_script('custom-gallery-meta-box', plugins_url('/assets/meta_box_scripts.js', __FILE__), array('jquery'), null, true);
        wp_enqueue_script('custom-gallery-script', plugins_url('/assets/scripts.js', __FILE__), array('jquery'), null, true);
       // wp_enqueue_script('custom-gallery-script-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
        
        
        wp_enqueue_style('custom-gallery-style', plugins_url('assets/style.css', __FILE__));
      //  wp_enqueue_style('custom-gallery-style-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    
   
}
add_action('admin_enqueue_scripts', 'custom_gallery_enqueue_media');

add_action('init',function(){
    add_shortcode('enc-my-shortcode', 'create_shortcode');
});

// add_shortcode('import_images', 'import_image');
// function import_image()
// {
//     $args = array(
//         'post_status' => 'publish',
//         'post_type'   => 'greentech_sectors',
//       );
      
//       $query = get_posts($args);
//       var_dump($query);
     
// }

function create_shortcode(){
         $args = array(
         'post_status' => 'publish',
         'post_type'   => POST_TYPE,
       );
      
      $query = get_posts($args);
      foreach($query as $key=>$value)
      {
         $gallery_data_from_postmeta=get_post_meta( $value->ID, '_custom_product_gallery', true );
         if(empty($gallery_data_from_postmeta))
         {
            $the_post_thumbnail_id=get_post_thumbnail_id($value->ID);
            //var_dump($the_post_thumbnail_url);
            //exit;

            if($the_post_thumbnail_id)
            {
                  //    $gallery_data = array();
                 
                  //   $gallery_data['image_url'][]  = $the_post_thumbnail_url;
                    
                  update_post_meta( $value->ID, '_custom_product_gallery', $the_post_thumbnail_id );
        
                // if ( $gallery_data ) 
                     
               // else 
                   //  delete_post_meta( $value->ID, 'gallery_data' );
            }
            //var_dump($the_post_thumbnail_url);

               
         }

      }
}
