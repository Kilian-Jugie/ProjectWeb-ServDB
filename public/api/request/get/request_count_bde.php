<?php 
    require_once dirname(dirname(__FILE__))."/request.php";
    require_once dirname(dirname(__FILE__)).'/utils.php';

    /**
     * count_asso_campus p1 -> asso
     * count_bde_member_campus p1 -> member
     * count_user_by_campus p1 -> follower
     * count_event_by_campus p1 -> event
     */

    class RequestCountBde extends Request {
        public function execute($params,$input) {
            try {
                $ret = array();

                $requete = pdoprintf(singleton::getInstance(), "CALL count_asso_campus(%i)", $params["p1"]);
                $requete->execute();
                $result = $requete->fetchAll();

                $ret["asso"] = $result[0]["COUNT(*)"];

                $requete = pdoprintf(singleton::getInstance(), "CALL count_bde_member_campus(%i)", $params["p1"]);
                $requete->execute();
                $result = $requete->fetchAll();
                
                $ret["member"] = $result[0]["COUNT(*)"];

                $requete = pdoprintf(singleton::getInstance(), "CALL count_user_by_campus(%i)", $params["p1"]);
                $requete->execute();
                $result = $requete->fetchAll();
                
                $ret["follower"] = $result[0]["COUNT(*)"];

                $requete = pdoprintf(singleton::getInstance(), "CALL count_event_by_campus(%i)", $params["p1"]);
                $requete->execute();
                $result = $requete->fetchAll();
                
		$ret["event"] = $result[0]["nb_event_actif"];

		echo json_encode($ret);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

