<?php
function custom_meta_box_markup($post) {
    
    wp_nonce_field(basename(__FILE__), 'custom_nonce');
    global $wpdb;
    // gallery
    wp_nonce_field('custom_product_gallery_nonce', 'custom_product_gallery_nonce');
    $_custom_product_gallery = get_post_meta($post->ID, '_custom_product_gallery', true);
   
    echo '<input type="hidden" id="_custom_product_gallery" name="_custom_product_gallery" value="'.$_custom_product_gallery.'" >';
    $_custom_product_gallery = !empty($_custom_product_gallery) ? explode(',', $_custom_product_gallery) : array();
    
    if(count($_custom_product_gallery) == 1)
    {
      $hide_class='arrow_false';
    }else
    {
      $hide_class=' ';
    }
    echo '<input type="button" class="button" style="margin-bottom:5px" value="Select Receipt Files" is-multiple="1" id="custom_product_gallery_button">';
    echo '<div id="custom_product_gallery_container">';
    echo '<div class="lightbox_slider_container '.$hide_class.'">';
    echo '<div class="custom_slider">';
      foreach ($_custom_product_gallery as $image_id) {
        $attacment_url=wp_get_attachment_url($image_id);
    
        if(str_contains($attacment_url,'pdf'))
        {
          $attacment_url=$attacment_url.'#toolbar=0';
          echo  '<div class="slider__item"><iframe  src="'.$attacment_url.'"></iframe></div>';
        }else
        {
          echo '<div class="slider__item"><img  src="' . $attacment_url . '" alt="Slider Image"/></div>';
        }  
      
      }
      echo '</div>';
      echo '<button class="slider__prev">
      <img
        src="'.plugins_url('assets/images/pagination_left_icon.png', __FILE__).'"
        alt="Previous"
      />
    </button>';
    echo  '<button class="slider__next">
        <img
          src="'.plugins_url('assets/images/pagination_right_icon.png', __FILE__).'"
          alt="Next"
        />
      </button></div>';
      echo '<div class="slider_lightbox">
      <button class="lightbox__close">×</button>
      <button class="lightbox__prev">
        <img
          src="'.plugins_url('assets/images/pagination_left_icon.png', __FILE__).'"
          alt="Previous"
        />
      </button>
      <div class="lightbox__content '.$hide_class.'"></div>
      <button class="lightbox__next">
        <img
          src="'.plugins_url('assets/images/pagination_right_icon.png', __FILE__).'"
          alt="Next"
        />
      </button>
    </div>';
    echo '</div>';
}
function add_custom_meta_box() {
    add_meta_box('custom_meta_box_receipts', 'Receipts', 'custom_meta_box_markup', POST_TYPE);
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