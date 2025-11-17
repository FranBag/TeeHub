<?php 
    require_once __DIR__ . "/../config/db_connection.php";

    class ClanModel {
        private $database;
        private $connection;

        public function __construct() {
            $this -> database = new Database();
            $this -> connection = $this -> database -> get_db_connection();
        }


        public function create($name, $logo = null) {
            $query = "INSERT INTO Clan (name, logo) VALUES (?, ?)";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("sb", $name, $logo);
            $prepared_sql->execute();

            if ($prepared_sql->error){
                $prepared_sql->close();
                throw New Exception("Error al ejectutar la consulta." . $prepared_sql -> error);
            }
            
            $affected_rows = $prepared_sql -> affected_rows;

            $prepared_sql->close();

            return $affected_rows;
        }


        public function get_all_actives() {
            $result = mysqli_query($this -> connection, "SELECT id_clan, name, created_at, logo FROM Clan WHERE deleted_at IS NULL");

            if ($result === false) {
                throw new Exception("Error al ejecutar la consulta." . $this->connection->error);
            }

            return $result;
        }


        public function get_by_name($clan_name) {
            $query = "SELECT id_clan, name, created_at, logo FROM Clan WHERE name = ?";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("s", $clan_name);
            $prepared_sql->execute();

            if ($prepared_sql->error){
                $prepared_sql->close();
                throw New Exception("Error al ejectutar la consulta." . $prepared_sql -> error);
            }

            $result = $prepared_sql->get_result();
            $prepared_sql->close();

            return $result;
        }
 

        public function updateName($id, $clan_name) {
            $query = "UPDATE Clan SET `name` = ? WHERE id_clan = ?";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("si", $clan_name, $id);
            $prepared_sql->execute();

            if ($prepared_sql->error){
                $prepared_sql->close();
                throw New Exception("Error al ejectutar la consulta." . $prepared_sql -> error);
            }

            $affected_rows = $prepared_sql -> affected_rows;

            $prepared_sql->close();

            return $affected_rows;
        }
        

        public function updateLogo($id, $logo) {
            $query = "UPDATE Clan SET logo = ? WHERE iod_clan = ?";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("bi", $logo, $id);
            $prepared_sql->execute();

            if ($prepared_sql->error){
                $prepared_sql->close();
                throw New Exception("Error al ejectutar la consulta." . $prepared_sql -> error);
            }

            $affected_rows = $prepared_sql -> affected_rows;

            $prepared_sql->close();

            return $affected_rows;
        }


        public function delete($id) {
            $query = "UPDATE Clan SET deleted_at = current_timestamp WHERE id_clan = ?";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("i", $id);
            $prepared_sql->execute();

            if ($prepared_sql->error){
                $prepared_sql->close();
                throw New Exception("Error al ejectutar la consulta." . $prepared_sql -> error);
            }

            $affected_rows = $prepared_sql -> affected_rows;

            $prepared_sql->close();

            return $affected_rows;
        }
    }
?>
