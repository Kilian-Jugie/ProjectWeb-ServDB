<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestAddParticipation extends Request {
        public function execute($params,$input) {
            try {
                $requete = pdoprintf(singleton::getInstance(), 'CALL add_participation(%i, %i)',
                    $input['id_user'], $input['id_publication']);
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }