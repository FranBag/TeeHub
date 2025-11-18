<?php 
    require_once __DIR__ . "/../models/user_model.php";

    class UserController {
        private $Model;

        public function __construct() {
            $this -> Model = new UserModel();
        }


        public function create_user() {
            try {
                $email = $_POST["user_email"];
                $username = $_POST["username"];
                $pass = $_POST["user_pass"];
                $playername = $_POST["playername"];

                $res = $this -> Model -> create($email, $username, $pass, $playername);

                if ($res == 1) {
                    return json_encode(["status"=> "sucess", "message"=> "Usuario creado con éxito"]);
                } else {
                    return json_encode(["status"=> "warning", "message"=> "No se ha podido crear el usuario."]);
                }
            } catch (Exception $e) {
                return ["status"=> "error", "message"=> "Ocurrió un error al crear el usuario: " . $e ->getMessage()];
            }
        }


        public function get_all_users_active() {
            try {
                $res = $this -> Model -> get_all_actives();
                $data = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                return json_encode(["status"=> "sucess", "message"=> "Consulta realizada", "content"=> $data]);
            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Ocurrió un error al obtener los usuarios: " . $e->getMessage()]);
            }
        }


        public function get_all_users_clan_roles() {
            try {
                $res = $this -> Model -> get_all_clan_role();
                $data = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();
                
                return json_encode(["status"=> "sucess", "message"=> "Consulta realizada", "content"=> $data]);
            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Ocurrió un error al obtener los roles de clan." . $e->getMessage()]);
            }
        }
    

        public function get_user_by_id() {
            try {
                $id = $_GET['id'] ?? null;
                if (empty($id)) {
                    return json_encode(["status"=> "error", "message"=> "No se proporcionó un ID de usuario."]);
                }

                $res = $this -> Model -> get_by_id($id);
                $user = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                return $user;
            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Ocurrió un error al obtener el usuario." . $e->getMessage()]);
            }
        }


        public function get_user_clan_role_by_id() {
            try {
                $id = $_GET['id'] ?? null;
                if (empty($id)) {
                    return json_encode(["status"=> "error", "message"=> "No se proporcionó un ID de usuario."]);
                }

                $res = $this -> Model -> get_clan_role_by_id($id);
                $data = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                return $data;
            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Ocurrió un error al obtener el rol del usuario." . $e->getMessage()]);
            }
        }


        public function get_user_by_username() {
            try {
                $username = $_GET['username'] ?? null;
                if (empty($username)) {
                    return json_encode(["status"=> "error", "message"=> "No se proporcionó un nombre de usuario."]);
                }

                $res = $this -> Model -> get_by_username($username);
                $user = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                return $user;
            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Ocurrió un error al buscar el usuario." . $e->getMessage()]);
            }
        }


        public function get_user_by_email() {
            try {
                $email = $_GET['email'] ?? null;
                if (empty($email)) {
                    return json_encode(["status"=> "error", "message"=> "No se proporcionó un email."]);
                }

                $res = $this -> Model -> get_by_email($email);
                $user = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                return $user;
            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Ocurrió un error al buscar el email." . $e->getMessage()]);
            }
        }


        public function update_user_username() {
            try {
                $id = $_POST['id'] ?? null;
                $username = $_POST['username'] ?? null;

                if (empty($id) || empty($username)) {
                    return json_encode(["status"=> "error", "message"=> "ID y nuevo username son requeridos."]);
                }

                $this -> Model -> update_username($id, $username);
                return json_encode(["status"=> "success", "message"=> "Username actualizado con éxito."]);

            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Error al actualizar el username. Es posible que ya esté en uso." . $e->getMessage()]);
            }
        }


        public function update_user_playername() {
            try {
                $id = $_POST['id'] ?? null;
                $playername = $_POST['playername'] ?? null;

                if (empty($id) || empty($playername)) {
                    return json_encode(["status"=> "error", "message"=> "ID y nuevo playername son requeridos."]);
                }

                $this -> Model -> update_playername($id, $playername);
                return json_encode(["status"=> "success", "message"=> "Playername actualizado con éxito."]);

            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Error al actualizar el playername." . $e->getMessage()]);
            }
        }


        public function update_user_password() {
            try {
                $id = $_POST['id'] ?? null;
                $pass = $_POST['pass'] ?? null;

                if (empty($id) || empty($pass)) {
                    return json_encode(["status"=> "error", "message"=> "ID y nueva contraseña son requeridos."]);
                }
                // ENCRIPTAR CONTRASEÑA
                $this -> Model -> update_password($id, $pass);
                
                return json_encode(["status"=> "success", "message"=> "Contraseña actualizada con éxito."]);

            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Error al actualizar la contraseña." . $e->getMessage()]);
            }
        }


        public function delete_user() {
            try {
                $id = $_GET['id'] ?? null;
                if (empty($id)) {
                    return json_encode(["status"=> "error", "message"=> "ID de usuario requerido."]);
                }

                $this -> Model -> delete($id);
                return json_encode(["status"=> "success", "message"=> "Usuario desactivado con éxito."]);

            } catch (Exception $e) {
                return json_encode(["status"=> "error", "message"=> "Error al desactivar el usuario." . $e->getMessage()]);
            }
        }
    }
?>