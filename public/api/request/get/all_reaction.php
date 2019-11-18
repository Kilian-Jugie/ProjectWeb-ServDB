<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestAllReaction extends Request {
        public function execute($params,$input) {
            try {
                $requete = pdoprintf(singleton::getInstance(), "CALL select_all_reaction()");
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }