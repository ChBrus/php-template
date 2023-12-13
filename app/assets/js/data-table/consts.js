export const dataTable = document.querySelector('.data-table'),
    headerTable = dataTable.querySelector('.header'),
    bodyTable = dataTable.querySelector('.body'),
    loadingLayout = bodyTable.querySelector('.loading'),
    globalLocation = dataTable.getAttribute('global-location'),
    localLocation = dataTable.getAttribute('local-location');

export const dataRow = document.createElement('div');

export function initDataRow(data) {
    dataRow.classList.add('dataRow');

    let dataRows = getDataRows(data);

    dataRows.forEach((element) => {
        bodyTable.appendChild(element);
    });

    bodyTable.removeChild(loadingLayout);
}

export function getDataRows(data) {
    const dataRows = [];

    for (let i = 0; i < data.response.length; i++) {
        let dataRowElements = getDataRowElements(),
            dataFormatted = Object.values(data.response[i]);
        
        for (let j = 0; j < dataFormatted.length; j++) {
            dataRowElements[j].textContent = dataFormatted[j];
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