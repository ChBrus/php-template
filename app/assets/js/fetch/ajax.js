import { dataFileURL, connectionURL } from "./consts.js"

/**
 * Obtiene la respuesta del archivo al que nos conectamos
 * @param {*} tag 
 * @param {object} arrayData 
 * @param {*} successStatement
 */
export async function getResponse(tag, arrayData = {}, successStatement = (data, status) => {}) {
    dataFileURL.__destroy(tag)

    $.ajax({
        headers: {
            'Content-Type': 'application/json'
        },
        type: "POST",
        url: `${connectionURL + dataFileURL.__getFile(tag)}.php`,
        data: arrayData,
        success: successStatement,
    })
}