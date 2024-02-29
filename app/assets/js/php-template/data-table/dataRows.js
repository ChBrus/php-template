import { headerTable, bodyTable, headerCols, loadingLayout, searchColumn, selectContainer } from './consts.js';
import { Dialog } from "./Dialog.js";
import { initToolbar } from './toolbar.js';

const dataRow = document.createElement('div');

export async function setDataToTable(callback, params) {
    await callback({
        file: params.file,
        method: params.method,
        queryParams: params.queryParams,
        init: params.init
    })
    .then(data => {
        if (data.status >= 400) {
            throw new Error(JSON.stringify(data));
        }

        if (params.search === false) initToolbar(callback, params);
        initDataRow(data.response);
    })
    .catch(async error => {
        const dialog = new Dialog(),
            data = JSON.parse(error.message);

        dialog.appendToBody();

        await dialog.build(data.response)
        .then(data => {
            dialog.alertInsert(data.response);
        })

        dialog.showModal();
        dialog.startErrorIcon(data.status);

        loadingLayout.removeChild(loadingLayout.querySelector('.spinner-border'));
        loadingLayout.appendChild(dialog.tableIcon);
    });
}

function initDataRow(data) {
    dataRow.classList.add('dataRow');

    if (data.length === 0) throw new Error(JSON.stringify({
        status: 404,
        response: 'No hay datos insertados en esta página'
    }))
    const headerColumns = Object.entries(data[0]).map((entry) => entry[0]),
        dataRows = getDataRows(data, headerColumns);

    bodyTable.contains(loadingLayout) ? bodyTable.removeChild(loadingLayout) : null;

    const selectColumn = searchColumn.cloneNode(),
        defaultColumn = searchColumn.children[0].cloneNode();

    selectContainer.querySelector('.form-select').remove();
    defaultColumn.textContent = 'Columna';
    selectColumn.appendChild(defaultColumn);

    headerCols.forEach((column, index) => {
        column.textContent = headerColumns[index];

        const option = document.createElement('option');
        option.value = headerColumns[index];
        option.text = headerColumns[index].toUpperCase();

        selectColumn.appendChild(option);
    });

    selectContainer.appendChild(selectColumn);

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

    for (let i = 0; i < data.length; i++) {
        let dataRowElements = getDataRowElements(),
            dataFormatted = Object.values(data[i]);

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