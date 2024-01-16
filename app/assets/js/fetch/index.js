import { getResponse } from "./asyncFetch.js";
import { setDataToTable } from "../data-table/dataRows.js";

document.addEventListener('DOMContentLoaded',
async () => {
    let request = await getResponse(document.querySelector('.data-table'), {msg: 'waos'}, 'GET')

    console.log(request)
    // setDataToTable(request.response, request.status)
})