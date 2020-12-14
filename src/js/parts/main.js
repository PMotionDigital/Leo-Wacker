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
if(!$('immobilien-app').length && $('#my-scrollbar').length){
    Scrollbar.init(document.querySelector('#my-scrollbar'), options);
}

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
let menuOpened = false;
$('[data-menu]').on('touchstart', (e) => {
    e.preventDefault();
    console.log('touch');
    const cont = $('[data-menu-container]');
    const contWrap = cont.find('.mobile-menu-content');
    if(menuOpened) {
        $(e.currentTarget).removeClass('opened');
        contWrap.css('opacity', '0');
        setTimeout(() => {
            cont.stop().animate({
                height: 0
            }, 300, () => {
                cont.removeClass('opened');
                cont.attr('style', '');
                menuOpened = false;
                contWrap.css('opacity', '0');
            });
        }, 250);
        
    } else {
        $(e.currentTarget).addClass('opened');
        contWrap.css('opacity', '0');
        
        cont.stop().animate({
            height: window.innerHeight - 32
        }, 300, () => {
            cont.addClass('opened');
            cont.attr('style', '');
            menuOpened = true;
            contWrap.css('opacity', '1');
        });
    }

})