<?php
function save_custom_product_gallery() {
    check_ajax_referer('custom_product_gallery_nonce', 'nonce');
    $image_ids = !empty($_POST['imageIds']) ? $_POST['imageIds'] : array();
    $image_ids_str = implode(',', $image_ids);

    // Debug: Check if AJAX action is triggered
    error_log('AJAX action triggered');
    echo '<div class="lightbox_slider_container"><div class="custom_slider">';
    foreach ($image_ids  as $image_id) {
      $attacment_url=wp_get_attachment_url($image_id);
      
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
    die();
}
add_action('wp_ajax_save_custom_product_gallery', 'save_custom_product_gallery');