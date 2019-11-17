<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestGetStock extends Request {
        public function execute($params,$input) {
            try {
                $requete = pdoprintf(singleton::getInstance(), "CALL get_stock(%i)", $params['p1']);
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }