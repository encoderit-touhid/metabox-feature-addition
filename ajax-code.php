<?php
function save_custom_product_gallery() {
    check_ajax_referer('custom_product_gallery_nonce', 'nonce');
    $image_ids = !empty($_POST['imageIds']) ? $_POST['imageIds'] : array();
    $image_ids_str = implode(',', $image_ids);

    // Debug: Check if AJAX action is triggered
   // error_log('AJAX action triggered');
    //echo '<div class="lightbox_slider_container">';
    if(count($image_ids) == 1)
    {
      $hide_class='arrow_false';
    }else
    {
      $hide_class=' ';
    }

    echo '<div class="lightbox_slider_container '.$hide_class.'">';
    echo '<div class="custom_slider">';
      foreach ($image_ids as $image_id) {
        $attacment_url=wp_get_attachment_url($image_id);
      //  var_dump(  $attacment_url);
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
      echo '<div class="slider_lightbox '.$hide_class.'">
      <button class="lightbox__close">×</button>
      <button class="lightbox__prev">
        <img
          src="'.plugins_url('assets/images/pagination_left_icon.png', __FILE__).'"
          alt="Previous"
        />
      </button>
      <div class="lightbox__content"></div>
      <button class="lightbox__next">
        <img
          src="'.plugins_url('assets/images/pagination_right_icon.png', __FILE__).'"
          alt="Next"
        />
      </button>
    </div>';
    die();
}
add_action('wp_ajax_save_custom_product_gallery', 'save_custom_product_gallery');