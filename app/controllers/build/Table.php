<?php
    namespace Build;

    use Core\Abstracts\BaseAbstract;

    class Table extends BaseAbstract {
        public int $columns;
        protected string $dataFile;
        public bool $stripped;
        public bool $options;

        /**
         * Inicializa el constructor de tablas
         *
         * @param int $columns
         * @param string $dataFile
         * @param boolean $stripped
         * @param boolean $options
         */
        public function __construct(
            $columns,
            $dataFile = '',
            $stripped = false,
            $options = false
        ) {
            $this->columns = $columns;
            $this->dataFile = empty($dataFile) ? '' : bridgeConnection($dataFile);
            $this->stripped = $stripped;
            $this->options = $options;
        }

        public function build() {
            return view('data-table/table', $this->__toArray());
        }

        public function __toArray() {
            return [
                'columns' => $this->columns,
                'dataFile' => $this->dataFile,
                'maxRows' => $this->maxRows,
                'stripped' => $this->stripped,
                'options' => $this->options
            ];
        }
    }