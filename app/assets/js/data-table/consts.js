export const dataTable = document.querySelector('.data-table') ?? document.getElementById('data-table'),
    tableToolBar = dataTable.querySelector('.table-toolbar'),
    prevTableBtn = tableToolBar.querySelector('.prev'),
    pageTableNumber = tableToolBar.querySelector('.page-number'),
    nextTableBtn = tableToolBar.querySelector('.next'),
    headerTable = dataTable.querySelector('.header') ?? dataTable.querySelector('#header'),
    headerCols = headerTable.querySelectorAll('.h-col'),
    bodyTable = dataTable.querySelector('.body') ?? dataTable.querySelector('#body'),
    loadingLayout = bodyTable.querySelector('.loading'),
    dataFileURL = {
        __get: () => {return dataTable.getAttribute('dataFile') ?? ''},
        __destroy: () => {
            const url = dataFileURL.__get();

            connectionURL = url.substring(0, 41);

            dataTable.setAttribute('dataFile', url.substring(41));
        }
    };

export let connectionURL = null;