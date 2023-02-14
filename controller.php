<?php
class TeamController {
    private $model;
    
    public function __construct() {
        $this->model = new TeamModel();
    }

    public function getTeams() {
        return $this->model->getTeams();
    }

    public function getTeam($user_id) {
        return $this->model->getTeam($user_id);
    }

    public function createTeam($username, $first_name, $last_name, $client_name, $hours, $tracker, $tracker_owner) {
        return $this->model->createTeam($username, $first_name, $last_name, $client_name, $hours, $tracker, $tracker_owner);
    }

    public function updateTeam($user_id, $username, $first_name, $last_name, $client_name, $hours, $tracker, $tracker_owner) {
        return $this->model->updateTeam($user_id, $username, $first_name, $last_name, $client_name, $hours, $tracker, $tracker_owner);
    }

    public function deleteTeam($user_id) {
        return $this->model->deleteTeam($user_id);
    }
}
?>