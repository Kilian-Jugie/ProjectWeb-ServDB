<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestUpdateUserData extends Request {
        public function execute($params,$input) {
            $accountId = $params['p1'];
            try {
                $requete = pdoprintf(singleton::getInstance(), 'CALL update_user_data(%i, %i)',
                    $input['id_role'], $input['id_campus'], $accountId);
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }