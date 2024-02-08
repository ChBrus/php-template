import { bodyTable, loadingLayout, tableToolBar, searchControl, selectContainer } from "./consts.js";
import { Page } from '../fetch/consts.js';
import { setDataToTable } from "./dataRows.js";
import { getCookie, setCookie } from "../../cookies/index.js";

export function initToolbar(callback, params) {
    try {
        const prevTableBtn = tableToolBar.querySelector('.prev'),
            nextTableBtn = tableToolBar.querySelector('.next'),
            searchForm = document.querySelector('.search-form .btn[type="submit"]'),
            maxRows = tableToolBar.querySelector('.toolbar-item .max-rows'),
            reload = tableToolBar.querySelector('.toolbar-item .btn-reload');;

        prevTableBtn.addEventListener('click', () => changePage(true, callback, params));
        nextTableBtn.addEventListener('click', () => changePage(false, callback, params));

        searchForm.addEventListener('click', event => search(event, callback, params));

        reload.addEventListener('click', () => {
            setCookie('maxRows', maxRows.value, 1);

            setLoadingLayout();
            Page.__set(0);
            setPageNumber();
            setDataToTable(callback, {
                file: params.file,
                method: params.method,
                queryParams: params.queryParams,
                init: false,
                search: true
            });
            localStorage.setItem('search', true);
        })
    } catch (error) {}

    document.addEventListener('keyup', (keyEvent) => {
        if (keyEvent.key === 'ArrowLeft') changePage(true, callback, params);
        else if (keyEvent.key === 'ArrowRight') changePage (false, callback, params);
    });

    setCookie('maxRows', null, 0);
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
        init: false,
        search: params.init ? localStorage.getItem('search') : false
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