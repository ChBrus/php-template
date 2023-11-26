<?php
    use Build\PageBuilder;

    /**
     * Imprime en la página cualquier componente dado y le enviamos datos por medio de un método POST
     *
     * @param string $file
     * El archivo o componente al que vamos a imprimir en la página
     * @param array $data
     * Los datos que se le van a enviar
     * @return string
     */
    function view($file, $data = []) {
        return PageBuilder::view($file, $data);
    }
?>