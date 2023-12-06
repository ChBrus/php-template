<?php
    namespace Enums\Msg;

    enum Icons {
        case Danger;
        case Success;

        public function print() {
            return match($this) {
                Icons::Danger => 'bi bi-exclamation-circle-fill',
                Icons::Success => 'bi bi-check-circle-fill'
            };
        }
    }
?>