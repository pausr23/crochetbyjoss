import './bootstrap';
import Swiper from 'swiper';
import 'swiper/swiper-bundle.min.css';

document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper', {
        slidesPerView: 3, // Número de imágenes que se muestran por fila en pantallas grandes
        spaceBetween: 20, // Espacio entre imágenes
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2, // En tablets y móviles pequeños se muestran 2 imágenes
            },
            480: {
                slidesPerView: 1, // En móviles pequeños solo 1 imagen
            },
        },
    });
});

