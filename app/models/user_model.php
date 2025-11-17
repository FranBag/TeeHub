<?php 
    require_once __DIR__ . "/../config/db_connection.php";

    class UserModel {
        private $database;
        private $connection;

        public function __construct() {
            $this -> database = new Database();
            $this -> connection = $this -> database -> get_db_connection();
        }


        public function create($email, $username, $pass, $playername = null) {
            $query = "INSERT INTO User (email, username, pass, playername) VALUES (?, ?, ?, ?)";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("ssss", $email, $username, $pass, $playername);
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
            $result = mysqli_query($this -> connection, "SELECT id_user, username, playername, email, created_at FROM `User` WHERE deleted_at IS NULL");

            if ($result === false) {
                throw new Exception("Error al ejecutar la consulta." . $this->connection->error);
            }

            return $result;
        }


        public function get_all_clan_role() {
            $result = mysqli_query($this -> connection, "SELECT username, user_role, clan_name FROM UserClanRoleView");

            if ($result === false) {
                throw new Exception("Error al ejecutar la consulta." . $this->connection->error);
            }

            return $result;
        }


        public function get_by_id($id) {
            $query = "SELECT id_user, username, playername, email, created_at FROM  `User` WHERE id_user = ?";
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

            $result = $prepared_sql->get_result();
            $prepared_sql->close();

            return $result;
        }


        public function get_clan_role_by_id($id) {
            $query = "SELECT username, user_role, clan_name FROM UserClanRoleView WHERE id_user = ?";
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

            $result = $prepared_sql->get_result();
            $prepared_sql->close();

            return $result;
        }        


        public function get_by_username($username) {
            $query = "SELECT id_user, username, playername, email, created_at FROM  `User` WHERE username = ?";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("s", $username);
            $prepared_sql->execute();

            if ($prepared_sql->error){
                $prepared_sql->close();
                throw New Exception("Error al ejectutar la consulta." . $prepared_sql -> error);
            }

            $result = $prepared_sql->get_result();
            $prepared_sql->close();

            return $result;
        }


        public function get_by_email($email) {
            $query = "SELECT id_user, username, playername, email, created_at FROM  `User` WHERE email = ?";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("s", $email);
            $prepared_sql->execute();

            if ($prepared_sql->error){
                $prepared_sql->close();
                throw New Exception("Error al ejectutar la consulta." . $prepared_sql -> error);
            }

            $result = $prepared_sql->get_result();
            $prepared_sql->close();
            
            return $result;
        }
 

        public function update_username($id, $username) {
            $query = "UPDATE `User` SET username = ? WHERE id_user = ?";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("si", $username, $id);
            $prepared_sql->execute();

            if ($prepared_sql->error){
                $prepared_sql->close();
                throw New Exception("Error al ejectutar la consulta." . $prepared_sql -> error);
            }

            $affected_rows = $prepared_sql -> affected_rows;

            $prepared_sql->close();

            return $affected_rows;
        }
        

        public function update_playername($id, $playername) {
            $query = "UPDATE `User` SET playername = ? WHERE id_user = ?";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("si", $playername, $id);
            $prepared_sql->execute();

            if ($prepared_sql->error){
                $prepared_sql->close();
                throw New Exception("Error al ejectutar la consulta." . $prepared_sql -> error);
            }

            $affected_rows = $prepared_sql -> affected_rows;

            $prepared_sql->close();

            return $affected_rows;
        }


        public function update_password($id, $pass) {
            $query = "UPDATE `User` SET pass = ? WHERE id_user = ?";
            $prepared_sql = $this -> connection -> prepare($query);

            if ($prepared_sql === false) {
                throw New Exception("Error al preparar la consulta." . $this->connection->error);
            }

            $prepared_sql->bind_param("si", $pass, $id);
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
            $query = "UPDATE `User` SET deleted_at = current_timestamp WHERE id_user = ?";
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
