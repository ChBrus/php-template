<?php
    namespace Build;

    use Enums\Bootstrap\Icons;

    class Message {
        protected string $msg;
        protected string $header;
        public bool $icon;

        /**
         * Message es una clase para crear alertas con mensajes personalizados
         *
         * @param string $msg
         * @param string $header
         */
        public function __construct($msg, $header = "") {
            $this->msg = $msg;
            $this->header = $header;
            $this->icon = false;
        }

        /**
         * Muestra un mensaje de error con estilos de Bootstrap
         *
         * @param Icons $icon
         * @return string
         */
        public function dangerMsg(Icons $icon = Icons::Danger) {
            $data = [
                'msg' => $this->msg
            ];

            if (strlen($this->header) !== 0) {
                $data['header'] = $this->header;
            } if ($this->icon) {
                $data['icon'] = $icon->print();
            }

            return view(
                'message/danger-msg',
                $data
            );
        }

        /**
         * Pone un valor a una propiedad de la clase
         *
         * @param string $name
         * @param mixed $value
         * @return void
         */
        public function setAttribute(string $name, $value) {
            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }
?>