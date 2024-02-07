import { bodyTable, loadingLayout, tableToolBar, searchControl, selectContainer } from "./consts.js";
import { Page } from '../fetch/consts.js';
import { setDataToTable } from "./dataRows.js";
import { getCookie, setCookie } from "../../cookies/index.js";

export function initToolbar(callback, params) {
    const searchForm = document.querySelector('.search-form .btn[type="submit"]'),
        maxRows = tableToolBar.querySelector('.toolbar-item .max-rows');

    try {
        const prevTableBtn = tableToolBar.querySelector('.prev'),
            nextTableBtn = tableToolBar.querySelector('.next');

        prevTableBtn.addEventListener('click', () => changePage(true, callback, params));
        nextTableBtn.addEventListener('click', () => changePage(false, callback, params));
    } catch (error) {}

    searchForm.addEventListener('click', event => search(event, callback, params));

    document.addEventListener('keyup', (keyEvent) => {
        if (keyEvent.key === 'ArrowLeft') changePage(true, callback, params);
        else if (keyEvent.key === 'ArrowRight') changePage (false, callback, params);
    });

    maxRows.addEventListener('change', () => {
        setCookie('maxRows', maxRows.value);

        setLoadingLayout();
        setDataToTable(callback, {
            file: params.file,
            method: params.method,
            queryParams: params.queryParams,
            init: false
        }, true);

        setPageNumber();
    });

    setCookie('maxRows', '', Date.now());
    setPageNumber();
}

async function search(event, callback, params) {
    event.preventDefault();

    setLoadingLayout();
    setDataToTable(callback, {
        file: params.file,
        method: params.method,
        queryParams: {
            type: 'search',
            columna: selectContainer.querySelector('.form-select').value,
            searchVal: searchControl.value
        },
        init: false
    }, true);

    Page.__set(0);
}

/**
 * Cambia la página de la tabla
 * @param {boolean|string} isPrev
 * @param {Function} callback
 */
async function changePage(isPrev, callback, params) {
    let currentPage = parseInt(Page.__get()),
        maxPages = parseInt(getCookie('maxPages'));

    if (isPrev && currentPage - 1 < 0) return;
    else if (!isPrev && currentPage + 2 > maxPages) return;

    currentPage = (isPrev ? currentPage - 1 : currentPage + 1);

    Page.__set(currentPage);

    setLoadingLayout();
    setDataToTable(callback, {
        file: params.file,
        method: params.method,
        init: false
    });
    setPageNumber();
}

export function setLoadingLayout() {
    Object.values(bodyTable.children).forEach(rowData => {
        bodyTable.removeChild(rowData);
    });

    bodyTable.appendChild(loadingLayout);
}

/**
 * Pone el número de la página
 */
export function setPageNumber() {
    try {
        const pageTableNumber = tableToolBar.querySelector('.page-number');

        pageTableNumber.textContent = (parseInt(Page.__get()) + 1);
    } catch (error) {}
}