<?php
    use Tools\Env;

    /**
     * Autocompleta la ruta a donde se encuentrar los middles de las conexiones
     *
     * @param string $fileName
     * @return string
     */
    function bridgeConnection($fileName) {
        $path = CONNECTION_PATH;
        $originalPath = str_replace('\\', '/', Env::getEnvFile()) . '/..';

        if (file_exists($originalPath . $path . $fileName . '.php')) $path .= $fileName;
        else $path .= 'null';

        return $path;
    }

    /**
     * Obtienes la cantidad de carácteres que tiene la ruta
     * a la conexión
     *
     * @return int
     */
    function getLengthConnection() {
        return strlen(CONNECTION_PATH);
    }
?>