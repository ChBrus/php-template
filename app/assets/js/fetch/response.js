import { Data, Page } from "./consts.js";

export async function getResponse(dataFile, dataToSend = {}) {
    Page.__update();
    let page = Page.__get();
    const response = await fetch(dataFile + '.php', Data.POST({
        password: 'javascript-async-fetch',
        page: page,
        data: dataToSend
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