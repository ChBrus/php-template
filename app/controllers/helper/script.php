<?php
    use Build\PageBuilder;

    /**
     * Ayuda a implementar cualquier script deseado
     *
     * @param string $scriptName
     * El nombre del script - Incluyendo la subcarpeta en la que está.
     * @param boolean $isModule
     * Verificar si es un module script lo que se desea
     * @return string
     * El script implementado
     */
    function script(string $scriptName, bool $isModule = false) {
        return PageBuilder::buildScript($scriptName, $isModule);
    }
?>