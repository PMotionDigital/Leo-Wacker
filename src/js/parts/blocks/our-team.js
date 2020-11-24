import $ from 'jquery';
import Glide from '@glidejs/glide';

let startAt = 0;
if( $('.glide-slider [data-title]').length >= 3 ){
    startAt = 1;
}
const options = {
    type: 'slider',
    focusAt: 'center',
    animationDuration: 800,
    rewindDuration: 1000,
    gap: 0,
    startAt: startAt
};
if($('.glide-slider').length){
    const glide = new Glide('.glide-slider', options).mount();
}
