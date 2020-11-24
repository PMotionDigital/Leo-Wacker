import $ from 'jquery';

const titles = $('[data-title-animate]');

const titleAnimate = () => {
    titles.each((i, title) => {
        const {top, height} = title.getBoundingClientRect();
        const bottom = top + height;
        const winHeight = $(window).height();
        const titleEl = $(title);
        if(top >= 0 && bottom <= winHeight - 30) {
            // show
            titleEl.removeClass('hide-top hide-bottom');
        } else if(top < 0) {
            //hide to top
            titleEl.addClass('hide-top');
        } else if (bottom > winHeight - 30) {
            // hide to bottom
            titleEl.addClass('hide-bottom');
        }
    });
};

$(window).bind('scroll', () => {
    titleAnimate();
});