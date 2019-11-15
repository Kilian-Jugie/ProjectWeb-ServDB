<?php

require_once "request.php";

class RequestAddCampus extends Request {
    public function execute($params,$input) {
		try {
            $requete = singleton::getInstance()->prepare('CALL add_campus(:campus)');
            $requete->bindValue('campus', $input['name'], PDO::PARAM_STR);
			$requete->execute();
			$result = $requete->fetchAll();
			echo json_encode($result);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
    }
}