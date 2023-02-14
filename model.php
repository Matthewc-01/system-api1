<?php
class TeamModel {
    private $db;
    
    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=productivity-system", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Unable to connect to database: " . $e->getMessage());
        }
    }

    public function getTeams() {
        $stmt = $this->db->prepare("SELECT * FROM sms_data");
        $stmt->execute();
        $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return (!empty($teams)) ? $teams : [];
    }

    public function getTeam($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM sms_data WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $team = $stmt->fetch(PDO::FETCH_ASSOC);
        return (!empty($team)) ? $team : [];
    }

    public function createTeam($username, $first_name, $last_name, $client_name, $hours, $tracker, $tracker_owner) {
        $stmt = $this->db->prepare("INSERT INTO sms_data (username, first_name, last_name, client_name, hours, tracker, tracker_owner, created_at, updated_at) VALUES (:username, :first_name, :last_name, :client_name, :hours, :tracker, :tracker_owner, NOW(), NOW())");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":client_name", $client_name, PDO::PARAM_STR);
        $stmt->bindParam(":hours", $hours, PDO::PARAM_INT);
        $stmt->bindParam(":tracker", $tracker, PDO::PARAM_STR);
        $stmt->bindParam(":tracker_owner", $tracker_owner, PDO::PARAM_STR);
        $stmt->execute();
        return $this->db->lastInsertId();
    }
    public function updateTeam($user_id, $username, $first_name, $last_name, $client_name, $hours, $tracker, $tracker_owner) {
        $stmt = $this->db->prepare("UPDATE sms_data SET username = :username, first_name = :first_name, last_name = :last_name, client_name = :client_name, hours = :hours, tracker = :tracker, tracker_owner = :tracker_owner, updated_at = NOW() WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":client_name", $client_name, PDO::PARAM_STR);
        $stmt->bindParam(":hours", $hours, PDO::PARAM_INT);
        $stmt->bindParam(":tracker", $tracker, PDO::PARAM_STR);
        $stmt->bindParam(":tracker_owner", $tracker_owner, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deleteTeam($user_id) {
        $stmt = $this->db->prepare("DELETE FROM sms_data WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
    