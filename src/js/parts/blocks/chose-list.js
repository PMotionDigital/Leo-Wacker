import $ from 'jquery';

$('.choselist-block [data-link]').on('click', (e) => {
    e.preventDefault();
    const type = $(e.currentTarget).data('link');
    openFormular(type);
});

function openFormular(type) {
    $('[data-modal="formular"]').addClass('opened');
    const loader = $('[data-modal="formular"] .loader');
    $.ajax({
        url: `${window.location.origin}/wp-admin/admin-ajax.php`,
        method: 'GET',
        data: {
            action: 'formular',
            type: type
        },
        beforeSend: () => {
            setTimeout(() => {
                loader.find('.loader_text--load').stop().animate({
                    width: '79%'
                }, 2000);
            }, 300);
        },
        success: (data) => {
            
            loader.find('.loader_text--load').stop().animate({
                width: '100%'
            }, 250, () => {
                setTimeout(() => {
                    loader.stop().animate({
                        opacity: 0
                    }, 250, () => {
                        loader.attr('style', '');
                        loader.addClass('hide');
                        successHandler(data);
                    });
                },250);
            });
            
        }
    })
}

function successHandler(data) {
    console.log(data);
}

