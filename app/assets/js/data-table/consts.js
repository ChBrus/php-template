export const dataTable = document.querySelector('.data-table'),
    headerTable = dataTable.querySelector('.header'),
    headerCols = headerTable.querySelectorAll('.h-col'),
    bodyTable = dataTable.querySelector('.body'),
    loadingLayout = bodyTable.querySelector('.loading'),
    globalLocation = dataTable.getAttribute('global-location'),
    localLocation = dataTable.getAttribute('local-location');

export const dataRow = document.createElement('div');

export function initDataRow(data) {
    dataRow.classList.add('dataRow');

    const dataRows = getDataRows(data),
        headerColumns = Object.entries(data.response[0]).map((entry) => entry[0]);

    bodyTable.removeChild(loadingLayout);

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

function getDataRows(data) {
    const dataRows = [];

    for (let i = 0; i < data.response.length; i++) {
        let dataRowElements = getDataRowElements(),
            dataFormatted = Object.values(data.response[i]);
        
        for (let j = 0; j < dataFormatted.length; j++) {
            let container = document.createElement('div');
            container.textContent = dataFormatted[j];

            dataRowElements[j].appendChild(container);
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