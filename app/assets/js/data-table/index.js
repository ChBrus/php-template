import * as fetchResponse from '../fetch/response.js';
import * as fetchConstants from '../fetch/consts.js';
import { localLocation, globalLocation } from './consts.js';
import { initDataRow } from './dataRows.js';

async function setDataToTable() {
    fetchConstants.Page.__destroy();

    let response = await fetchResponse.getSelect(globalLocation ?? localLocation);  

    if (response.status === 500) {
        console.log(response.response);
        return;
    }
    initDataRow(response);
}

setDataToTable();