<?php

require_once "request.php";

class RequestAddUser extends Request {
    public function execute($params,$input) {
        //$table = $params["p1"];
        //$key = $params["p2"];
        

		try {
            echo $input["pseudo"];

			/*$requete = singleton::getInstance()->prepare("SELECT * FROM ".$table);
			//$requete->bindValue('_key', $key, PDO::PARAM_STR);
			$requete->execute();
			$result = $requete->fetchAll();
            echo json_encode($result);*/
            
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
    }
}
