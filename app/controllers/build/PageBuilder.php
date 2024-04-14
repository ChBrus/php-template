<?php
    namespace Build;

    use Tools\Env;

    /**
     * Una clase para construir distintos componentes o assets en las páginas
     */
    class PageBuilder {
        /**
         * Construye la etiqueta <script> para incluir un script en la página.
         *
         * @param string $scriptName
         * El nombre del script, incluyendo la subcarpeta.
         * @param boolean $isModule
         * Un booleano para verificar si es un script de módulo.
         * @return string
         */
        public static function buildScript(string $scriptName, bool $isModule = false) {
            ob_start();
            ?>
                <script <?= $isModule ? 'type="module"' : '' ?> src="<?= self::getProjectURL() . 'app/assets/js/' . $scriptName ?>.js"></script>
            <?php
            return ob_get_clean();
        }

        /**
         * Construye las etiquetas <link> y <script> para incluir Bootstrap personalizado.
         *
         * @return string
         */
        public static function buildCustomBootstrap() {
            ob_start();
            ?>
                <link rel="shortcut icon" href="<?= self::getFavicon() ?>" type="image/png" sizes="32x32">
                <link rel="shortcut icon" href="<?= self::getFavicon() ?>" type="image/png" sizes="64x64">
                <link rel="stylesheet" href="<?= self::getProjectURL() ?>app/assets/css/bootstrap.css">
                <link rel="stylesheet" href="<?= self::getProjectURL() ?>vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
                <script src="<?= self::getProjectURL() ?>vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <?php
            return ob_get_clean();
        }

        /**
         * Construye la etiqueta <img> para mostrar una imagen en la página.
         *
         * @param string $location
         * La ubicación de la imagen.
         * @param string $class
         * La clase que tendrá la imagen.
         * @param string $alt
         * El texto alternativo de la imagen.
         * @param string $width
         * El ancho de la imagen en formato CSS.
         * @param string $height
         * El alto de la imagen en formato CSS.
         * @return string
         */
        public static function builImage($location, $class = "img-built", $alt = 'img-built', $width = '100px', $height = '100px') {
            ob_start();
            ?>
                <img class="<?= $class ?>" src="<?= self::getProjectURL() . 'app/assets/img/' . $location ?>" alt="<?= $alt ?>" width="<?= $width ?>" height="<?= $height ?>">
            <?php
            return ob_get_clean();
        }

        /**
         * Construye la etiqueta <script> para incluir jQuery desde la CDN.
         *
         * @return mixed
         */
        public static function buildJQuery() {
            ob_start();
            ?>
                <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
            <?php
            return ob_get_clean();
        }

        /**
         * Imprime en la página un componente y envía datos mediante un método POST.
         *
         * @param string $file
         * El archivo o componente que se imprimirá en la página.
         * @param array $data
         * Los datos que se enviarán.
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
         * Obtiene la URL en la que se ejecuta el proyecto.
         *
         * @return string
         */
        public static function getProjectURL() {
            $projectURL = '/' . $_ENV['ProjectName'] . '/';

            if (empty($_ENV['ProjectName']) || boolval($_ENV['ProjectRoot'])) {
                $projectURL = '/';
            }

            return $projectURL;
        }

        /**
         * Obtiene la URL absoluta en la que se ejecuta el proyecto.
         *
         * @return string
         */
        public static function getAbsoluteProjectURL() {
            return $_SERVER['HTTP_HOST'] . self::getProjectURL();
        }

        private static function getFavicon() {
            $urlBase = str_replace('\\', '/', Env::getEnvFile());
            $url = substr($urlBase, 0, strpos($urlBase, '/controllers/'));
            $url .= self::getProjectURL();
            $url .= 'assets/img/';
            $url = str_replace('/', '\\', $url);
            $files = scandir($url);

            foreach ($files as $file) {
                if (strpos($file, 'favicon.ico') !== false) {
                    return self::getProjectURL() . 'app/assets/img/' . $file;
                }
            }
        }
    }
?>