<?php 
    require_once "request.php";
    require_once 'utils.php';

    /**
     * count_asso_campus p1 -> asso
     * count_bde_member_campus p1 -> member
     * count_user_by_campus p1 -> follower
     * count_event_by_campus p1 -> event
     */

    class RequestCount extends Request {
        public function execute($params,$input) {
            try {
                $requete = pdoprintf(singleton::getInstance(), "CALL count_asso_campus(%i)", $params["p1"]);
                $requete->execute();
                $result = $requete->fetchAll();
                echo json_encode($result);

                $requete = pdoprintf(singleton::getInstance(), "CALL count_bde_member_campus(%i)", $params["p1"]);
                $requete->execute();
                $result = $requete->fetchAll();
                echo json_encode($result);

                $requete = pdoprintf(singleton::getInstance(), "CALL count_user_by_campus(%i)", $params["p1"]);
                $requete->execute();
                $result = $requete->fetchAll();
                echo json_encode($result);
                
                $requete = pdoprintf(singleton::getInstance(), "CALL count_event_by_campus(%i)", $params["p1"]);
                $requete->execute();
                $result = $requete->fetchAll();
                echo json_encode($result);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }