<?php
    use Build\PageBuilder;

    /**
     * Autocompleta la ruta a donde se encuentrar los middles de las conexiones
     *
     * @param string $fileName
     * @return string
     */
    function bridgeConnection($fileName) {
        return CONNECTION_PATH . $fileName;
    }
?>