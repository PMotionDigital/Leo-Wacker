import $ from 'jquery';
import message from './message';
let currentStep = 0;
let flag = true;
let valid = false;
let skip = false;
let skipStep = -1;
let submitForm = false;

let messages = {
    ru: 'Пожалуйста, заполните все поля',
    en: 'Please fill in all fields',
    de: 'Bitte füllen Sie alle Felder aus'
};
let locale = $('#current_locale_').val();

let formularData = {};
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
    if(direction == 'next' && submitForm) {
        submitFormAction();
        console.log('here');
    } else if(flag){
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
    setData(currentStep);
    const length = $('.formular-step').length;
    if(valid){
        if(dir == 'next' && currentStep !== length -1) {
            currentStep += 1;
            if(skipStep == currentStep) {
                currentStep += 1;
            }
        } else if(dir == 'prev' && currentStep !== 0) {
            currentStep -= 1;
            submitForm = false;
            if(skipStep == currentStep) {
                currentStep -= 1;
            }
        }
        const translate = (100 / (length - 1)).toFixed(2) * (currentStep);
        $('.formular-block_progress-target').css({
            transform: `translateX(${translate}%)`
        });
    }
}
function setData(step) {
    const stepWrap = $(`.formular-step[data-step="${currentStep}"]`);
    const title = stepWrap.find('.title h2').text().trim();
    let stepValue = '';
    if(stepWrap.find('.formular-form_item').length) {
        stepValue = stepWrap.find('.formular-form_item.active .formular-form_item-title').text().trim();
        if(!stepValue || stepValue == '') {
            valid = false;
            message.setMessage(messages[locale]);
        } else {
            valid = true;
            formularData[title] = stepValue;
        }
        if(stepWrap.find('.formular-form_item.active [data-skip]').length) {
            skip = true;
            skipStep = currentStep + 1;
        } else {
            skip = false;
            skipStep = -1;
        }
    } else if (stepWrap.find('.formular-form_input').length) {
        const inputs = stepWrap.find('.formular-form_input');
        inputs.each((i, e) => {
            const label = $(e).find('.label').text().trim();
            let val = $(e).find('input').val();
            if($(e).find('[type="radio"]').length){
                val = $(e).find('input:checked').siblings('p').text().trim();
            }
            if(!val || val == '') {
                valid = false;
                message.setMessage(messages[locale]);
            } else {
                valid = true;
                formularData[label] = val;
            }
            
        });
    } else if (stepWrap.find('.formular-form.lage').length) {
        const inputs = stepWrap.find('.lage-form_input input');
        let addressString = '';
        inputs.each((i, e) => {
            if($(e).val()) {
                addressString += `${$(e).attr('placeholder')}: ${$(e).val()}, `;
            }
        });
        
        if(!addressString || addressString == '') {
            valid = false;
            message.setMessage(messages[locale]);
        } else {
            valid = true;
            formularData[title] = addressString;
        }
    } else if (stepWrap.find('.formular-form_radio').length) {
        const rows = stepWrap.find('.formular-form_radio');
        let rowString = '';
        rows.each((i, e) => {
            const rowTitle = $(e).find('.formular-form_radio-title:not(.head)').text().trim();
            const rowValue = $(e).find('[type="radio"]:checked').val();
            if(rowValue){
                rowString += `${rowTitle}: ${rowValue}; `;
            }
            
        });
        if(!rowString || rowString == '') {
            valid = false;
            message.setMessage(messages[locale]);
        } else {
            valid = true;
            formularData[title] = rowString;
        }
        
    }
    
    if(step == $('.formular-step').length - 2) {
        submitForm = true;
    } else {
        submitForm = false;
    }
    console.log(submitForm, step);
    let dataString = '';
    for(let data in formularData) {
        dataString += `${data}: ${formularData[data]}; \n`;
    }
    $('[name="your-data"]').val(dataString);
}
$('[data-modal="formular"] [data-close]').on('click', (e) => {
    currentStep = 0;
    formularData = {};
    submitForm = false;
});

function submitFormAction() {
    $('.formular-step.active form').find('input[type="submit"]').trigger( 'click' );
}


document.addEventListener('wpcf7mailsent', function(event) {
    setTimeout(() => {
        let formText = $('.wpcf7-response-output').text();
        message.setMessage(formText);
    }, 500);
}, false);
document.addEventListener('wpcf7invalid', function(event) {
    setTimeout(() => {
        let formText = $('.wpcf7-response-output').text();
        message.setMessage(formText);
    }, 500);
}, false);
document.addEventListener('wpcf7spam', function(event) {
    setTimeout(() => {
        let formText = $('.wpcf7-response-output').text();
        message.setMessage(formText);
    }, 500);
}, false);
document.addEventListener('wpcf7mailfailed', function(event) {
    setTimeout(() => {
        let formText = $('.wpcf7-response-output').text();
        message.setMessage(formText);
    }, 500);
}, false);
document.addEventListener('wpcf7submit', function(event) {
    setTimeout(() => {
        let formText = $('.wpcf7-response-output').text();
        message.setMessage(formText);
    }, 500);
    
}, false);