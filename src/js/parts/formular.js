import $ from 'jquery';
let currentStep = 0;
let flag = true;

$(document).on('click', '.formular-form_item', (e) => {
    e.preventDefault();
    $(e.currentTarget)
        .addClass('active')
        .siblings().removeClass('active');
});

$(document).on('click', '.formular-block_controlls button', (e) => {
    e.preventDefault();
    const direction = $(e.currentTarget).data('btn');
    const prevStep = currentStep;
    if(flag){
        nextStep(direction);
        if(prevStep !== currentStep) {
            flag = false;
            $(`.formular-step.active`).stop().animate({
                opacity: 0
            }, 250, () => {
                $(`.formular-step[data-step="${prevStep}"]`).attr('style', '');
                $(`.formular-step[data-step="${currentStep}"]`).css({
                    opacity: 0
                });
                $(`.formular-step[data-step="${currentStep}"]`).addClass('active').siblings().removeClass('active');
                $(`.formular-step[data-step="${currentStep}"]`).stop().animate({
                    opacity: 1
                }, 250, () => {
                    flag = true;
                });
            });
        }
    }
});

function nextStep(dir) {
    const length = $('.formular-step').length;
    if(dir == 'next' && currentStep !== length -1) {
        currentStep += 1;
    } else if(dir == 'prev' && currentStep !== 0) {
        currentStep -= 1;
    }
    const translate = (100 / (length - 1)).toFixed(2) * (currentStep);
    $('.formular-block_progress-target').css({
        transform: `translateX(${translate}%)`
    });

}

$('[data-modal="formular"] [data-close]').on('click', (e) => {
    currentStep = 0;
});