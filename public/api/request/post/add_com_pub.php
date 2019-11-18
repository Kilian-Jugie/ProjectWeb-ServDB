<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestAddComPub extends Request {
        public function execute($params,$input) {
            try {
                $requete = pdoprintf(singleton::getInstance(), 'CALL add_com_pub(%s, %s, %i, %s, %i, %s, %s)',
                    $input['title'], $input['content'], $input['id_user'], $input['id_pub_type'],
                    $input['id_pub'], $input['id_status'], $input['image_json_file']);
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }