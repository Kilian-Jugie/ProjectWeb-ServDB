<?php

require_once "request.php";

class RequestSelectCampus extends Request {
    public function execute($params,$input) {
		try {
			$requete = singleton::getInstance()->prepare("CALL select_campus()");
			$requete->execute();
			$result = $requete->fetchAll();
            echo json_encode($result);
            
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
    }
}