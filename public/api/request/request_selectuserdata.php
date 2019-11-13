<?php 
    require_once "request.php";

    class RequestSelectUserData extends Request {
        public function execute($params,$input) {
            try {
                $requete = singleton::getInstance()->prepare("CALL select_user_data(:_user_email)");
                $requete->bindValue(':_user_email', $params['p1'], PDO::PARAM_STR);
                $requete->execute();
                $result = $requete->fetchAll();
                echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                echo $params['p1'];
            }
        }
    }
?>