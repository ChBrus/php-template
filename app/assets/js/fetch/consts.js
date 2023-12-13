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
},
Page = {
    __get: () => {
        return localStorage.getItem('page');
    },
    __set: (newValue) => {
        localStorage.setItem('page', newValue);
    },
    __update: () => {
        if (Page.__get() === null) Page.__set(0);
    },
    __destroy: () => {
        localStorage.removeItem('page');
    }
};