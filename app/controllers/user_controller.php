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
                    echo json_encode(["status"=> "success", "message"=> "¡Te has registrado correctamente!"]);
                    return;
                } else {
                    echo json_encode(["status"=> "warning", "message"=> "No se ha podido crear el usuario."]);
                    return;
                }
            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Ocurrió un error al crear el usuario: " . $e]);
                return;
            }
        }


        public function get_all_users_active() {
            try {
                $res = $this -> Model -> get_all_actives();
                $data = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                echo json_encode(["status"=> "success", "message"=> "Consulta realizada", "content"=> $data]);
                return;
            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Ocurrió un error al obtener los usuarios: " . $e->getMessage()]);
                return;
            }
        }


        public function get_all_users_clan_roles() {
            try {
                $res = $this -> Model -> get_all_clan_role();
                $data = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();
                
                echo json_encode(["status"=> "success", "message"=> "Consulta realizada", "content"=> $data]);
                return;
            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Ocurrió un error al obtener los roles de clan." . $e->getMessage()]);
                return;
            }
        }
    

        public function get_user_by_id() {
            try {
                $id = $_GET["id"] ?? null;
                if (empty($id)) {
                    echo json_encode(["status"=> "error", "message"=> "No se proporcionó un ID de usuario."]);
                    return;
                }

                $res = $this -> Model -> get_by_id($id);
                $user = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                echo json_encode(["status"=> "success", "message"=> "Consulta realizada", "content"=> $user]);
                return;
            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Ocurrió un error al obtener el usuario." . $e->getMessage()]);
                return;
            }
        }


        public function get_user_clan_role_by_id() {
            try {
                $id = $_GET["id"] ?? null;
                if (empty($id)) {
                    echo json_encode(["status"=> "error", "message"=> "No se proporcionó un ID de usuario."]);
                    return;
                }

                $res = $this -> Model -> get_clan_role_by_id($id);
                $data = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                echo json_encode(["status"=> "success", "message"=> "Consulta realizada", "content"=> $data]);
                return;
            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Ocurrió un error al obtener el rol del usuario." . $e->getMessage()]);
                return;
            }
        }


        public function get_user_by_username() {
            try {
                $username = $_GET["username"] ?? null;
                if (empty($username)) {
                    echo json_encode(["status"=> "error", "message"=> "No se proporcionó un nombre de usuario."]);
                    return;
                }

                $res = $this -> Model -> get_by_username($username);
                $user = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                echo json_encode(["status"=> "success", "message"=> "Consulta realizada", "content"=> $user]);
                return;
            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Ocurrió un error al buscar el usuario." . $e->getMessage()]);
                return;
            }
        }


        public function get_user_by_email() {
            try {
                $email = $_GET["email"] ?? null;
                if (empty($email)) {
                    echo json_encode(["status"=> "error", "message"=> "No se proporcionó un email."]);
                    return;
                }

                $res = $this -> Model -> get_by_email($email);
                $user = $res -> fetch_all(MYSQLI_ASSOC);
                $res -> free();

                echo json_encode(["status"=> "success", "message"=> "Consulta realizada", "content"=> $user]);
                return;
            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Ocurrió un error al buscar el email." . $e->getMessage()]);
                return;
            }
        }


        public function update_user_username() {
            try {
                $id = $_POST["id"] ?? null;
                $username = $_POST["username"] ?? null;

                if (empty($id) || empty($username)) {
                    echo json_encode(["status"=> "error", "message"=> "ID y nuevo username son requeridos."]);
                    return;
                }

                $this -> Model -> update_username($id, $username);
                echo json_encode(["status"=> "success", "message"=> "Username actualizado con éxito."]);
                return;

            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Error al actualizar el username. Es posible que ya esté en uso." . $e->getMessage()]);
                return;
            }
        }


        public function update_user_playername() {
            try {
                $id = $_POST["id"] ?? null;
                $playername = $_POST["playername"] ?? null;

                if (empty($id) || empty($playername)) {
                    echo json_encode(["status"=> "error", "message"=> "ID y nuevo playername son requeridos."]);
                    return;
                }

                $this -> Model -> update_playername($id, $playername);
                echo json_encode(["status"=> "success", "message"=> "Playername actualizado con éxito."]);
                return;

            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Error al actualizar el playername." . $e->getMessage()]);
                return;
            }
        }


        public function update_user_password() {
            try {
                $id = $_POST["id"] ?? null;
                $pass = $_POST["pass"] ?? null;

                if (empty($id) || empty($pass)) {
                    echo json_encode(["status"=> "error", "message"=> "ID y nueva contraseña son requeridos."]);
                    return;
                }
                // ENCRIPTAR CONTRASEÑA
                $this -> Model -> update_password($id, $pass);
                
                echo json_encode(["status"=> "success", "message"=> "Contraseña actualizada con éxito."]);
                return;

            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Error al actualizar la contraseña." . $e->getMessage()]);
                return;
            }
        }


        public function delete_user() {
            try {
                $id = $_GET["id"] ?? null;
                if (empty($id)) {
                    echo json_encode(["status"=> "error", "message"=> "ID de usuario requerido."]);
                    return;
                }

                $this -> Model -> delete($id);
                echo json_encode(["status"=> "success", "message"=> "Usuario desactivado con éxito."]);
                return;

            } catch (Exception $e) {
                echo json_encode(["status"=> "error", "message"=> "Error al desactivar el usuario." . $e->getMessage()]);
                return;
            }
        }

        
        public function login_user() {
            try {
                $username = $_POST["username"] ?? null;
                $pass = $_POST["user_pass"] ?? null;

                if (empty($username) || empty($pass)) {
                    echo json_encode(["status" => "error", "message" => "No se proporcionó usuario y contraseña."]);
                    return;
                }

                $user_data = $this -> Model -> get_by_username($username) -> fetch_all(MYSQLI_ASSOC)[0];
                if (empty($user_data)) {
                    echo json_encode(["status" => "error", "message" => "Credenciales inválidas."]);
                    return;
                }

                if ($pass === $user_data["pass"]) {
                    echo json_encode(["status" => "success", "message" => "¡Te has logeado correctamente. Bienvenido " . $user_data["username"]. "!", "user_id" => $user_data["id_user"]]);
                    return;
                } else {
                    echo json_encode(["status" => "error", "message" => "Credenciales inválidas."]);
                    return;
                }

            } catch (\Exception $e) {
                echo "4Acá amigo";
                return ["status" => "error", "message" => "Error al confirmar credenciales."];
            }
        }
    }

?>