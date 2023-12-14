import * as fetchResponse from '../fetch/response.js';
import * as fetchConstants from '../fetch/consts.js';
import { localLocation, globalLocation, initDataRow } from './consts.js';

async function setDataToTable() {
    fetchConstants.Page.__destroy();

    let response = await fetchResponse.getSelect(globalLocation ?? localLocation);  

    initDataRow(response);
}

setDataToTable();