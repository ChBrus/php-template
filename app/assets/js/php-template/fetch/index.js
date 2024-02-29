import { getResponse } from "./asyncFetch.js";
import { setDataToTable } from "../data-table/dataRows.js";

document.addEventListener('DOMContentLoaded',
async () => {
    setDataToTable(getResponse, {
        file: 'api/test-table',
        method: 'GET',
        init: true,
        search: false
    })
})