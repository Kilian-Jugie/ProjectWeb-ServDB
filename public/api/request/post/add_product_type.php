<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    class RequestAddProductType extends Request {
        public function execute($params,$input) {
            try {
                $requete = pdoprintf(singleton::getInstance(), 'CALL add_product_type(%s)', 
                    $input['label']);
                $requete->execute();
                $result = $requete->fetchAll();

		        echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }