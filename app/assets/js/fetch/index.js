import { getResponse } from "./asyncFetch.js";
import { setDataToTable } from "../data-table/dataRows.js";
import { initToolbar } from "../data-table/toolbar.js";

document.addEventListener('DOMContentLoaded',
async () => {
    let request = await getResponse({
        tag: document.querySelector('.data-table'),
        queryParams: {
        },
        method: 'GET'
    })

    setDataToTable(request.response, request.status)
    initToolbar();
})