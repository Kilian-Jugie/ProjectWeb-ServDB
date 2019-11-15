<?php

require_once "request.php";
require_once 'utils.php';

class RequestViewAll extends Request {
    public function execute($params,$input) {
        $table = $params["p1"];
		//$key = $params["p2"];
		try {
			//$requete = singleton::getInstance()->prepare("SELECT * FROM ".$table);
			//$requete->bindValue('_key', $key, PDO::PARAM_STR);
			
			$requete = pdoprintf(singleton::getInstance(), "SELECT * FROM ".$table);
			$requete->execute();
			$result = $requete->fetchAll();
			echo json_encode($result);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
    }
}