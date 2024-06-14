
(function( $ ){

    $(document).on('click','.slider__prev',function(e){
       e.preventDefault();
    })

    $(document).on('click','.slider__next',function(e){
        e.preventDefault();
     })
    $(document).on('click','.slider_item',function(e){
        e.preventDefault();
        //slider_functionalities();
    }) 
    $(document).on('click','.lightbox__next',function(e){
        e.preventDefault();
        //slider_functionalities();
    }) 
    $(document).on('click','.lightbox__close',function(e){
        e.preventDefault();
       // slider_functionalities();
    }) 
    $(document).on('click','.lightbox__prev',function(e){
        e.preventDefault();
       // slider_functionalities();
    }) 
       
   
    $('.slider__prev').css('backgroundColor',$('#wpadminbar').css("backgroundColor"))
    $('.slider__next').css('backgroundColor',$('#wpadminbar').css("backgroundColor"))
    $('.lightbox__next').css('backgroundColor',$('#wpadminbar').css("backgroundColor"))
    $('.lightbox__prev').css('backgroundColor',$('#wpadminbar').css("backgroundColor"))



 })( jQuery );

document.addEventListener("DOMContentLoaded", slider_functionalities())
function slider_functionalities()
{
    const slider = document.querySelector(".custom_slider");
    const sliderItems = document.querySelectorAll(".slider__item");
    const prevButton = document.querySelector(".slider__prev");
    const nextButton = document.querySelector(".slider__next");
    const lightbox = document.querySelector(".slider_lightbox");
    const lightboxContent = document.querySelector(".lightbox__content");
    const lightboxPrevButton = document.querySelector(".lightbox__prev");
    const lightboxNextButton = document.querySelector(".lightbox__next");
    const closeLightboxButton = document.querySelector(".lightbox__close");
    let currentIndex = 0;

    const pdfItems = document.querySelectorAll(
      ".slider__item[src$='.pdf']"
    );
    pdfItems.forEach(function (item) {
      item.querySelector("iframe").src += "#toolbar=0";
    });

    function showSlide(index) {
      slider.style.transform = `translateX(-${index * 100}%)`;
    }

    function showNextSlide() {
      currentIndex = (currentIndex + 1) % sliderItems.length;
      showSlide(currentIndex);
    }

    function showPrevSlide() {
      currentIndex =
        (currentIndex - 1 + sliderItems.length) % sliderItems.length;
      showSlide(currentIndex);
    }

    function openLightbox(index) {
      currentIndex = index;
      updateLightbox();
      lightbox.style.display = "flex";
      document.body.style.overflow = "hidden";
    }

    function closeLightbox() {
      lightbox.style.display = "none";
      document.body.style.overflow = "";
    }

    function updateLightbox() {
      const currentItem = sliderItems[currentIndex];
      const isImage = currentItem.querySelector("img") !== null;
      const isPDF = currentItem.querySelector("iframe") !== null;

      lightboxContent.innerHTML = "";
      if (isImage) {
        const img = document.createElement("img");
        img.src = currentItem.querySelector("img").src;
        img.alt = currentItem.querySelector("img").alt || "Slider Image";
        lightboxContent.appendChild(img);
      } else if (isPDF) {
        const iframe = document.createElement("iframe");
        iframe.src = currentItem.querySelector("iframe").src;
        iframe.type = "application/pdf";
        lightboxContent.appendChild(iframe);
      }
    }

    function showLightboxPrevious() {
      currentIndex =
        (currentIndex - 1 + sliderItems.length) % sliderItems.length;
      updateLightbox();
    }

    function showLightboxNext() {
      currentIndex = (currentIndex + 1) % sliderItems.length;
      updateLightbox();
    }

    sliderItems.forEach((item, index) => {
      item.addEventListener("click", () => openLightbox(index));
    });

    prevButton.addEventListener("click", showPrevSlide);
    nextButton.addEventListener("click", showNextSlide);

    lightboxPrevButton.addEventListener("click", showLightboxPrevious);
    lightboxNextButton.addEventListener("click", showLightboxNext);
    closeLightboxButton.addEventListener("click", closeLightbox);

    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) {
        closeLightbox();
      }
    });

    document.addEventListener("keydown", (e) => {
      if (lightbox.style.display === "flex") {
        if (e.key === "ArrowLeft") showLightboxPrevious();
        if (e.key === "ArrowRight") showLightboxNext();
        if (e.key === "Escape") closeLightbox();
      }
    });
    
}


