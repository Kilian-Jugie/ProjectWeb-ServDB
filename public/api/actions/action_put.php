<?php
require_once 'config.php';
require_once 'action.php';

class ActionPut implements Action {
    public function execute($params, $input) {
        $table = $params["p0"];
		$key = $params["p1"];
		try {
			$decoded = json_decode($input);

			//print_r($decoded);

			//echo $decoded->{"username"}."|";
			//echo $decoded[1].">";

			$requete = singleton::getInstance()->prepare("UPDATE ".$table." SET model=:_model, hp=:_hp, engine=:_engine, price=:_price, image=:_image WHERE id=:_id");
			$requete->bindValue("_model", $decoded->{"model"}, PDO::PARAM_STR);
			$requete->bindValue("_hp", $decoded->{"hp"}, PDO::PARAM_INT);
			$requete->bindValue("_id", $key, PDO::PARAM_STR);
			$requete->bindValue("_engine", $decoded->{"engine"}, PDO::PARAM_STR);
			$requete->bindValue("_price", $decoded->{"price"}, PDO::PARAM_INT);
			$requete->bindValue("_image", $decoded->{"image"}, PDO::PARAM_STR);
			$requete->execute();

			//print_r($decoded);
			
			
		}
		catch (PDOException $e) {
    		echo $e->getMessage();
		}
    }

    public static function getInstance() {
        return new ActionPut();
    }
}