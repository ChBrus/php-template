export const dataTable = document.querySelector('.data-table') ?? document.getElementById('data-table'),
    headerTable = dataTable.querySelector('.header') ?? dataTable.getElementById('header'),
    headerCols = headerTable.querySelectorAll('.h-col'),
    bodyTable = dataTable.querySelector('.body') ?? dataTable.getElementById('body'),
    loadingLayout = bodyTable.querySelector('.loading'),
    globalLocation = dataTable.getAttribute('global-location'),
    localLocation = dataTable.getAttribute('local-location');