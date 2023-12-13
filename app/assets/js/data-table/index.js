import * as fetchResponse from '../fetch/response.js';
import * as fetchConstants from '../fetch/consts.js';
import { dataTable, headerTable, bodyTable, loadingLayout, localLocation, globalLocation, dataRow, initDataRow } from './consts.js';

async function setDataToTable() {
    fetchConstants.Page.__destroy();

    let response = await fetchResponse.getSelect(globalLocation ?? localLocation);

    initDataRow(response);

    bodyTable.appendChild(dataRow);
}

setDataToTable();