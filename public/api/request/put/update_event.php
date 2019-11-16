<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestUpdateEvent extends Request {
        public function execute($params,$input) {
            try {
                $requete = pdoprintf(singleton::getInstance(), "CALL update_event(%s, %s, %s, %i, %i, %i)",
                    $params['p1'], $input['title'], $input['content'], $input['date'], $input['cost'],
                    $input['id_occurence'], $input['id_status']);
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }