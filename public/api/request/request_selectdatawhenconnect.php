<?php 
    require_once "request.php";
    require_once 'utils.php';

    class RequestSelectDataWhenConnect extends Request {
        public function execute($params,$input) {
            try {
                //$requete = singleton::getInstance()->prepare("CALL select_data_when_connect(:_user_email)");
                //$requete->bindValue(':_user_email', $params['p1'], PDO::PARAM_STR);
                $requete = pdoprintf(singleton::getInstance(), "CALL select_data_when_connect(%s)", $params["p1"]);
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