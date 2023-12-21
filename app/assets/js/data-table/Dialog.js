export class Dialog {
    constructor() {
        this.dialog = document.createElement('dialog');
        this.tableIcon = document.createElement('i');

        // Dialog config
        this.dialog.classList.add('dialog-alert');
    }

    alertInsert(alert) {
        this.dialog.innerHTML = alert;

        this.alert = this.dialog.querySelector('.query-msg');
        this.alertBtn = this.alert.querySelector('#query-msg-btn-icon');

        this.startEvents();
    }

    startEvents() {
        this.alertBtn.addEventListener('click',
        () => {
            this.close();
        });
    }

    appendToBody() {
        document.body.appendChild(this.dialog);
    }

    showModal() {
        this.dialog.showModal();
    }

    close() {
        this.dialog.close();
        document.body.removeChild(this.dialog);
    }

    startErrorIcon() {
        this.tableIcon.classList.add('bi');
        this.tableIcon.classList.add('bi-exclamation-triangle-fill');
        this.tableIcon.classList.add('table-error-icon');
    }
}