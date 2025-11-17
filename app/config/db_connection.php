<?php 
    class Database {
        private $connection;

        public function __construct() {
            try {
                $this -> connection = mysqli_connect("localhost", "backend", "backend_teehub", "teehub");
                $this -> connection -> set_charset("utf8");
            } catch (Exception $e) {
                die("Error al conectase a la base de datos: ".$e->getMessage());
            }
        }

        public function get_db_connection() {
            return $this -> connection;
        }
        public function db__disconnect() {
            mysqli_close($this -> connection);
        }
    }
?>