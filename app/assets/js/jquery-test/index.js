import { Dialog } from '../data-table/Dialog.js';

$().ready(() => {
    $('.btn.btn-blue').click(() => {
        const testingAjax = document.querySelector('.testing-ajax');

        $.post('/php-template/app/controllers/connection/null.php',
        {
            animal: 'Michi'
        },
        (data, status) => {
            if (status === 'success') {
                $('.btn.btn-blue').hide();
                const responseJSON = JSON.parse(data);

                const dialog = new Dialog();
                
                dialog.alertInsert(responseJSON.response);
                dialog.startEvents();
                dialog.startErrorIcon(responseJSON.status);
                dialog.appendToBody();
                dialog.showModal();
            }
        });
    });
});