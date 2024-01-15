import { setDataToTable } from './dataRows.js';
import { initToolbar, setLoadingLayout } from './toolbar.js';
import { maxRows, pageTableNumber } from './consts.js';
import { Page } from '../fetch/consts.js';

$(() => {
    $(maxRows).change(() => {
        let currentPage = parseInt(Page.__get());
    
        pageTableNumber.textContent = (currentPage !== 0 ? 1 : currentPage + 1);
    
        Page.__set(0);
    
        setLoadingLayout();
        setDataToTable();
    });
});

setDataToTable();
initToolbar();