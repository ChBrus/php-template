import { METHOD_REQUEST, Page, dataFileURL, connectionURL, pageNumber, pageNumberConf } from "./consts.js"

export async function getResponse({tag, queryParams = {}, method = 'POST'}) {
    if (pageNumber === null) {
        Page.__destroy();
    }

    Page.__update();
    pageNumberConf.__set(Page.__get());

    dataFileURL.__destroy(tag);

    let response = null;

    if (method === 'GET') {
        response = await GET(dataFileURL.__getFile(tag), queryParams);
    } else {
        response = await fetch(`${connectionURL + dataFileURL.__getFile(tag)}.php`, METHOD_REQUEST.METHOD({
            data: queryParams,
            page: pageNumber
        }, method));
    }

    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }

    const data = await response.json();

    return {
        status: data.status,
        response: data.response
    };
}

async function GET(tag, queryParams) {
    // Crear un objeto URLSearchParams para construir los parámetros de la consulta
    const params = new URLSearchParams();

    // Agregar los parámetros a la URLSearchParams
    for (const [key, value] of Object.entries(queryParams)) {
        params.append(key, value);
    }

    let url = `${connectionURL + tag}.php?${params.toString()}`;

    return await fetch(url, METHOD_REQUEST.GET());
}