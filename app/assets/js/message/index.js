import { btnsQueryMsg } from "./consts.js";

btnsQueryMsg.forEach((btnQueryMsg) => {
    btnQueryMsg.addEventListener('click',
    () => {
        location.href = URLToGo;
    });
});