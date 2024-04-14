<?php

/**
 * Autocompleta la ruta a donde se encuentrar los middles de las conexiones
 *
 * @param string $fileName
 * @return string
 */
function bridgeConnection($fileName) {
    $path = API_PATH;

    $path .= $fileName;

    return $path;
}

/**
 * Obtienes la cantidad de carácteres que tiene la ruta
 * a la conexión
 *
 * @return int
 */
function getLengthConnection() {
    return strlen(API_PATH);
}