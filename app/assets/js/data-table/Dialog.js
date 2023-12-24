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
        this.clickAlertEvent = () => {
            this.close();
        };

        this.alertBtn.addEventListener('click', this.clickAlertEvent);

        this.keyUpAlertEvent = (keyEvent) => {
            if (keyEvent.code === 'Enter' || keyEvent.code === 'Space') {
                this.close();
            }
        };

        document.addEventListener('keyup', this.keyUpAlertEvent);
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
        document.removeEventListener('click', this.clickAlertEvent);
        document.removeEventListener('keyup', this.keyUpAlertEvent);
    }

    startErrorIcon(status) {
        this.tableIcon.classList.add('bi');
        switch(status) {
            case 500:
                this.tableIcon.classList.add('bi-exclamation-triangle-fill');
            break;
            case 501:
                this.tableIcon.classList.add('bi-question-diamond-fill');
            break;
            default:
                this.tableIcon.classList.add('bi-exclamation-triangle-fill');

        }
        this.tableIcon.classList.add('table-error-icon');
    }
}