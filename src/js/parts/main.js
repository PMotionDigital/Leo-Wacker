import $ from "jquery";

$(window).bind('scroll', () => {
    changeHeader();
});
changeHeader();
function changeHeader() {
    const elems = $('[data-change-header]');
    if(elems.lingth) {
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