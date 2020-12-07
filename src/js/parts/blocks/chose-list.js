import $ from 'jquery';

$('.choselist-block [data-link]').on('click', (e) => {
    e.preventDefault();
    const type = $(e.currentTarget).data('link');
    openFormular(type);
});
$('[data-modal="formular"] [data-close]').on('click', (e) => {
    e.preventDefault();
    $('[data-modal="formular"]').removeClass('opened');
    setTimeout(() => {
        $('[data-modal="formular"] .loader').removeClass('hide');
        $('[data-modal="formular"] .formular-block').remove();
    }, 300);
});
function openFormular(type) {
    $('[data-modal="formular"]').addClass('opened');
    const loader = $('[data-modal="formular"] .loader');
    $.ajax({
        url: `${window.location.origin}/wp-admin/admin-ajax.php`,
        method: 'GET',
        data: {
            action: 'formular',
            type: type,
            lang: $('#current_locale_').val()
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
                        loader.find('.loader_text--load').attr('style', '');
                        successHandler(JSON.parse(data));
                    });
                },250);
            });
        }
    })
}

function successHandler(data) {
    console.log(data);
    $('[data-modal="formular"]').append(data.header + data.content + data.footer);
}

