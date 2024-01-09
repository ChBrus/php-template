<?php
    use Build\PageBuilder;

    /**
     * Autocompleta la ruta a donde se encuentrar los middles de las conexiones
     *
     * @param string $fileName
     * @return string
     */
    function bridgeConnection($fileName) {
        $path = CONNECTION_PATH;

        if (file_exists($path . $fileName)) $path .= $fileName;
        else $path .= 'null'; 

        return $path;
    }
?>