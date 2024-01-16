import { METHOD_REQUEST, Page, dataFileURL, connectionURL, pageNumber, pageNumberConf } from "./consts.js"

export async function getResponse(tag, dataToSend = {}, method = 'POST') {
    if (pageNumber === null) {
        Page.__destroy();
    }

    Page.__update();
    pageNumberConf.__set(Page.__get());

    dataFileURL.__destroy(tag);

    let response = null;

    if (method === 'GET') {
        response = await fetch(`${connectionURL + dataFileURL.__getFile(tag)}.php`, METHOD_REQUEST.GET(dataFileURL.__getFile(tag), dataToSend));
    } else {
        response = await fetch(`${connectionURL + dataFileURL.__getFile(tag)}`, METHOD_REQUEST.METHOD({
            data: dataToSend,
            page: pageNumber
        }, method));
    }

    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.text();
    console.log(data);

    return {
        status: data.status,
        response: data.response
    };
}