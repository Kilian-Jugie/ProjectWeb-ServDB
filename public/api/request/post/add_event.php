<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestAddEvent extends Request {
        public function execute($params,$input) {
            try {
                $requete = pdoprintf(singleton::getInstance(), 'CALL add_event(%s, %s, %s, %s, %i, %i, %i, %s)',
                    $input['input_title'], $input['input_content'], $input['input_date'], $input['input_end_date'],
                    $input['input_cost'], $input['input_id_user'], $input['input_id_occurence'],
                    $input['input_image_json_file']);
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }