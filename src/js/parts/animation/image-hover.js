import $ from 'jquery';
import interpolation from './interpolation';


let currentImage = null;
let currentPosition = null;

let currentScale = 1;
let lastPos = {
    x: 0,
    y: 0
};
const imageAnimate = (pos, image) => {
    if(image && pos) {
        if(!image.hasClass('leave')){
            lastPos.x += Math.round((pos.x - lastPos.x)*0.08);
            lastPos.y += Math.round((pos.y - lastPos.y)*0.08);
            const scale = 1.06;
            currentScale += (scale - currentScale)*0.08;
            //console.log(`transform3d(${((lastPos.x - 50)*0.06).toFixed(1)}%, ${((lastPos.y - 50)*0.06).toFixed(1)}%, 0)`);
            
            image.css({
                transform: `translate3d(${(-(lastPos.x)*0.06).toFixed(1)}%, ${(-(lastPos.y)*0.06).toFixed(1)}%, 0) scale(${currentScale})`
            });
        }
    }
};

const animate = () => {
    imageAnimate(currentPosition, currentImage);
    requestAnimationFrame(animate);
};

$(document).on('mousemove', '[data-image-animate]', (e) => {
    const image = $(e.currentTarget).find('img');
    const {top, left, width, height} = image[0].getBoundingClientRect();
    const pos = {
        x: Number(interpolation(e.clientX, left, left + width, -50, 50).toFixed(2)),
        y: Number(interpolation(e.clientY, top, top + height, -50, 50).toFixed(2))
    };
    currentImage = image;
    currentPosition = pos;
});

$(document).on('mouseleave', '[data-image-animate]', (e) => {
    const image = $(e.currentTarget).find('img');
    //console.log(e.currentTarget);
    image.addClass('leave');
    image.css({
        transform: `translate3d(0, 0, 0) scale(1)`,
        transition: `.45s ease-out`
    });
    currentScale = 1;
    lastPos = {
        x: 0,
        y: 0
    };
});
$(document).on('mouseenter', '[data-image-animate]', (e) => {
    const image = $(e.currentTarget).find('img');
    //console.log(e.currentTarget);
    image.removeClass('leave');
    image.css({
        transition: `.0s`
    });
    // currentScale = 1;
    // lastPos = {
    //     x: 0,
    //     y: 0
    // };
});

animate();



// $(document).on('mouseenter', '[data-image-animate]', (e) => {

// });
// $(document).on('mouseleave', '[data-image-animate]', (e) => {

// });