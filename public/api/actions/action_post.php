<?php
require_once 'config.php';
require_once 'action.php';

class ActionPost extends Action {
    /*public function execute($params, $input) {
        $table = $params["p0"];
		try{
			$decoded = json_decode($input);

			$requete = singleton::getInstance()->prepare("INSERT INTO ".$table." (model, hp, id, engine, price, image) VALUES (:_model, :_hp, :_id, :_engine, :_price, :_image);");
			$requete->bindValue("_model", $decoded->{"model"}, PDO::PARAM_STR);
			$requete->bindValue("_hp", $decoded->{"hp"}, PDO::PARAM_INT);
			$requete->bindValue("_id", $decoded->{"id"}, PDO::PARAM_STR);
			$requete->bindValue("_engine", $decoded->{"engine"}, PDO::PARAM_STR);
			$requete->bindValue("_price", $decoded->{"price"}, PDO::PARAM_INT);
			$requete->bindValue("_image", $decoded->{"image"}, PDO::PARAM_STR);
			$requete->execute();
			
		}
		catch (PDOException $e) {
    		echo $e->getMessage();
		}
    }

    public static function getInstance() {
        return new ActionPost();
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
			self::$INSTANCE = new ActionPost();
		return self::$INSTANCE;
    }
}