import $ from 'jquery';

export default {
    setMessage: (text) => {
        if(!$('#massage-block').length) {
            $('body').append(`
            <div id="message-block">
                <p class="message-block_text"></p>   
            </div>  
            `);
        }
        setTimeout(() => {
            const mes = $('#message-block');
            mes.addClass('opened');
            mes.find('.message-block_text').html(text);
            setTimeout(() => {
                mes.removeClass('opened');
            }, 2500);
        },100);
    }
}
