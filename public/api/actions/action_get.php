<?php

require_once 'config.php';
require_once 'action.php';

class ActionGet implements Action {
    public function execute($params, $input) {
        $table = $params["p0"];
		$key = $params["p1"];
		try {
			$requete = singleton::getInstance()->prepare("SELECT * FROM ".$table." WHERE id=:_key");
			$requete->bindValue('_key', $key, PDO::PARAM_STR);
			$requete->execute();
			$result = $requete->fetchAll();
			echo json_encode($result);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	
	public static function getInstance() {
        return new ActionGet();
    }
}