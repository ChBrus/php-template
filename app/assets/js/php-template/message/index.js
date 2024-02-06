import { btnsQueryMsg } from "./consts.js";

btnsQueryMsg.forEach((btnQueryMsg) => {
    btnQueryMsg.addEventListener('click',
    () => {
        const locationURL = btnQueryMsg.getAttribute('location');

        if (locationURL === 'null') {
            history.back();
            return;
        }

        location.href = locationURL;
    });
});