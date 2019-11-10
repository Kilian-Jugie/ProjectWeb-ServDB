<?php 
include "BDD.php";


class API
{
	private static $actions = array();
	
	static function registerActionForMethod($method, $action) {
		self::$actions[$method] = $action;
	}

	static function callActionForMethod($method, $db, $dbParams, $dbInput) {
		foreach(self::$actions as $key => $iterator) {
			if($key === $method) {
				$db->$iterator($dbParams, $dbInput);
			}
		}
	}

	static function reqArgs($method, $params, $input) {		
		$bdd = new BDD();
		self::registerActionForMethod('GET', 'getAction');
		self::registerActionForMethod('POST', 'postAction');
		self::registerActionForMethod('PUT', 'putAction');
		self::registerActionForMethod('DELETE', 'deleteAction');
		
		self::callActionForMethod($method, $bdd, $params, $input);
	}
}

new API();

function api_main($method, $params, $body) {
	$minimumParameterCount = 2;

	if(count($params)<$minimumParameterCount) {
		for($i=count($params); $i<$minimumParameterCount; $i++) {
			$params[$i] = "";
		}
		return;
	}

	if($body&&$body["test"]===true) {
		echo "Method:\n";
		var_dump($method);
		echo "\nParams:\n";
		var_dump($params);
		echo "\nBody:\n";
		var_dump($body);
		echo "\nResponse:\n";
	}

	API::reqArgs($method, $params, $body);
}

?>