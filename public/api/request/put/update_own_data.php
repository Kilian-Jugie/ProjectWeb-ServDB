<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestUpdateOwnData extends Request {
        public function execute($params,$input) {
            $accountId = $params['p1'];
            try {
                $requete = pdoprintf(singleton::getInstance(), 'CALL update_own_account(%i, %s, %s, %s, %s, %s, %s, %i, %i, %i)',
                    $accountId, $input['firstname'], $input['lastname'], $input['email'], $input['thumbnail'], $input['address'], $input['pseudo'], 
                    $input['newsletter'], $input['age'], $input['campus_id']);
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }