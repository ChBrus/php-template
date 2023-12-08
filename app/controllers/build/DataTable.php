<?php
    namespace Build;

    class DataTable {
        protected array $tablesHeader;
        protected array $tablesData;
        private bool $stripedTable;
        private int $maxRowsShow;

        /**
         * Método constructor para crear vistas de tablas
         * 
         * @param array $tablesData
         * Los datos obtenidos en una petición de SQL
         * @param array $tablesHeader
         * Los títulos de cada columna que habrá
         */
        public function __construct($tablesData, $tablesHeader = []) {
            $this->tablesData = $tablesData;
            $this->tablesHeader = $tablesHeader;

            if (count($tablesHeader) === 0) {
                for ($i = 0; $i < count($tablesData[0]); $i++) {
                    array_push($tablesHeader, '[Undefined]');
                }

                $this->tablesHeader = $tablesHeader;
            }
        }
    }
?>