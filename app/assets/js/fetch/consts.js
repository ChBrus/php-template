export const METHOD_REQUEST = {
    METHOD: (postData, method) => {
        return {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postData)
        };
    },
    GET: () => {
        return {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
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
},
dataFileURL = {
    __getFile: tag => tag.getAttribute('data-file') ?? '',
    __getLength: tag => tag.getAttribute('data-length'),
    __destroy: tag => {
        const url = dataFileURL.__getFile(tag);

        connectionURL = url.substring(0, dataFileURL.__getLength(tag));

        tag.setAttribute('data-file', url.substring(dataFileURL.__getLength(tag)));
    }
},
pageNumberConf = {
    __set: value => {
        pageNumber = value;
    }
};

export let connectionURL,
    pageNumber;