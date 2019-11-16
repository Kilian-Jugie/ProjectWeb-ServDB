<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestUpdateUserStatus extends Request {
        public function execute($params,$input) {
            $accountId = $params['p1'];
            try {
                $requete = pdoprintf(singleton::getInstance(), 'CALL update_user_status(%i, %i)',
                    $input['id_role'], $accountId);
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }