<?php
    namespace Build\Message;

    use Build\Message\{Properties, Type};
    use Build\{PageBuilder, Icons};

    class Message {
        protected string $msg;
        protected string $header;
        protected string $btn_description;
        private bool $is_btn, $is_icon, $buildStyles, $buildScripts;
        private string $location;

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
            $this->location = PageBuilder::getProjectURL();
            $this->is_btn = true;
            $this->is_icon = true;
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

        public function customizeMsg(Icons $icon = Icons::Config, $color) {
            return $this->msg(Type::Customize, $icon, $color);
        }

        /**
         * Una función para imprimir un mensaje, sea de peligro o de éxito en alguna acción
         *
         * @param Type $type
         * @param Icons $icon
         * @return string
         */
        private function msg(Type $type, Icons $icon, $color = '') {
            $data = [
                'msg' => $this->msg
            ];

            $data = array_merge($data, match(true) {
                strlen($this->header) !== 0 => [
                    ['header'] => $this->header
                ],
                $this->is_btn => [
                    ['is_btn'] => true
                ],
                $this->is_btn && $this->is_icon => [
                    ['icon'] => $icon->print(),
                    ['location'] => $this->location
                ],
                $this->is_btn && strlen($this->location) === 0 => [
                    ['location'] => null
                ],
                $this->is_btn && !empty($this->btn_description) => [
                    ['btn_description'] => $this->btn_description
                ],
                $this->buildStyles => [
                    ['head'] => PageBuilder::buildCustomBootstrap()
                ],
                $this->buildScripts => [
                    ['script'] => script('php-template/message/index', true)
                ],
                $type === Type::Customize => [
                    ['color'] => $color
                ],
                default => []
            });

            if (strlen($this->header) !== 0) $data = array_merge($data, [
                ['header'] => $this->header
            ]);
            if ($this->is_btn) $data = array_merge($data, [
                ['is_btn'] => true
            ]);
            if ($this->is_btn && $this->is_icon) $data = array_merge($data, [
                ['icon'] => $icon->print(),
                ['location'] => $this->location
            ]);
            if ($this->is_btn && strlen($this->location) === 0) $data = array_merge($data, [
                ['location'] => null
            ]);
            if ($this->is_btn && !empty($this->btn_description)) $data = array_merge($data, [
                ['btn_description'] => $this->btn_description
            ]);
            if ($this->buildStyles) $data = array_merge($data, [
                ['head'] => PageBuilder::buildCustomBootstrap()
            ]);
            if ($this->buildScripts) $data = array_merge($data, [
                ['script'] => script('php-template/message/index', true)
            ]);
            if ($type === Type::Customize) $data = array_merge($data, [
                ['color'] => $color
            ]);

            return match($type) {
                Type::Danger => view('message/danger-msg', $data),
                Type::Success => view('message/success-msg', $data),
                Type::Customize => view('message/customize-msg', $data)
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