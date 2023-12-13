import { Data, Page } from "./consts.js";

export async function getSelect(locationURL) {
    Page.__update();
    let page = Page.__get();
    const response = await fetch(locationURL + 'select.php', Data.POST({
        password: 'javascript-async-fetch',
        page: page
    }));

    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    return {
        type: 'select',
        status: data.status,
        response: data.response
    };
}