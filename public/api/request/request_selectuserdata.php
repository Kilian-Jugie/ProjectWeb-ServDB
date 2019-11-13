<?php 
    require_once "request.php";

    class RequestSelectUserData extends Request {
        public function execute($params,$input) {
            try {
                $requete = singleton::getInstance()->prepare("CALL select_user_data(".$params['p1'].")");
                $requete->execute();
                $result = $requete->fetchAll();
                echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>