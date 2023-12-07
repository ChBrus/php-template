<?php
    namespace Build;

    use Enums\Msg\{Icons, Type};
    use Build\PageBuilder;

    class Message {
        protected string $msg;
        protected string $header;
        private bool $icon;
        private string $location;

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
            $this->location = PageBuilder::getProjectURL();
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

        private function msg(Type $type, Icons $icon) {
            $data = [
                'msg' => $this->msg,
                'location' => $this->location
            ];

            if (strlen($this->header) !== 0) {
                $data['header'] = $this->header;
            } if ($this->icon) {
                $data['icon'] = $icon->print();
            }

            return match($type) {
                Type::Danger => view('message/danger-msg', $data),
                Type::Success => view('message/success-msg', $data)
            };
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