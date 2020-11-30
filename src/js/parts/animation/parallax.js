import $ from 'jquery';
import interpolation from './interpolation';

const parallax = () => {
    const elems = $('[data-parallax]');
    if(elems.length){
        elems.each((i, el) => {
            const {top, height} = el.getBoundingClientRect();
            const bottom = top + height;
            const winHeight = $(window).height();
            const elem = $(el);

            const coef = elem.data('parallax') || 15;
            if(top >= -winHeight && bottom <= winHeight * 2) {
                const translate = interpolation(top+height/2, 0, winHeight, -1, 1) * coef * winHeight / 100;
                elem.css({
                    transform: `translate3d(0, ${translate}px, 0)`
                });
            }
        });
    }
}

const coverParallax = () => {
    const elems = $('[data-parallax-cover]');
    if(elems.length){
        elems.each((i, el) => {
            const {top, height} = el.getBoundingClientRect();
            const bottom = top + height;
            const winHeight = $(window).height();
            const elem = $(el);

            const coef = elem.data('parallax-cover') || 15;
            if(top >= - height && bottom <= winHeight + height) {
                const translate = interpolation(top, 0, winHeight, 0, -1) * coef * winHeight / 100;
                elem.css({
                    transform: `translate3d(0, ${translate}px, 0)`,
                    height: '110%'
                });
            }
        });
    }
}
// parallax();
// coverParallax();
// $(window).bind('scroll', ()=> {
//     parallax();
//     coverParallax();
// });

const animate = () => {
    parallax();
    coverParallax();
    requestAnimationFrame(animate);
}
animate();