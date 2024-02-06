import { METHOD_REQUEST, Page, dataFileURL, connectionURL, pageNumberConf } from "./consts.js"

export async function getResponse({
    tag = null,
    file = null,
    queryParams = {},
    method = 'POST',
    init = false
}) {
    try {
        if (init === true) {
            Page.__destroy()
        }

        let url

        if (file === null) {
            dataFileURL.__destroy(tag);
            url = {
                type: 'tag-url',
                body: dataFileURL.__getFile(tag)
            }
        } else {
            url = {
                type: 'file-url',
                body: file
            }
        }

        Page.__update()
        pageNumberConf.__set(Page.__get())

        let response

        if (method === 'GET') {
            response = await GET(url, {
                data: queryParams,
                page: Page.__get()
            })
        } else {
            response = await fetch(url.type === 'tag-url' ? `${connectionURL + url.body}` : `${url.body}`, METHOD_REQUEST.METHOD(queryParams, method))
        }

        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`)

        let data = await response.text()

        try {
            data = JSON.parse(data);
            
            return {
                status: data.status,
                response: data.response
            };
        } catch (error) {
            return data;
        }
    } catch (error) {
        
    }
}

async function GET(tag, queryParams) {
    // Crear un objeto URLSearchParams para construir los parámetros de la consulta
    const params = new URLSearchParams()

    // Agregar los parámetros a la URLSearchParams
    for (const [key, value] of Object.entries(queryParams)) {
        params.append(key, value)
    }

    let url = tag.type === 'tag-url' ? `${connectionURL + tag.body}` : `${tag.body}`
    url += `?${params.toString()}`

    return fetch(url, METHOD_REQUEST.GET())
}