<div class="modal-yy" tabindex="-1" id="update_modal_admin">
        <!-- <div class="modal-dialog modal-xl">
            <div class="modal-content text-center"> -->
            <div class="lightbox_slider_container">
      <div class="custom_slider">
       <script>var image_urls=[];</script>
       <?php
       if(!empty($gallery_data['image_url'] ))
       {
        for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ )
        {
            if(str_contains($gallery_data['image_url'][$i],'pdf'))
            {
               ?><iframe class="slider__item" src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"></iframe><?php

            }else
            {
              ?>
              <img
                class="slider__item"
                src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
                alt="Slider Image"
                />
              <?php
            }
            ?>
             <script>
              
              image_urls.push(`<?php echo ( $gallery_data['image_url'][$i] ); ?>`);
            </script>
            <?php 
        }
       }
        
       ?>
       
       <?php
             
        ?>
       
      <button class="slider__prev" type="button">
        <img
          src="https://pixpine.com/wp-content/themes/pixpine/assets/images/pagination_left_icon.png"
          alt="Previous"
        />
      </button>
      <button class="slider__next" type="button">
        <img
          src="https://pixpine.com/wp-content/themes/pixpine/assets/images/pagination_right_icon.png"
          alt="Next"
        />
      </button>
    </div>

    <div class="slider_lightbox">
      <button type="button" class="lightbox__close">×</button>
      <button type="button" class="lightbox__prev">
        <img
          src="https://pixpine.com/wp-content/themes/pixpine/assets/images/pagination_left_icon.png"
          alt="Previous"
        />
      </button>
      <div class="lightbox__content"></div>
      <button type="button" class="lightbox__next">
        <img
          src="https://pixpine.com/wp-content/themes/pixpine/assets/images/pagination_right_icon.png"
          alt="Next"
        />
      </button>
    </div>
            <!-- </div>
        </div> -->
    </div>