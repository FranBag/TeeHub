<?php
    require_once __DIR__ . "/../controllers/user_controller.php";

    $controller = new UserController();
    
    $request_method = $_SERVER["REQUEST_METHOD"];

    if($request_method === "GET") {
        $action = $_GET["action"] ?? "";

        switch ($action) {
            case "active":
                $controller -> get_all_users_active();
                break;
            case "clan_roles":
                $controller -> get_all_users_clan_roles();
                break;
            case "by_id":
                $controller -> get_user_by_id();
                break;
            case "clan_role_by_id":
                $controller -> get_user_clan_role_by_id();
                break;
            case "by_username":
                $controller -> get_user_by_username();
                break;
            case "by_email":
                $controller -> get_user_by_email();
                break;
            default:
                echo json_encode(["status"=>"error", "message"=>"Acción inválida" . $action]);
                break;
        }
        
    } elseif ($request_method === "POST") {
        $action = $_GET["action"] ?? "";
        switch ($action) {
            case "create":
                $controller -> create_user();
                break;
            case "login":
                $controller -> login_user();
                break;
            default:
                echo json_encode(["status"=>"error", "message"=>"Acción inválida" . $action]);
                break;
        }
    } else {
        echo json_encode(["status"=>"error", "message"=>"Método HTTP invalido"]);
    }
?>