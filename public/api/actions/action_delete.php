<?php
require_once 'config.php';
require_once 'action.php';

class ActionDelete extends Action {
    /*public function execute($params, $input) {
        $table = $params["p0"];
		$key = $params["p1"];
		try{
			$requete = singleton::getInstance()->prepare("DELETE FROM ".$table." WHERE id=:_key");
			$requete->bindValue('_key', $key, PDO::PARAM_STR);
			$requete->execute();
			echo "Success";
			//$result = $requete->fetchAll();
			//echo $result;
		}
		catch (PDOException $e) {
    		echo $e->getMessage();
		}
    }

    public static function getInstance() {
        return new ActionDelete();
	}*/
	private static $INSTANCE = null;

    public function execute($params, $input) {
		$requ = $this->getRequest($params["p0"]);
		if($requ)
			$requ->execute($params, $input);
		else
			echo "ERROR: No request for ".$params["p0"]." !!!\n";
	}
	
	public static function getInstance() {
		if(!self::$INSTANCE)
			self::$INSTANCE = new ActionDelete();
		return self::$INSTANCE;
    }
}