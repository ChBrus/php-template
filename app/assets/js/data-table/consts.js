export const dataTable = document.querySelector('.data-table'),
    globalLocation = dataTable.getAttribute('global-location'),
    localLocation = dataTable.getAttribute('local-location');

export const Data = {
    POST: (postData) => {
        return {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postData)
        };
    },
    GET: (fileName, queryParams) => {
        // Crear un objeto URLSearchParams para construir los parámetros de la consulta
        const params = new URLSearchParams();

        // Agregar los parámetros a la URLSearchParams
        for (const [key, value] of Object.entries(queryParams)) {
            params.append(key, value);
        }

        return {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
            url: globalLocation + fileName + '.php' + '?' + params.toString()
        };  
    }
};