import { getResponse } from "./asyncFetch.js";
import { setDataToTable } from "../data-table/dataRows.js";
import { getDecodedCookie } from "../../cookies/index.js";

document.addEventListener('DOMContentLoaded',
async () => {
    setDataToTable(getResponse, {
        file: getDecodedCookie('projectName') + 'api/test-table',
        method: 'GET',
        init: true,
        search: false
    })
})