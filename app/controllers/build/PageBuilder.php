<?php
    namespace Build;

    /**
     * Una clase para construir distintos componentes o assets en las páginas
     */
    class PageBuilder {
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
        public static function buildScript(string $scriptName, bool $isModule = false) {
            ob_start();
            ?>
                <script <?= $isModule ? 'type="module"' : '' ?> src="<?= self::getProjectURL() . 'app/assets/js/' . $scriptName ?>.js"></script>
            <?php
            return ob_get_clean();
        }

        /**
         * Construye el bootstrap personalizado por el desarrollador
         *
         * @return string
         */
        public static function buildCustomBootstrap() {
            ob_start();
            ?>
                <link rel="stylesheet" href="<?= self::getProjectURL() ?>app/assets/css/bootstrap.css">
                <link rel="stylesheet" href="<?= self::getProjectURL() ?>vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
                <script src="<?= self::getProjectURL() ?>vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <?php
            return ob_get_clean();
        }


        /**
         * Imprime en la página cualquier componente dado y le enviamos datos por medio de un método POST
         *
         * @param string $file
         * El archivo o componente al que vamos a imprimir en la página
         * @param array $data
         * Los datos que se le van a enviar
         * @return string
         */
        public static function view($file, $data = []) {
            // La página a la que quiero enviar datos via POST
            $url = self::getAbsoluteProjectURL() . 'app/views/' . $file . '.php';

            // url-ify los datos para POST
            $fields_string = http_build_query($data);

            // Abrir conección
            $ch = curl_init();

            // Poner la URL, cantidad de variables en el POST y datos del POST
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

            // Entonces curl_exec devuelve el contenido de cURL; en lugar de repetirlo
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

            // Ejecuta POST
            $result = curl_exec($ch);

            return $result;
        }

        /**
         * Obtiene la URL en el que se corre el proyecto
         *
         * @return string
         */
        public static function getProjectURL() {
            $projectURL = '/' . $_ENV['ProjectName'] . '/';
            return $projectURL;
        }

        /**
         * Obtiene la URL absoluta en el que se corre el proyecto
         *
         * @return string
         */
        public static function getAbsoluteProjectURL() {
            return $_SERVER['HTTP_HOST'] . self::getProjectURL();
        }
    }
?>