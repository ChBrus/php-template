import { bodyTable, loadingLayout, tableToolBar } from "./consts.js";
import { Page } from '../fetch/consts.js';
import { setDataToTable } from "./dataRows.js";
import { getCookie } from "../cookies/index.js";

export function initToolbar() {
    try {
        const prevTableBtn = tableToolBar.querySelector('.prev'),
            nextTableBtn = tableToolBar.querySelector('.next');

        prevTableBtn.addEventListener('click', () => changePage(true));
        nextTableBtn.addEventListener('click', () => changePage(false));
    } catch (error) {}

    document.addEventListener('keyup', (keyEvent) => {
        if (keyEvent.key === 'ArrowLeft') changePage(true);
        else if (keyEvent.key === 'ArrowRight') changePage (false);
    });

    setPageNumber();
}

/**
 * Cambia la página de la tabla
 * @param {boolean} isPrev
 */
function changePage(isPrev) {
    let currentPage = parseInt(Page.__get()),
        maxPages = parseInt(getCookie('maxPages'));

    if (isPrev && currentPage - 1 < 0) return;
    else if (!isPrev && currentPage + 2 > maxPages) return;

    currentPage = (isPrev ? currentPage - 1 : currentPage + 1);

    Page.__set(currentPage);

    setLoadingLayout();
    setDataToTable(currentPage);
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