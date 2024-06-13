<?php
function custom_meta_box_markup($post) {
    wp_nonce_field(basename(__FILE__), 'custom_nonce');
    global $wpdb;
    // gallery
    wp_nonce_field('custom_product_gallery_nonce', 'custom_product_gallery_nonce');
    $_custom_product_gallery = get_post_meta($post->ID, '_custom_product_gallery', true);
   
    echo '<input type="hidden" id="_custom_product_gallery" name="_custom_product_gallery" value="'.$_custom_product_gallery.'" >';
    $_custom_product_gallery = !empty($_custom_product_gallery) ? explode(',', $_custom_product_gallery) : array();
    // var_dump(wp_get_attachment_image(50, 'thumbnail'));
    // exit;
    echo '<input type="button" class="button" value="Set Receipt Images" is-multiple="1" id="custom_product_gallery_button">';
    echo '<div id="custom_product_gallery_container">';
    echo '<div class="lightbox_slider_container"><div class="custom_slider">';
    foreach ($_custom_product_gallery as $image_id) {
       $attacment_url=wp_get_attachment_url($image_id);
     //  var_dump(  $attacment_url);
       if(str_contains($attacment_url,'pdf'))
       {
         echo  '<iframe class="slider__item" src="'.$attacment_url.'"></iframe>';
       }else
       {
         echo '<img class="slider__item" src="' . $attacment_url . '" alt="Slider Image"/>';
       }  

    }
    echo '</div>';
    echo '<button class="slider__prev">
        <img
          src="https://pixpine.com/wp-content/themes/pixpine/assets/images/pagination_left_icon.png"
          alt="Previous"
        />
      </button>
      <button class="slider__next">
        <img
          src="https://pixpine.com/wp-content/themes/pixpine/assets/images/pagination_right_icon.png"
          alt="Next"
        />
      </button>';
    echo '</div>';

    echo '  <div class="slider_lightbox">
      <button class="lightbox__close">×</button>
      <button class="lightbox__prev">
        <img
          src="https://pixpine.com/wp-content/themes/pixpine/assets/images/pagination_left_icon.png"
          alt="Previous"
        />
      </button>
      <div class="lightbox__content"></div>
      <button class="lightbox__next">
        <img
          src="https://pixpine.com/wp-content/themes/pixpine/assets/images/pagination_right_icon.png"
          alt="Next"
        />
      </button>
    </div>';
    echo '</div>';
    echo '</div>';
}
function add_custom_meta_box() {
    add_meta_box('custom_meta_box', 'Custom Field', 'custom_meta_box_markup', POST_TYPE, 'normal', 'high');
}
add_action('add_meta_boxes', 'add_custom_meta_box');
function save_custom_meta_box($post_id) {
    if (!isset($_POST['custom_nonce']) || !wp_verify_nonce($_POST['custom_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if (current_user_can('edit_post', $post_id)) {
        $new_value = sanitize_text_field($_POST['_custom_product_gallery']);
        update_post_meta($post_id, '_custom_product_gallery', $new_value);
    }
}
add_action('save_post', 'save_custom_meta_box');