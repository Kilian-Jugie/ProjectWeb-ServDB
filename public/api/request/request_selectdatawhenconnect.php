<?php 
    require_once "request.php";
    require_once 'utils.php';

    class RequestSelectDataWhenConnect extends Request {
        public function execute($params,$input) {
            try {
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