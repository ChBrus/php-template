import { getResponse } from "./ajax.js";
import { setDataToTable } from "../data-table/dataRows.js";

getResponse(document.querySelector('.data-table'), {},
(data, status) => {
    data = JSON.parse(data)

    setDataToTable(data.response, data.status)
})