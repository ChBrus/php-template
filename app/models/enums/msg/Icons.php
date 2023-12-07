<?php
    namespace Enums\Msg;

    enum Icons {
        case Danger;
        case Success;
        case Config;

        public function print() {
            return match($this) {
                self::Danger => '<i class="bi bi-exclamation-circle-fill"></i>',
                self::Success => '<i class="bi bi-check-circle-fill"></i>',
                self::Config => '<i class="bi bi-gear-fill"></i>',
            };
        }
    }
?>