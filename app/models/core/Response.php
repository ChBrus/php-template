<?php
    namespace Core;

    use Build\Message\{Message, Properties};
use Build\PageBuilder;
use Core\Abstracts\BaseAbstract;
    use PDOStatement;
    use Doctrine\DBAL\Result;

    class Response extends BaseAbstract {
        public int $status;
        public string | PDOStatement | Result | bool | array $response;
        public array | null $content;
        public string | bool | null $alert;

        /**
         * Construye el objeto Response
         *
         * @param int $status
         * @param string | PDOStatement | Result | bool | array $response
         */
        public function __construct($status = 200, $response = true) {
            $this->status = $status >= 400 && $status < 600 ? $status : ($status < 400 ? $status : 500);
            $this->status = $this->status === 0 ? 500 : $this->status;
            $this->response = $response;
            $this->alert = null;
            $this->content = null;
        }

        /**
         * Crea una alerta para el uso de las APIs
         *
         * @param string $msg
         * @param string $header
         * @return void
         */
        public function setAlert($msg, $header = '[SERVIDOR]: ') {
            $message = new Message($msg, $header);

            if ($this->status === 199) $message->setAttribute(Properties::icon, false);
            $this->alert = match(true) {
                $this->status < 400 => $message->successMsg(),
                $this->status >= 400 => $message->dangerMsg()
            };
        }

        /**
         * Le da contenido al resultado de la API
         *
         * @param string | null $type
         * @param int $page
         * @param string $api_file
         * @return void
         */
        public function setContent(
            $type = null,
            $page = 0,
            $api_file = ''
        ) {
            $this->content = [
                'type' => $type,
                'page' => $page,
                'url' => PageBuilder::getAbsoluteProjectURL() . "api/{$api_file}?type={$type}&page={$page}"
            ];
        }

        public function __toString() {
            $array = [
                'status' => $this->status,
                'response' => $this->response,
                'message' => $this->alert,
                'content' => $this->content
            ];

            if ($array['content'] === null) array_pop($array);
            if ($array['message'] === null) array_pop($array);

            return json_encode($array);
        }
    }