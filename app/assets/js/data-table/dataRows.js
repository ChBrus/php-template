import * as fetchResponse from '../fetch/response.js';
import { Page } from '../fetch/consts.js';
import { localLocation, globalLocation, headerTable, bodyTable, headerCols, loadingLayout } from './consts.js';
import { Dialog } from "./dialog.js";

const dataRow = document.createElement('div');

export async function setDataToTable(pageNumber = null) {
   pageNumber === null ? Page.__destroy() : null;

    let response = await fetchResponse.getSelect(globalLocation ?? localLocation);  

    if (response.status === 500) {
        const dialog = new Dialog(),
            alert = response.response;

        dialog.appendToBody();

        dialog.alertInsert(alert);

        dialog.showModal();
        dialog.startErrorIcon();

        loadingLayout.removeChild(loadingLayout.querySelector('.spinner-border'));
        loadingLayout.appendChild(dialog.tableIcon);

        return;
    }

    initDataRow(response);
}

function initDataRow(data) {
    dataRow.classList.add('dataRow');

    const headerColumns = Object.entries(data.response[0]).map((entry) => entry[0]),
        dataRows = getDataRows(data, headerColumns);

    bodyTable.contains(loadingLayout) ? bodyTable.removeChild(loadingLayout) : null;

    headerCols.forEach((column, index) => {
        column.textContent = headerColumns[index];
    });
    dataRows.forEach(
    (columns) => {
        const dataRowHelp = dataRow.cloneNode();

        columns.forEach((column) => {
            dataRowHelp.appendChild(column);
        });

        bodyTable.appendChild(dataRowHelp);
    });
}

function getDataRows(data, headerColumns) {
    const dataRows = [];

    for (let i = 0; i < data.response.length; i++) {
        let dataRowElements = getDataRowElements(),
            dataFormatted = Object.values(data.response[i]);

        for (let j = 0; j < dataFormatted.length; j++) {
            dataRowElements[j].textContent = dataFormatted[j];

            if (j === 0) dataRowElements[j].classList.add(headerColumns[j]);
        }

        dataRows.push(dataRowElements);
    }

    return dataRows;
}

function getDataRowElements() {
    const columns = [];

    for (let i = 0; i < headerTable.childElementCount; i++) {
        let container = document.createElement('div');
        container.classList.add('d-col');

        columns.push(container);
    }

    return columns;
}