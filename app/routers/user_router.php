<?php
    require_once __DIR__ . "/../controllers/user_controller.php";

    $controller = new UserController();
    
    $request_method = $_SERVER["REQUEST_METHOD"];

    if($request_method === "GET" ) {
        $action = $_GET["action"] ?? "";

        switch ($action) {
            case "active":
                $controller -> get_all_users_active();
                break;
            case "clan_roles":
                $controller -> get_all_users_clan_roles();
                break;
            default:
                echo json_encode(["status"=>"error", "message"=>"Acción inválida" . $action]);
                break;
        }
    }

    // echo json_encode($request_method);
?>