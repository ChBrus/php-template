import { getResponse } from "./asyncFetch.js";
import { setDataToTable } from "../data-table/dataRows.js";
import { initToolbar } from "../data-table/toolbar.js";

document.addEventListener('DOMContentLoaded',
async () => {
    let request = await getResponse({
        file: '/api/test-table',
        method: 'GET',
        init: true
    })

    setDataToTable(request.response, request.status)
    initToolbar();
})