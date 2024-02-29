<?php
    namespace Build\Message;

    use Build\Message\{Properties, Type};
    use Build\{PageBuilder, Icons};

    class Message {
        protected string $msg;
        protected string $header;
        private bool $icon;
        private string $location;
        private bool $buildStyles;
        private bool $buildScripts;

        /**
         * Message es una clase para crear alertas con mensajes personalizados
         *
         * @param string $msg
         * El mensaje a mostrar en la alerta
         * @param string $header
         * El título que vendrá en el mensaje
         */
        public function __construct($msg, $header = "") {
            $this->msg = $msg;
            $this->header = $header;
            $this->icon = true;
            $this->location = PageBuilder::getProjectURL();
            $this->buildStyles = false;
            $this->buildScripts = false;
        }

        /**
         * Muestra un mensaje de error con estilos de Bootstrap
         *
         * @param Icons $icon
         * @return string
         */
        public function dangerMsg(Icons $icon = Icons::Danger) {
            return $this->msg(Type::Danger, $icon);
        }

        /**
         * Muestra un mensaje de éxito con estilos de Bootstrap
         *
         * @param Icons $icon
         * @return string
         */
        public function successMsg(Icons $icon = Icons::Success) {
            return $this->msg(Type::Success, $icon);
        }

        /**
         * Una función para imprimir un mensaje, sea de peligro o de éxito en alguna acción
         *
         * @param Type $type
         * @param Icons $icon
         * @return string
         */
        private function msg(Type $type, Icons $icon) {
            $data = [
                'msg' => $this->msg
            ];

            if (strlen($this->header) !== 0) {
                $data['header'] = $this->header;
            } if ($this->icon) {
                $data['icon'] = $icon->print();
                $data['location'] = $this->location;
            } if (strlen($this->location) === 0) {
                $data['location'] = 'null';
            } if ($this->buildStyles) {
                $data['head'] = PageBuilder::buildCustomBootstrap();
            } if ($this->buildScripts) {
                $data['script'] = script('php-template/message/index', true);
            }

            return match($type) {
                Type::Danger => view('message/danger-msg', $data),
                Type::Success => view('message/success-msg', $data)
            };
        }

        /**
         * Pone un valor a una propiedad de la clase
         *
         * @param Properties | string $propertyName
         * @param mixed $value
         * @return void
         */
        public function setAttribute(Properties | string $propertyName, $value) {
            $name = $propertyName;

            if ($propertyName instanceof Properties) $name = $propertyName->getValue();

            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }