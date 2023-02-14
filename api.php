<?php
require_once "model.php";
require_once "controller.php";

$controller = new TeamController();

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "getTeams":
            $result = $controller->getTeams();
            break;
        case "getTeam":
            if (isset($_GET["user_id"])) {
                $result = $controller->getTeam($_GET["user_id"]);
            } else {
                $result = array("error" => "user_id is required");
            }
            break;
        case "createTeam":
            if (isset($_POST["username"]) && isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["client_name"]) && isset($_POST["hours"]) && isset($_POST["tracker"]) && isset($_POST["tracker_owner"])) {
                $result = $controller->createTeam($_POST["username"], $_POST["first_name"], $_POST["last_name"], $_POST["client_name"], $_POST["hours"], $_POST["tracker"], $_POST["tracker_owner"]);
            } else {
                $result = array("error" => "username, first_name, last_name, client_name, hours, tracker, and tracker_owner are required");
            }
            break;
        case "updateTeam":
            if (isset($_POST["user_id"]) && isset($_POST["username"]) && isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["client_name"]) && isset($_POST["hours"]) && isset($_POST["tracker"])   && isset($_POST["tracker_owner"])) {
                $result = $controller->updateTeam($_POST["user_id"], $_POST["username"], $_POST["first_name"], $_POST["last_name"], $_POST["client_name"], $_POST["hours"], $_POST["tracker"], $_POST["tracker_owner"]);
            } else {
                $result = array("error" => "user_id, username, first_name, last_name, client_name, hours, tracker, and tracker_owner are required");
            }
            break;
        case "deleteTeam":
            if (isset($_GET["user_id"])) {
                $result = $controller->deleteTeam($_GET["user_id"]);
            } else {
                $result = array("error" => "user_id is required");
            }
            break;
        default:
            $result = array("error" => "Invalid action");
    }
} else {
    $result = array("error" => "action is required");
}

header("Content-Type: application/json");
echo json_encode($result);
