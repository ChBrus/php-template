import { Data } from "./consts.js";

export async function getSelect(locationURL) {
    let page = localStorage.getItem('page') ?? 0;
    if(page === 0) {
        null
    };
    const response = await fetch(locationURL + 'select.php', Data.POST({
        Page: page
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