import $ from "jquery";
import Scrollbar from 'smooth-scrollbar';
import OverscrollPlugin from 'smooth-scrollbar/dist/plugins/overscroll';

const options = {
    plugins: { overscroll: 
        {
            effect: 'bounce',
            damping: 0.15,
            maxOverscroll: 100
        } 
    }
};
Scrollbar.use(OverscrollPlugin);
if(!$('immobilien-app').length){
    Scrollbar.init(document.querySelector('#my-scrollbar'), options);
}


// $(window).bind('scroll', () => {
//     changeHeader();
// });
const animate = () => {
    changeHeader();
    requestAnimationFrame(animate);
};
animate();
function changeHeader() {
    const elems = $('[data-change-header]');
    if(elems.length) {
        elems.each((i, e) => {
            const {top, height} = e.getBoundingClientRect();
            const bottom = top + height;

            if(top <= 5 && bottom >= 0) {
                $('.site-header').addClass('transparent');
                console.log(top, bottom);
            } else {
                $('.site-header').removeClass('transparent');
            }
        });
    } else {
        $('.site-header').removeClass('transparent');
    }
}