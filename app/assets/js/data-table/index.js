import { setDataToTable } from './dataRows.js';
import { initToolbar, setLoadingLayout } from './toolbar.js';
import { maxRows } from './consts.js';
import { Page } from '../fetch/consts.js';

$(maxRows).change(() => {
    let currentPage = parseInt(Page.__get());

    Page.__set(currentPage);

    setLoadingLayout();
    setDataToTable(currentPage);
});

setDataToTable();
initToolbar();