import { setDataToTable } from './dataRows.js';
import { initToolbar, setLoadingLayout, setPageNumber } from './toolbar.js';
import { maxRows } from './consts.js';
import { Page } from '../fetch/consts.js';

maxRows.addEventListener('change',
() => {
    let currentPage = parseInt(Page.__get());

    Page.__set(currentPage);

    setLoadingLayout();
    setDataToTable(currentPage);
    setPageNumber();
});

setDataToTable();
initToolbar();