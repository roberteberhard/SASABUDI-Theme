/**
 * Observes all lazy load images and show the images accordinally. 
 */
export const AppObserver = () => {

  const elements = {
    imgArr: [].slice.call(document.querySelectorAll("img.lazy-img")),
    divArr: [].slice.call(document.querySelectorAll("div.lazy-bg"))
  }

  const init = () => {

    const imageObserver = new IntersectionObserver( (entries, imageObserver) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {

          let lazyImage = entry.target
          
          if ( ! lazyImage.classList.contains('lazy-fade') ) {

            /**
             * Check if a <img.lazy-img> element excist. If so then exchange the 'lazy-img'
             * with the 'lazy-fade' class and remove the element from the image observer list.
             */
            if (lazyImage.classList.contains('lazy-img')) {

              /**
               * Simply fade-in all images.
               */
              if( ! lazyImage.dataset.src ) {
                lazyImage.classList.remove('lazy-img');
                lazyImage.classList.add('lazy-fade');
                imageObserver.unobserve(lazyImage);
              }

              /**
               * Replace the img 'src' value from the one out
               * of the a 'data-src' element and then fade-in the image.
               */
              if( lazyImage.dataset.src ) {
                lazyImage.src = lazyImage.dataset.src;
                lazyImage.classList.remove('lazy-img');
                lazyImage.classList.add('lazy-fade');
                delete lazyImage.dataset.src;
                imageObserver.unobserve(lazyImage);
              }
            }

            /**
             * Check if a <div.lazy-bg> element excist. If so then exchange the 'lazy-bg'
             * with the 'lazy-fade' class and remove the element from the image observer list.
             */
            if (lazyImage.classList.contains('lazy-bg')) {

              /**
               * Simply fade in all background images.
               */
              if( ! lazyImage.dataset.src ) {
                lazyImage.classList.remove('lazy-bg');
                lazyImage.classList.add('lazy-fade');
                imageObserver.unobserve(lazyImage);
              }
              
              /**
               * Replace the background image 'src' value from the one out
               * of the a 'data-src' element and then fade-in the image.
               */
              if( lazyImage.dataset.src ) {
                lazyImage.style.backgroundImage = `url(${lazyImage.dataset.src})`;
                lazyImage.classList.remove('lazy-bg');
                lazyImage.classList.add('lazy-fade');
                delete lazyImage.dataset.src;
                imageObserver.unobserve(lazyImage);
              }
            }
          }
        }
      })
    }, {rootMargin: "300px 0px 300px 0px"} );

    const { imgArr,divArr } = elements;
    const images = imgArr.concat(divArr);

    images.forEach((v) => {
      imageObserver.observe(v);
    });
  };

  init();
};
