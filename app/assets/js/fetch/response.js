import { Data } from "./consts.js";

export async function getResponse(dataFile, dataToSend = {}) {
    const response = await fetch(dataFile + '.php', Data.POST({
        password: 'javascript-async-fetch',
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