<?php

/**
 * format: "SELECT * from table WHERE %s='ui'"
 */
function pdoprintf($pdo, $request, ...$params) {
    $requestReady = str_replace('%s', '?', $request);
    $requestReady = str_replace('%i', '?', $requestReady);
    
    $pdoRequest = $pdo->prepare($requestReady);
    
    $requestArray = str_split($request);
    $requestArraySize = count($requestArray);

    for($i = 0, $n = 0; $i < $requestArraySize; $i++) {
        if($requestArray[$i] == '%') {
            $i++;
            $n++;
            switch($requestArray[$i]) {
                case 's': {
                    $pdoRequest->bindValue($n, $params[$n-1], PDO::PARAM_STR);
                }break;
                case 'i': {
                    $pdoRequest->bindValue($n, $params[$n-1], PDO::PARAM_INT);
                }break;
            }
            
        }
    }
    return $pdoRequest;
}