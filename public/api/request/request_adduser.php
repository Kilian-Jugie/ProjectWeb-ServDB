<?php

require_once "request.php";

class RequestAddUser extends Request {
    public function execute($params,$input) {
        //$table = $params["p1"];
        //$key = $params["p2"];

		try {
			$requete = singleton::getInstance()->prepare("CALL add_user(:_last_name,:_first_name,:_email,:_password,:_img_path,:_address,:_user_pseudo,:_newsletter,:_age,:_id_city)");
			$requete->bindValue(':_last_name', $input['last_name'], PDO::PARAM_STR);
			$requete->bindValue(':_first_name', $input['first_name'], PDO::PARAM_STR);
			$requete->bindValue(':_email', $input['email'], PDO::PARAM_STR);
			$requete->bindValue(':_password', $input['password'], PDO::PARAM_STR);
			$requete->bindValue(':_img_path', $input['img_path'], PDO::PARAM_STR);
			$requete->bindValue(':_address', $input['address'], PDO::PARAM_STR);	
			$requete->bindValue(':_user_pseudo', $input['user_pseudo'], PDO::PARAM_STR);
			$requete->bindValue(':_news_letter', $input['news_letter'], PDO::PARAM_STR);
			$requete->bindValue(':_age', $input['age'], PDO::PARAM_STR);
			$requete->bindValue(':_id_city', $input['id_city'], PDO::PARAM_STR);
			$requete->execute();
			$result = $requete->fetchAll();
			// if(!$result){
			// 	$response = "User been correctfully added";
			// }else{ 
			// 	$response = "Error while adding user";
			// }
			echo json_encode($response);			
		}
		catch (PDOException $e) {
			echo $e->getMessage();
			$response = $input['last_name'];
		}
    }
}
