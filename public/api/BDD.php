<?php 
Require_once 'config.php';
Class BDD
{
	public Function getAction($table, $key)
	{
		try {
			//echo $key;
			$requete = singleton::getInstance()->prepare("SELECT * FROM ".$table." WHERE id=:_key");
			$requete->bindValue('_key', $key, PDO::PARAM_STR);
			$requete->execute();
			$result = $requete->fetchAll();
			/*foreach($result as $var) {
				echo $var["model"];
			}*/
			//print_r($result);
			echo json_encode($result);
			//$result = json_encode($result);
			//echo $result->{"model"};
		}
		catch (PDOException $e) {
			echo $e->getMessage();
    	
		}

		
	}

	//update selected table 
	public Function putAction($table, $key, $set)
	{
		
		try {
			$input = json_decode($set);

			//print_r($input);

			//echo $input->{"username"}."|";
			//echo $input[1].">";

			$requete = singleton::getInstance()->prepare("UPDATE ".$table." SET model=:_model, hp=:_hp, engine=:_engine, price=:_price, image=:_image WHERE id=:_id");
			$requete->bindValue("_model", $input->{"model"}, PDO::PARAM_STR);
			$requete->bindValue("_hp", $input->{"hp"}, PDO::PARAM_INT);
			$requete->bindValue("_id", $key, PDO::PARAM_STR);
			$requete->bindValue("_engine", $input->{"engine"}, PDO::PARAM_STR);
			$requete->bindValue("_price", $input->{"price"}, PDO::PARAM_INT);
			$requete->bindValue("_image", $input->{"image"}, PDO::PARAM_STR);
			$requete->execute();

			//print_r($input);
			
			
		}
		catch (PDOException $e) {
    		echo $e->getMessage();
		}

	}

	//insert a row from selected table
	public Function postAction($table, $set)
	{
		
		try{
			$input = json_decode($set);

			//print_r($input);
			//print($table);
			/*print($input->{"id"});
			print($input->{"username"});
			print($input->{"user_email"});
			print($input->{"user_role"});
			print($input->{"user_status"});*/

			$requete = singleton::getInstance()->prepare("INSERT INTO ".$table." (model, hp, id, engine, price, image) VALUES (:_model, :_hp, :_id, :_engine, :_price, :_image);");
			$requete->bindValue("_model", $input->{"model"}, PDO::PARAM_STR);
			$requete->bindValue("_hp", $input->{"hp"}, PDO::PARAM_INT);
			$requete->bindValue("_id", $input->{"id"}, PDO::PARAM_STR);
			$requete->bindValue("_engine", $input->{"engine"}, PDO::PARAM_STR);
			$requete->bindValue("_price", $input->{"price"}, PDO::PARAM_INT);
			$requete->bindValue("_image", $input->{"image"}, PDO::PARAM_STR);
			$requete->execute();
			
		}
		catch (PDOException $e) {
    		echo $e->getMessage();
		}

	}

	//delete a row from selected table
	public Function deleteAction($table, $key)
	{
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


}
?>